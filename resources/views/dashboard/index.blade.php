@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Página Inicial')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/dashboard.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')
<div class="container mt-2">

    <div class="float-right">
        <a href="{{route('report')}}" class="top-button">reportar problema</a>
    </div>
    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Navegação rápida</h6>
        </div>
        <br>


        @if (Auth::user()->tipo == "admin")
            @include('dashboard.partials.admin')
        @else
            @include('dashboard.partials.agent')
        @endif



    </div>


</div>

@endsection

{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>
@endsection
