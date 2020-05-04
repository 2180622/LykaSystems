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



