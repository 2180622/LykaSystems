@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Detalhes do contacto')

{{-- CSS Style Link --}}
@section('styleLinks')

@endsection



{{-- Page Content --}}
@section('content')

    <div class="container mt-2">
      {{-- Navegação --}}
    <div class="float-left buttons">
        <a href="javascript:history.go(-1)" title="Voltar">
            <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
        </a>
        <a href="javascript:window.history.forward();" title="Avançar">
            <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
        </a>
    </div>
        <div class="float-right">
            <a href="{{route('contacts.edit',$contact)}}" class="top-button mr-2">Editar informação</a>
        </div>

        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Detalhes do contacto</h6>
            </div>
            <br>

            <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">
                <div class="col p-0 text-center" style="flex: 0 0 20%; -ms-flex: 0 0 20%; min-width:195px">



                    @if($contact->fotografia)
                        <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{Storage::disk('public')->url('contact-photos/').$contact->fotografia}}" style="width:90%">
                    @else
                        <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{Storage::disk('public')->url('default-photos/M.jpg')}}" style="width:90%">
                    @endif

                    @if( $contact->favorito==1 )
                    <div class="text-center mt-2" >
                        <i class="fas fa-star text-warning " style="font-size:30px"></i><br>
                        <small>Marcado como favorito</small>
                    </div>
                    @endif

                </div>

                <div class="col p-2">

                    <div class="row">
                        <div class="col">
                            {{-- Informações Pessoais --}}
                            <div><span class="text-secondary ">Nome:</span> {{$contact->nome}}</div><br>

                            <div><span class="text-secondary ">Telefone (principal):</span> {{$contact->nome}}</div><br>

                            <div><span class="text-secondary ">Telefone (alternativo):</span> {{$contact->nome}}</div><br>

                            <div><span class="text-secondary ">Fax:</span> {{$contact->fax}}</div><br>

                            <div><span class="text-secondary ">E-mail:</span> {{$contact->email}}</div><br>
                        </div>


                        <div class="col">
                            <span class="text-secondary ">Observações:</span><br>
                            @if ($contact->observacao!=null)
                                {{$contact->observacao}}
                            @else
                                <span class="text-muted"><small>(Sem observações)</small></span>
                            @endif
                        </div>

                    </div>


                    <hr>
                    <small>Adicionado: {{ date('d-M-y', strtotime($contact->created_at)) }}</small><br>
                    <small>Ultima atualização: {{ date('d-M-y', strtotime($contact->updated_at)) }}</small>


                </div>

            </div>





        </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
