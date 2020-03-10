<ul class="nav nav-tabs" id="myTab" role="tablist">

    {{-- MENU: Informação pessoal --}}
    <li class="nav-item">
      <a class="nav-link active" id="pessoal-tab" data-toggle="tab" href="#pessoal" role="tab" aria-controls="contacts"
        aria-selected="true">Informação pessoal</a>
    </li>


    {{-- MENU: Dados académicos --}}
    <li class="nav-item">
      <a class="nav-link" id="school-tab" data-toggle="tab" href="#school" role="tab" aria-controls="school"
        aria-selected="false">Dados académicos</a>
    </li>


    {{-- MENU: Contactos --}}
    <li class="nav-item">
        <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts"
          aria-selected="false">Contactos</a>
    </li>


    {{-- MENU: Moradas --}}
    <li class="nav-item">
        <a class="nav-link" id="adresses-tab" data-toggle="tab" href="#adresses" role="tab" aria-controls="adresses"
          aria-selected="false">Moradas</a>
    </li>
    


    {{-- MENU: Documentação --}}
    <li class="nav-item">
        <a class="nav-link" id="documentation-tab" data-toggle="tab" href="#documentation" role="tab" aria-controls="documentation"
          aria-selected="false">Documentação</a>
    </li>       
    
  </ul>



  
  <div class="tab-content" id="myTabContent">

    {{-- Conteudo: Informação pessoal --}}
    <div class="tab-pane fade show active" id="pessoal" role="tabpanel" aria-labelledby="pessoal-tab">
        <div class="row pt-4">
            <div class="col">

                {{-- INPUT nome --}}
                <label for="nome">Nome:</label><br>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Insira o nome do aluno"><br>

                {{-- INPUT apelido --}}
                <label for="apelido">Apelido:</label><br>
                <input type="text" class="form-control" name="apelido" id="apelido" placeholder="Insira o apelido do aluno"><br>

                {{-- INPUT dataNasc --}}
                <label for="dataNasc">Data de nascimento:</label><br>
                <input type="date" class="form-control" name="dataNasc" id="dataNasc" style="width:250px"><br>
            </div>

            <div class="col col-4 text-center">
                
                {{-- INPUT fotografia --}}
                <div ><label for="fotografia">Fotografia:</label></div>
                <img class="m-2 p-1 rounded bg-white shadow-sm" src="{{asset('storage/user-photos/user.jpg')}}" style="width:80%">
                <a href="#" class="top-button">Procurar ficheiro</a>
            </div>   
        </div>

        <div class="row">
            <div class="col-md-12">
                {{-- INPUT obsPessoais --}}
                <label for="obsPessoais">Observações pessoais:</label><br>
                <textarea name="obsPessoais" id="obsPessoais" rows="5" class="form-control"></textarea>
              </div>
        </div>

    </div>



    
    {{-- Conteudo: Dados académicos --}}
    <div class="tab-pane fade" id="school" role="tabpanel" aria-labelledby="school-tab">
        school
    </div>


    {{-- Conteudo: Contactos --}}
    <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        Contacts
    </div>


    {{-- Conteudo: Moradas --}}
    <div class="tab-pane fade" id="adresses" role="tabpanel" aria-labelledby="adresses-tab">
        Adresses
    </div>


    {{-- Conteudo: Documentação --}}
    <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation-tab">
        documentation
    </div>    
    
    

  </div>