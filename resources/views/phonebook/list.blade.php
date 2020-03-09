@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Lista telefónica')

{{-- CSS Style Link --}}
@section('styleLinks')
{{-- <link href="{{asset('/css/NOME_DO_FICHEIRO.css')}}" rel="stylesheet"> --}}
@endsection

{{-- Page Content --}}
@section('content')

{{-- All the content should be insert here --}}





<div class="d-sm-flex align-items-right justify-content-between mb-4" >
    <p style="font-weight:700;font-size:24px" >Lista telefónica</p>


    <div>
        <a href="#" class="btn btn-sm btn-primary shadow-sm "><i class="fas fa-plus text-white-50 mr-2"></i> Adicionar contacto</a>

    </div>



</div>




<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts"
        aria-selected="true">Contactos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#favorites" role="tab" aria-controls="favorites"
        aria-selected="false">Favoritos</a>
    </li>

  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="contacts" role="tabpanel" aria-labelledby="favorites-tab">Raw denim you
      probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master
      cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro
      keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip
      placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
      qui.</div>
    <div class="tab-pane fade" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">Food truck fixie
      locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit,
      blog sartorial </div>

  </div>


@endsection

{{-- Scripts --}}
@section('scripts')

<script src="{{asset('/js/script-phonebook.js')}}"></script>
@endsection
