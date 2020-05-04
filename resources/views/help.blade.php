@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ajuda')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('/css/report.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')
    <div class="container mt-2">
        <div class="float-left buttons">
            <a href="javascript:history.go(-1)" title="Voltar">
                <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
            </a>
            <a href="javascript:window.history.forward();" title="Avançar">
                <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
            </a>
        </div>

        <div class="float-right">
            <a href="{{route('report')}}" class="top-button">reportar problema</a>
        </div>

        <br><br>

        <div class="cards-navigation">
            <div class="report-card shadow-sm">
                <form action="" method="POST" enctype="multipart/form-data">

                </form>
            </div>
        </div>

    </div>


@endsection
