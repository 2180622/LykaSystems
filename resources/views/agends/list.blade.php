@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Agenda')


{{-- Estilos de CSS --}}
@section('styleLinks')

    <link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">
    <link href="{{asset('css/agends.css')}}" rel="stylesheet"/>
    <link href="{{asset('vendor/fullcalendar/core/main.css')}}" rel='stylesheet'/>
    <link href="{{asset('vendor/fullcalendar/daygrid/main.css')}}" rel='stylesheet'/>
    <link href="{{asset('vendor/fullcalendar/list/main.css')}}" rel='stylesheet'/>
    <link href="{{asset('vendor/fullcalendar/timegrid/main.css')}}" rel='stylesheet'/>
@endsection


{{-- Conteudo da Página --}}
@section('content')
    @include('agends.partials.modal')
    <!-- MODAL DE INFORMAÇÔES -->

    <div class="container mt-2 ">

        {{-- Navegação --}}
        <div class="float-left buttons">
            <a href="javascript:history.go(-1)" title="Voltar">
                <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
            </a>
            <a href="javascript:window.history.forward();" title="Avançar">
                <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
            </a>
        </div>

        <button type="button" class="float-right top-button" data-toggle="modal" data-target="#modalCalendar">
            Novo Evento
        </button>


        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Agenda</h6>
            </div>

            <br>

            <div id='calendar'></div>


        </div>
    </div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')
    <script src="{{asset('/vendor/fullcalendar/core/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/rrule.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/interaction/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/daygrid/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/core/locales/pt.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/timegrid/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/list/main.js')}}"></script>
    <script src="{{asset('/vendor/fullcalendar/rrule/main.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="{{asset('/js/eventAgend.js')}}"></script>

    <script>
        var dateToday = new Date();
        var dd = String(dateToday.getDate()).padStart(2, '0');
        var mm = String(dateToday.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = dateToday.getFullYear();

        dateToday = mm + '/' + dd + '/' + yyyy;

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'rrule'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                dateToday,
                locale: 'pt',
                editable: true,
                navLinks: true,
                eventLimit: true,
                selectable: true,
                events: [
                        @foreach($agends as $agend)
                    {
                        title: '{{ $agend->titulo }}',
                        start: '{{ $agend->dataInicio }}',
                        end: '{{ $agend->dataFim }}',
                        color: '{{ $agend->cor }}',
                    },
                    @endforeach
                ],
                extraParams: function () {
                    return {
                        cachebuster: new Date().valueOf()
                    };
                },
                eventClick: function (arg) {
                    $("modalCalendar").modal('show');
                }
            });

            calendar.render();
        });
    </script>

@endsection
