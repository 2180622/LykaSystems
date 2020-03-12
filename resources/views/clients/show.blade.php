@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha individual')

{{-- CSS Style Link --}}
@section('styleLinks')

@endsection



{{-- Page Content --}}
@section('content')

<div class="container mt-2">
    <div class="float-right">
        <a href="#" class="top-button">Editar informação</a>
        <a href="#" class="top-button">Imprimir</a>
    </div>
    <br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Ficha de estudante</h6>
        </div>
        <br>


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            {{-- MENU: Informação pessoal --}}
            <li class="nav-item">
                <a class="nav-link active" id="pessoal-tab" data-toggle="tab" href="#pessoal" role="tab" aria-controls="contacts" aria-selected="true">Informação pessoal</a>
            </li>

            {{-- MENU: Contactos --}}
            <li class="nav-item">
                <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">Contactos</a>
            </li>

            {{-- MENU: Moradas --}}
            <li class="nav-item">
                <a class="nav-link" id="adresses-tab" data-toggle="tab" href="#adresses" role="tab" aria-controls="adresses" aria-selected="false">Moradas</a>
            </li>

            {{-- MENU: Documentação --}}
            <li class="nav-item">
                <a class="nav-link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab" aria-controls="documentation" aria-selected="false">Documentação</a>
            </li>
        </ul>

        <div class="tab-content p-2 mt-3" id="myTabContent">

            {{-- Conteudo: Informação pessoal --}}
            <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
                <div class="row">
                    <div class="col">

                        {{-- Informações Pessoais --}}
                        <div>Nome: {{$client->nome}} {{$client->apelido}}</div><br>

                        <div>Naturalidade: {{$client->paisNaturalidade}}</div><br>

                        <div>Data de nascimento: {{ date('d-M-y', strtotime($client->dataNasc)) }}</div><br>

                        <div>Observações pessoais:</div><div>{{ $client->obsPessoais }}</div><br>

                        <hr><br>

                        {{-- Informações Escolares --}}
                        <div>Nivel de estudos(atual): {{$client->nivEstudoAtual}}</div><br>

                        <div>Nome da instituição de origem: {{$client->nomeInstituicaoOrigem}}</div><br>

                        <div>Local da instituição: {{$client->cidadeInstituicaoOrigem}}</div><br>

                        <div>Observações académicas:</div><div >{{$client->obsAcademicas}}</div><br>

                    </div>

                    <div class="col col-4 text-center" style="min-width:195px">
                        {{-- Fotografia --}}
                        <div><label for="fotografia">Fotografia:</label></div>
                        <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{Storage::disk('public')->url('client-photos/').$client->fotografia}}" style="width:80%">
                    </div>
                </div>



                <hr><br>


                <div class="row">
                    <div class="col">

                        {{-- Contactos --}}
                        <div>Telefone (principal): {{$client->telefone1}}</div><br>

                        <div>Telefone (secundário): {{$client->telefone2}}</div><br>

                        <div>E-mail: {{$client->email}}</div><br>
                    </div>


                    <div class="col">

                        {{-- Contactos --}}
                        <div>Morada de residência (Portugal):</div><div>{{$client->moradaResidencia}}</div><br>

                    </div>


                </div>

            </div>


            {{-- Conteudo: Contactos --}}
            <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">





                {{-- Contactos dos PAIS --}}
                <div class="row mt-4">
                    <div class="col">
                        <label for="nomePai">Nome do pai:</label><br>
                        <input type="text" class="form-control" name="nomePai" id="nomePai" placeholder=""><br>

                        <label for="telefonePai">Telefone do pai:</label><br>
                        <input type="text" class="form-control" name="telefonePai" id="telefonePai" placeholder=""><br>

                        <label for="emailPai">E-mail do pai:</label><br>
                        <input type="text" class="form-control" name="emailPai" id="emailPai" placeholder=""><br>
                    </div>

                    <div class="col">
                        <label for="nomeMae">Nome da mãe:</label><br>
                        <input type="text" class="form-control" name="nomeMae" id="nomeMae" placeholder=""><br>

                        <label for="telefoneMae">Telefone da mãe:</label><br>
                        <input type="text" class="form-control" name="telefoneMae" id="telefoneMae" placeholder=""><br>

                        <label for="emailMae">E-mail da mãe:</label><br>
                        <input type="text" class="form-control" name="emailMae" id="emailMae" placeholder=""><br>
                    </div>

                </div>

            </div>


            {{-- Conteudo: Moradas --}}
            <div class="tab-pane fade" id="adresses" role="tabpanel" aria-labelledby="adresses-tab">

                <div class="row mt-4">
                    <div class="col">
                        {{-- Morada de residência em Portugal --}}
                        <label for="moradaResidencia">Morada de residência em Portugal:</label><br>
                        <input type="text" class="form-control" name="moradaResidencia" id="moradaResidencia" placeholder=""><br>
                    </div>

                    <div class="col">
                        {{-- Cidade de Origem  --}}
                        <label for="morada">Cidade da Instituição de Origem:</label><br>
                        <input type="text" class="form-control" name="cidadeInstituicaoOrigem" id="morada" placeholder=""><br>
                    </div>
                </div>


                <div class="row mt-4">

                    <div class="col">
                        {{-- Morada de residência no pais de origem --}}
                        <label for="morada">Morada no pais de origem:</label><br>
                        <input type="text" class="form-control" name="morada" id="morada" placeholder=""><br>
                    </div>

                    <div class="col">
                        {{-- Cidade de Origem  --}}
                        <label for="morada">Cidade de origem:</label><br>
                        <input type="text" class="form-control" name="cidade" id="morada" placeholder=""><br>
                    </div>

                </div>



            </div>


            {{-- Conteudo: Documentação --}}
            <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">

                {{-- INUPUT IDENTIFICAÇÃO --}}
                <div class="row">
                    <div class="col">
                        <label for="numCCid">Número de cartão de cidadão:</label><br>
                        <input type="text" class="form-control" name="numCCid" id="numCCid" placeholder=""><br>
                    </div>
                    <div class="col">
                        <label for="NIF">Número de identificação fiscal:</label><br>
                        <input type="text" class="form-control" name="NIF" id="NIF" placeholder=""><br>
                    </div>
                </div>




                {{-- INUPUTS DADOS DE PASSAPORTE --}}
                <div class="row mt-4">

                    <div class="col">
                        {{-- INUPUT numPassaport --}}
                        <label for="numPassaport">Numero do passaporte:</label><br>
                        <input type="text" class="form-control" name="numPassaport" id="numPassaport" placeholder=""><br>
                    </div>
                    <div class="col">
                        {{-- INUPUT dataValidPP --}}
                        <label for="dataValidPP">Data de validade do passaporte:</label><br>
                        <input type="date" class="form-control" name="dataValidPP" id="dataValidPP" placeholder=""><br>
                    </div>
                </div>

                <div class="row">

                    <div class="col">
                        {{-- INUPUT numPassaport --}}
                        <label for="passaportPaisEmi">Pais emissor do passaporte:</label><br>
                        <select id="passaportPaisEmi" name="passaportPaisEmi" class="form-control">
                            @include('clients.partials.countries');
                        </select>
                    </div>
                    <div class="col">
                        {{-- INUPUT dataValidPP --}}
                        <label for="localEmissaoPP">Local de emissão do passaporte:</label><br>
                        <input type="text" class="form-control" name="localEmissaoPP" id="localEmissaoPP" placeholder=""><br>
                    </div>
                </div>


                {{-- DADOS FINANCEIROS --}}
                <div class="row mt-4">
                    <div class="col">
                        <label for="IBAN" class="mr-2">IBAN: </label><small>(25 caracteres)</small><br>
                        <input type="text" class="form-control" name="IBAN" id="IBAN" placeholder=""><br>

                        <label for="obsFinanceiras">Observações Financeiras:</label><br>
                        <textarea name="obsFinanceiras" id="obsFinanceiras" rows="5" class="form-control"></textarea>
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
