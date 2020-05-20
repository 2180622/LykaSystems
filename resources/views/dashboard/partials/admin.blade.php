<div class="row cards-group">
    <div class="col-md-4">
        <a href="{{route('clients.index')}}">
            <div class="card-navigation">
                <div class="help-button" id="tooltipClient" data-toggle="tooltip" data-placement="top"
                     title="O número apresentado neste cartão representa o número total de clientes registados no sistema.">
                    <span>
                        ?
                    </span>
                </div>
                <div class="info">
                    <p class="number">{{count($clientes)}}</p>
                    <p class="word">clientes</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{route('universities.index')}}">
            <div class="card-navigation">
                <div class="help-button" id="tooltipUni" data-toggle="tooltip" data-placement="top"
                     title="O número apresentado neste cartão representa o número total de universidades registadas no sistema.">
                    <span>
                        ?
                    </span>
                </div>
                <div class="info">
                    <p class="number">{{count($universidades)}}</p>
                    <p class="word">universidades</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{route('agents.index')}}">
            <div class="card-navigation">
                <div class="help-button" id="tooltipAgent" data-toggle="tooltip" data-placement="top"
                     title="O número apresentado neste cartão representa o número total de agentes registados no sistema.">
                    <span>
                        ?
                    </span>
                </div>
                <div class="info">
                    <p class="number">{{count($agentes)}}</p>
                    <p class="word">agentes</p>
                </div>
            </div>
        </a>
    </div>
</div>
</div>
<br>
<div class="report">
    <div class="row">
        <div class="title col-md-10">
            <h6>Relatório e contas</h6>
        </div>
        <div class="col-md-2 text-right">
            <button type="button" name="button">ver todos</button>
        </div>
    </div>
    <div class="row graphic-group">
        <div class="col-md-8">
            <div class="graphic">

            </div>
        </div>
        <div class="col-md-4">
            <div class="graphic">
                @if($agends!=null)
                    <div class="table-responsive " style="overflow:hidden">
                        <table nowarp class="table table-borderless" row-border="0"
                               style="overflow:hidden;">
                            {{-- Cabeçalho da tabela --}}
                            <thead>
                            @foreach ($todayAgends as $agend)
                                <tr>
                                    <th colspan="2">Todos os eventos {{ date('d/m/Y', strtotime($agend->dataInicio)) }}</th>
                                </tr>
                            </thead>
                            {{-- Corpo da tabela --}}
                            <tbody>

                            <tr href="#">
                                <td style="padding:0!important"><i class="fas fa-circle ml-3 mt-2"
                                                                   style="color:{{$agend->cor}}"></i></td>
                                {{-- Título --}}
                                <td style="padding: 0 3px 0 0!important"><a>{{$agend->titulo}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="border rounded bg-light p-3">
                        <div class="text-muted"><small>(sem registos)</small></div>
                    </div>
                    <br>
                @endif
            </div>
        </div>
    </div>


    <div class="title  mt-5 ">
        <h6>Espaço de aramazenamento</h6>
    </div>

    <div class="row ">
        <div class="col">
            <div>
                Espaço de armazenamento ocupado: {{$size}}
                <br>Disponivel: XX
                <br> Gráfico ?
            </div>
        </div>

    </div>



