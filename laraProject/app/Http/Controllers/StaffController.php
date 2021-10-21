<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Malfunzionamenti;
use App\Http\Controllers\AdminController;
use App\Traits\MalfunzionamentiActions;
use App\Traits\SoluzioniActions;
use App\Traits\ProdottiActions;
use Illuminate\Support\Facades\Route;
use App\Tables\ProdottiTable;

class StaffController extends Controller
{   
    use ProdottiActions, SoluzioniActions;
    
    public function __construct(){
        $this->middleware('can:isStaff');
    }

    public function viewProdottiTable(Request $request){
        $table = new ProdottiTable($request);

        return view('admin.staff-prodotti-table')->with('table', $table);
    }
}
