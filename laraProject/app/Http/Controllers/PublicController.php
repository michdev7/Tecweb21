<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resources\Prodotto;

class PublicController extends Controller
{
    public function __construct(){

    }

    public function viewCatalogoPage(){
        return view('public.catalogo');
    }

    public function viewProdottoPage(Request $request){
        $prodotto = Prodotto::where('modello', $request->modello)->get()->first();

        if($prodotto != null)
            return view('public.prodotto')->with('prodotto', $prodotto);
        else
            return abort(404);
    }

    public function viewCentriAssistenzaPage(){
        return view('public.centri-assistenza');
    }

    public function viewFaqPage(){
        return view('public.faq');
    }
}
