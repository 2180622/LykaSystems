@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Reportar Problema')

{{-- CSS Style Link --}}
@section('styleLinks')
{{-- <link href="{{asset('/css/dashboard.css')}}" rel="stylesheet"> --}}
@endsection

{{-- Page Content --}}
@section('content')
<div class="container mt-2">
    <div class="float-right">
        <a href="#" class="top-button">reportar problema</a>
    </div>
    <br>
    <div>
        <h1>reportar problema</h1>
    </div>
</div>

@endsection
