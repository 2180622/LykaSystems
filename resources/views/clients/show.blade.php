@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de estudante')

{{-- CSS Style Link --}}
@section('styleLinks')

@endsection



{{-- Page Content --}}
@section('content')

<div class="container mt-2">
        {{-- Navegação --}}
        <div class="float-left">
            <a href="javascript:history.go(-1)" title="Voltar"><i
                    class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
            <a href="javascript:window.history.forward();" title="Avançar"><i
                    class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
        </div>
    <div class="float-right">
        <a href="{{route('clients.edit',$client)}}" class="top-button mr-2">Editar informação</a>
        <a href="#" class="top-button">Imprimir</a>
    </div>

    <br><br>
    
    <div class="cards-navigation">
        <div class="title">
            <h6>Ficha de estudante - {{$client->nome}} {{$client->apelido}}</h6>
        </div>
        <br>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            {{-- MENU: Informação pessoal --}}
            <li class="nav-item">
                <a class="nav-link active" id="pessoal-tab" data-toggle="tab" href="#pessoal" role="tab"
                    aria-controls="contacts" aria-selected="true">Informação pessoal</a>
            </li>

            {{-- MENU: Contactos --}}
            <li class="nav-item">
                <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab"
                    aria-controls="contacts" aria-selected="false">Contactos</a>
            </li>

            {{-- MENU: Documentação --}}
            <li class="nav-item">
                <a class="nav-link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab"
                    aria-controls="documentation" aria-selected="false">Documentação</a>
            </li>


            {{-- MENU: Moradas --}}
            <li class="nav-item">
                <a class="nav-link" id="adresses-tab" data-toggle="tab" href="#adresses" role="tab"
                    aria-controls="adresses" aria-selected="false">Financeiro</a>
            </li>

        </ul>

        <div class="tab-content p-2 mt-3" id="myTabContent">

            {{-- Conteudo: Informação pessoal --}}
            <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
                <div class="row">
                    <div class="col">

                        {{-- Informações Pessoais --}}
                        <div><span class="text-secondary">Nome:</span> {{$client->nome}} {{$client->apelido}}</div><br>

                        <div><span class="text-secondary">Naturalidade:</span> {{$client->paisNaturalidade}}</div><br>

                        <div><span class="text-secondary">Data de nascimento:</span>
                            {{ date('d-M-y', strtotime($client->dataNasc)) }}</div><br>

                        <div><span class="text-secondary">Observações pessoais: </span>{{ $client->obsPessoais }}</div>
                        <br>

                        <hr><br>

                        {{-- Informações Escolares --}}
                        <div><span class="text-secondary">Nivel de estudos(atual):</span> {{$client->nivEstudoAtual}}
                        </div><br>

                        <div><span class="text-secondary">Nome da instituição de origem:</span>
                            {{$client->nomeInstituicaoOrigem}}</div><br>

                        <div><span class="text-secondary">Local da instituição:</span>
                            {{$client->cidadeInstituicaoOrigem}}</div><br>

                        <div><span class="text-secondary">Observações académicas: </span>{{$client->obsAcademicas}}
                        </div><br>

                    </div>

                    <div class="col col-4 text-center" style="min-width:195px">
                        {{-- Fotografia --}}
                        <div><label for="fotografia"><span class="text-secondary">Fotografia:</span></label></div>

                        @if ($client->fotografia==null)
                        <img class="m-2 p-1 rounded bg-white shadow-sm"
                            src="{{Storage::disk('public')->url('client-photos/default.png')}}" style="width:80%">
                        @else
                        <img class="m-2 p-1 rounded bg-white shadow-sm"
                            src="{{Storage::disk('public')->url('client-photos/').$client->fotografia}}"
                            style="width:80%">
                        @endif


                    </div>
                </div>

            </div>


            {{-- Conteudo: Contactos --}}
            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">

                <div class="row">
                    <div class="col">

                        {{-- Contactos --}}
                        <div><span class="text-secondary">Telefone (principal):</span> {{$client->telefone1}}</div><br>

                        <div><span class="text-secondary">Telefone (secundário):</span> {{$client->telefone2}}</div><br>

                        <div><span class="text-secondary">E-mail:</span> {{$client->email}}</div><br>
                    </div>


                    <div class="col">

                        {{-- Contactos --}}
                        <div><span class="text-secondary">Morada de residência (Portugal):</span></div>
                        <div>{{$client->moradaResidencia}}</div><br>

                    </div>
                </div>

                <hr><br>

                <div class="row">
                    <div class="col">
                        {{-- Morada de residência no pais de origem --}}
                        <div><span class="text-secondary">Morada (origem):</span> {{$client->morada}}</div><br>
                        <div><span class="text-secondary">Cidade (origem):</span> {{$client->cidade}}</div><br>
                        <hr>
                    </div>
                </div>

                {{-- Contactos dos PAIS --}}
                <div class="row mt-4">
                    <div class="col ">
                        <div><span class="text-secondary">Nome do pai:</span> {{$client->nomePai}}</div><br>
                        <div><span class="text-secondary">Telefone do pai:</span> {{$client->telefonePai}}</div><br>
                        <div><span class="text-secondary">E-mail do pai:</span> {{$client->emailPai}}</div><br>
                    </div>

                    <div class="col ">
                        <div><span class="text-secondary">Nome da mãe:</span> {{$client->nomeMae}}</div><br>
                        <div><span class="text-secondary">Telefone da mãe:</span> {{$client->telefoneMae}}</div><br>
                        <div><span class="text-secondary">E-mail da mãe:</span> {{$client->emailMae}}</div><br>
                    </div>

                </div>

            </div>


            {{-- Conteudo: Documentação --}}
            <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">

                {{-- INUPUT IDENTIFICAÇÃO --}}
                <div class="row">
                    <div class="col">
                        <div><span class="text-secondary">Número de cartão de cidadão:</span> {{$client->numCCid}}</div>

                    </div>
                    <div class="col">
                        <div><span class="text-secondary">Número de identificação fiscal:</span> {{$client->NIF}}</div>
                    </div>
                </div><br>

                <hr><br>


                {{-- INUPUTS DADOS DE PASSAPORTE --}}
                <div class="row">

                    <div class="col">
                        {{--  numPassaport --}}
                        <div><span class="text-secondary">Numero do passaporte:</span> {{$client->numPassaport}}</div>
                        <br>

                        {{--  dataValidPP --}}
                        <div><span class="text-secondary">Data de validade do passaporte:</span>
                            {{$client->dataValidPP}}</div><br>

                        {{--  passaportPaisEmi --}}
                        <div><span class="text-secondary">Pais emissor do passaporte:</span>
                            {{$client->passaportPaisEmi}}</div><br>

                        {{--  localEmissaoPP --}}
                        <div><span class="text-secondary">Local de emissão do passaporte:</span>
                            {{$client->localEmissaoPP}}</div><br>

                    </div>

                </div>





            </div>


            {{-- DADOS FINANCEIROS --}}
            <div class="tab-pane fade" id="adresses" role="tabpanel" aria-labelledby="adresses-tab">

                <div class="row ">
                    <div class="col">
                        <span class="text-secondary">Agente responsável:</span> "Nome do Agente"
                    </div>
                </div><br>

                <hr><br>

                <div class="row ">
                    <div class="col">
                        <div><span class="text-secondary">Produtos adquiridos:</span><br>

                            @if($produtos!=null)
                                <ul>
                                    <li>Curso tal tal</li>
                                    <li>Curso tal tal</li>
                                    <li>Curso tal tal</li>
                                </ul>
                            @else
                                <div>- Sem produtos adquiridos</div>
                            @endif

                        </div>
                    </div>

                    <div class="col">

                        <div><span class="text-secondary">Estado financeiro: </span><span class="text-success">Regularizado</span></div><br>

                        <div><span class="text-secondary">Observações Financeiras: </span>{{$client->obsFinanceiras}}</div>

                    </div>

                </div><br>

                <hr><br>
                <div class="row">
                    <div class="col">
                        <div><span class="text-secondary">IBAN:</span> {{$client->IBAN}}</div><br>
                    </div>
                </div>
            </div>



        </div>





    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
