
{{  Form::open (array('route'=>'utente.store')) }}

<h2>Inserisci Utente</h2>
    <div>
            {{  Form::label ('username', 'Username' )}}
            {{  Form::text ('username', '')  }}
            @if ($errors->first('username'))
                <ul>
                    @foreach ($errors->get('username') as $message)
                    <li class="errors">{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
    </div>
    <div>
            {{  Form::label ('password', 'Password')}}
            {{  Form::password ('password')  }}
            @if ($errors->first('password'))
                <ul>
                    @foreach ($errors->get('password') as $message)
                    <li class="errors">{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
    <div>
            {{  Form::label ('password_confirmation', 'Conferma Password')}}
            {{  Form::password ('password_confirmation')  }}
            @if ($errors->first('password'))
                    <ul>
                        @foreach ($errors->get('password') as $message)
                        <li class="errors">{{ $message }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>



    <div>
            {{  Form::label ('nome', 'Nome')  }}
            {{  Form::text ('nome', '')  }}
          @if ($errors->first('nome'))
                <ul>
                    @foreach ($errors->get('nome') as $message)
                    <li class="errors">{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

 <div>
            {{  Form::label ('cognome', 'Cognome')}}
            {{  Form::text ('cognome', '')}}
            @if ($errors->first('cognome'))
                <ul>
                    @foreach($errors->get('cognome') as $message)
                    <li>{{$message}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div>
        {{Form::label('file_img','Foto Profilo')}}
        {{Form::file('file_img')}}
        @if ($errors->first('file_img'))
                <ul>
                    @foreach ($errors->get('file_img') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
        </div>
<div>
            {{  Form::label ('data_nascita', 'Data di Nascita')}}
            {{  Form::date('data_nascita', '')}}
            @if ($errors->first('data_nascita'))
                <ul>
                    @foreach($errors->get('data_nascita') as $message)
                    <li>{{$message}}</li>
                    @endforeach
                </ul>
            @endif
        </div>

<div>
            {{  Form::label ('email', 'Indirizzo E-Mail')}}
            {{  Form::email ('email', '')}}
            @if ($errors->first('email'))
                <ul>
                    @foreach($errors->get('email') as $message)
                    <li>{{$message}}</li>
                    @endforeach
                </ul>
            @endif
        </div>


	<div>
            {{  Form::label ('telefono', 'Telefono')}}
            {{  Form::text ('telefono','')}}
            @if ($errors->first('telefono'))
            <ul>
                    @foreach($errors->get('telefono') as $message)
                    <li>{{$message}}</li>
                    @endforeach
            </ul>
            @endif
        </div>

        <div>
            {{  Form::label ('role', 'Ruolo',['name'=>'role']) }}
            {{  Form::radio ('role', 'tecnico', true, ['id' => 'tecnico']) }} Tecnico
            {{  Form::radio ('role', 'staff', false, ['id' => 'staff']) }} Staff
        </div>

        <div id="centroID">
            {{  Form::label ('centroID', 'Centro Assistenza') }}
            {{  Form::select ('centroID', $centri, null, ['placeholder' => 'Electrohm Centro'])}}
        </div>










{{  Form::submit ('Inserisci Utente')  }}
{{  Form::reset ('Reset')}}

{{  Form::close()}}

<script>

    $(document).ready(function(){
        $('input[type=radio]').click(function(){
            (this.value === "tecnico") ? $("#centroID").show() : $("#centroID").hide();
        });
    });


</script>
