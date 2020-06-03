@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Detalhes do contacto')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection



{{-- Page Content --}}
@section('content')


<div class="container-fluid mt-2" style="color: black">

    {{-- Conteúdo --}}
    <div class="bg-white shadow-sm mb-4 p-4 ">


        <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Detalhes do contacto</strong></h4>
                    <small>
                        <div>
                            <span>Ultima atualização:
                                <strong>{{ date('d-M-y', strtotime($contact->updated_at)) }}</strong></span>
                        </div>
                    </small>
                </div>
            </div>

            {{-- Opções --}}
            <div class="col text-right">
                <a href="{{route('contacts.edit',$contact)}}" class="btn btn-sm btn-success m-1 mr-2 px-3 "><i
                        class="fas fa-pencil-alt mr-2"></i>Editar informação</a>
            </div>

        </div>


        <hr class="my-3">


        {{-- SE O CONTACTOS ESTIVER ASSOCIASDO À UNIVERISADE --}}
        @if ( isset($university) )
        <div class="row px-2 mb-3 ">
            <div class="col p-3 mx-2 border bg-light rounded">

                <i class="fas fa-university mr-1"></i>
                <span class="text-muted">Associado à universidade:<span style="color:#6A74C9">
                        {{$university->nome}}</span></span>
                <input type="hidden" id="idUniversidade" name="idUniversidade" value="{{$university ->idUniversidade}}">
            </div>
        </div>
        @endif


        <div class="row p-2 pt-3 pb-3">


            {{-- FOTOGRAFIA --}}
            <div class="col p-0 text-center" style="max-width: 340px; min-width:300px">

                @if($contact->fotografia)
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('contact-photos/').$contact->fotografia}}" style="width:90%">
                @else
                <img class="m-2 p-1 rounded bg-white shadow-sm"
                    src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
                @endif

                @if( $contact->favorito==1 )
                <div class="text-center mt-2" >
                    <i class="fas fa-star text-warning " style="font-size:30px"></i><br>
                    <small class="font-weight-bold">Marcado como favorito</small>
                </div>
                @endif

            </div>


            <div class="col mr-3" style="min-width:350px">

                <div>Nome: <span class="font-weight-bold">{{$contact->nome}}</span></div>

                <br>

                <div>Telefone (principal):</div>

                    @if ($contact->telefone1!=null)
                    <span class="font-weight-bold">{{$contact->telefone1}}</span>
                    @else
                    <span class="text-muted"><small>(Sem informação)</small></span>
                    @endif


                <br><br>

                <div>Telefone (alternativo):</div>

                    @if ($contact->telefone2!=null)
                    {{$contact->telefone2}}</span>
                    @else
                    <span class="text-muted"><small>(Sem informação)</small></span>
                    @endif


                <br><br>

                <div>Fax:</div>

                    @if ($contact->fax!=null)
                    {{$contact->fax}}</span>
                    @else
                    <span class="text-muted"><small>(Sem informação)</small></span>
                    @endif


                <br><br>

                <div>E-mail:</div>

                    @if ($contact->email!=null)
                    {{$contact->email}}</span>
                    @else
                    <span class="text-muted"><small>(Sem informação)</small></span>
                    @endif


                <br><br>

            </div>

            <div class="col" style="min-width:350px">

                <div>Observações:</div>

                    @if ($contact->observacao!=null)
                    {{$contact->observacao}}
                    @else
                    <span class="text-muted"><small>(Sem observações)</small></span>
                    @endif


            </div>


        </div>

    </div>

</div>


@endsection

{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
