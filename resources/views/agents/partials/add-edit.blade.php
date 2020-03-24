<ul class="nav nav-tabs" id="myTab" role="tablist">
    {{-- MENU: Informação pessoal --}}
    <li class="nav-item">
        <a class="nav-link active" id="pessoal-tab" data-toggle="tab" href="#pessoal" role="tab" aria-controls="contacts" aria-selected="true">Informação pessoal</a>
    </li>

    {{-- MENU: Contactos --}}
    <li class="nav-item">
        <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">Contactos</a>
    </li>

    {{-- MENU: Documentação/Moradas --}}
    <li class="nav-item">
        <a class="nav-link" id="adresses-tab" data-toggle="tab" href="#adresses" role="tab" aria-controls="adresses" aria-selected="false">Documentação/Morada</a>
    </li>
</ul>

<div class="tab-content p-2 mt-3" id="myTabContent">

    {{-- Conteudo: Informação pessoal --}}
    <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
        <div class="row">
            <div class="col">
                {{-- INPUT nome --}}
                <label for="nome">Nome:</label><br>
                <input type="text" class="form-control" name="nome" id="nome"><br>

                {{-- INPUT apelido --}}
                <label for="apelido">Apelido:</label><br>
                <input type="text" class="form-control" name="apelido" id="apelido"><br>

                {{-- INPUT paisNaturalidade --}}
                <label for="paisNaturalidade">Naturalidade:</label><br>
                <select id="paisNaturalidade" name="pais" class="form-control">
                    @include('clients.partials.countries');
                </select><br>

                {{-- INPUT dataNasc --}}
                <label for="dataNasc">Data de nascimento:</label><br>
                <input type="date" class="form-control" name="dataNasc" id="dataNasc" style="width:250px"><br>
            </div>

            <div class="col col-4 text-center">
                {{-- INPUT fotografia --}}
                <div><label for="fotografia">Fotografia:</label></div>
                <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{asset('storage/default-photos/addImg.png')}}" style="width:80%">
                <a href="#" class="top-button">Procurar ficheiro</a>
            </div>
        </div>
    </div>


    {{-- Conteudo: Contactos --}}
    <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        {{-- Contactos PESSOAIS --}}
        <div class="row">
            <div class="col">
                <label for="telefone1">Telefone pessoal:</label><br>
                <input type="text" class="form-control" name="telefoneW" id="telefone1" placeholder=""><br>
            </div>
            <div class="col">
                <label for="telefone2">Telemóvel pessoal:</label><br>
                <input type="text" class="form-control" name="telefone2" id="telefone2" placeholder=""><br>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="email">E-mail pessoal:</label><br>
                <input type="text" class="form-control" name="email" id="email" placeholder=""><br>
            </div>
        </div>

    </div>
    {{-- Conteudo: Moradas --}}
    <div class="tab-pane fade" id="adresses" role="tabpanel" aria-labelledby="adresses-tab">

        <div class="row mt-4">
            <div class="col">
                {{-- Morada de residência em Portugal --}}
                <label for="moradaResidencia">Morada:</label><br>
                <input type="text" class="form-control" name="morada" id="moradaResidencia" placeholder=""><br>
            </div>

            <div class="col">
                {{-- Cidade de Origem  --}}
                <label for="morada">Número de Identificação Fiscal:</label><br>
                <input type="text" class="form-control" name="NIF" id="nif" placeholder=""><br>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col">
                {{-- Morada de residência no pais de origem --}}
                <label for="morada">Tipo de Agente:</label><br>
                <input type="text" class="form-control" name="tipo" id="morada" placeholder=""><br>
            </div>
        </div>
    </div>
</div>
