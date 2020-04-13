@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Ficha de produto')

{{-- CSS Style Link --}}
@section('styleLinks')

@endsection



{{-- Page Content --}}
@section('content')

    <div class="container mt-2">
        {{-- Navegação --}}
        <div class="float-left">
            <a href="javascript:history.go(-1)" title="Voltar"><i
                    class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
            <a href="javascript:window.history.forward();" title="Avançar"><i
                    class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
        </div>
        <div class="float-right">
            <a href="{{route('produtos.edit',$produto)}}" class="top-button mr-2">Editar informação</a>
            <a href="{{route('produtos.print',$produto)}}" target="_blank" class="top-button">Imprimir</a>
        </div>

        <br><br>

        <div class="cards-navigation">
            <div class="title">
                <h6>Ficha de produto</h6>
            </div>
            <br>



            <div class="row font-weight-bold border p-2 pt-3 pb-3" style="color:#6A74C9">

                <div class="col p-2">

                    <div><span class="text-secondary ">Tipo:</span> {{$produto->tipo}}</div><br>

                    <div><span class="text-secondary">Descrição:</span> {{$produto->descricao}}</div><br>

                    <div><span class="text-secondary ">Ano Académico: </span>{{$produto->anoAcademico}}</div><br>

                    <div><span class="text-secondary">Valor:</span> {{$produto->valorTotal.'€'}}</div>

                </div>

                <div class="col">
                    <div><span class="text-secondary">Cliente: 
                        <a class="name_link" href="{{route('clients.show',$produto->cliente)}}">
                            {{$produto->cliente->nome.' '.$produto->cliente->apelido}}</span>
                        </a>
                    </div><br>

                    <div><span class="text-secondary">Universidade: 
                        <a class="name_link" href="{{route('universities.show',$produto->universidade1)}}">
                            {{$produto->universidade1->nome}}</span>
                        </a>
                    </div><br>

                    @if($produto->idUniversidade2)
                        <div><span class="text-secondary">2ª Universidade: 
                            <a class="name_link" href="{{route('universities.show',$produto->universidade2)}}">
                                {{$produto->universidade2->nome}}</span>
                            </a>
                        </div><br>
                    @endif

                    <div><span class="text-secondary">Agente: 
                        <a class="name_link" href="{{route('agents.show',$produto->agente)}}">
                            {{$produto->agente->nome.' '.$produto->agente->apelido}}</span>
                        </a>
                    </div><br>

                    @if($produto->idSubAgente)
                        <div><span class="text-secondary">Sub-Agente: 
                            <a class="name_link" href="{{route('agents.show',$produto->subAgente)}}">
                                {{$produto->subAgente->nome.' '.$produto->subAgente->apelido}}</span>
                            </a>
                        </div><br>
                    @endif

                    <div class="text-muted"><small>Adicionado: {{ date('d-M-y', strtotime($produto->created_at)) }}</small></div>

                    <div class="text-muted"><small>Ultima atualização: {{ date('d-M-y', strtotime($produto->updated_at)) }}</small></div>



                </div>

            </div>

            <ul class="nav nav-tabs mt-5 mb-4" id="myTab" role="tablist">
                @php
                    $numfase = 1;
                @endphp
                @foreach($Fases as $fase)
                    <li class="nav-item " style="width:25%">
                        @if($numfase == 1)
                            <a class="nav-link active" id="{{'fase'.$numfase.'-tab'}}" data-toggle="tab" href="#{{'fase'.$numfase}}" role="tab"
                            aria-controls="{{'fase'.$numfase}}" aria-selected="false">{{'Fase '.$numfase}}</a>
                        @else
                            <a class="nav-link" id="{{'fase'.$numfase.'-tab'}}" data-toggle="tab" href="#{{'fase'.$numfase}}" role="tab"
                            aria-controls="{{'fase'.$numfase}}" aria-selected="false">{{'Fase '.$numfase}}</a>
                        @endif
                    </li>
                    @php
                        $numfase++;
                    @endphp
                @endforeach
            </ul>

            <div class="tab-content p-2 " id="myTabContent">
                @php
                    $numfase = 0;
                @endphp
                @foreach($Fases as $fase)
                    @php
                        $numfase++;
                        $Relacoes = $fase->responsabilidade->relacao;
                        $DocsAcademicos = $fase->docAcademico;
                        $DocsPessoais = $fase->docPessoal;
                        $DocsTransacao = $fase->docTransacao;
                        $DocsStock = $fase->faseStock->docStock;
                        $DocsRespons = $fase->pagoResponsabilidade;
                    @endphp
                    @if($numfase == 1)
                        <div class="tab-pane fade active show" id="{{'fase'.$numfase}}" role="tabpanel" aria-labelledby="{{'fase'.$numfase.'-tab'}}">
                    @else
                        <div class="tab-pane fade" id="{{'fase'.$numfase}}" role="tabpanel" aria-labelledby="{{'fase'.$numfase.'-tab'}}">
                    @endif
                        <div class="row">

                            <div class="col">
                                <div><span><b>Info</b></span></div><br>

                                <div><span class="text-secondary">Tipo:</span> {{$fase->descricao}}</div><br>

                                <div><span class="text-secondary">Data de vencimento:</span> {{$fase->dataVencimento}}</div><br>

                                <div><span class="text-secondary">Valor da fase:</span> {{$fase->valorFase.'€'}}</div><br>

                                <div><span><b>Responsabilidades</b></span></div><br>

                                <div><span class="text-secondary">Para cliente: </span> {{$fase->responsabilidade->valorCliente.'€'}}</div><br>

                                <div><span class="text-secondary"> - Estado:</span>
                                    @if($fase->responsabilidade->verificacaoPagoCliente)
                                        <span class="text-success">Pago</span>
                                    @else
                                        <span class="text-danger">Não pago</span>
                                    @endif
                                </div><br>

                                <div><span class="text-secondary">Para agente: </span> {{$fase->responsabilidade->valorAgente.'€'}}</div><br>

                                <div><span class="text-secondary"> - Estado:</span>
                                    @if($fase->responsabilidade->verificacaoPagoAgente)
                                        <span class="text-success">Pago</span>
                                    @else
                                        <span class="text-danger">Não pago</span>
                                    @endif
                                </div><br>

                                @if($fase->responsabilidade->valorSubAgente)
                                    <div><span class="text-secondary">Para sub-agente: </span> {{$fase->responsabilidade->valorSubAgente.'€'}}</div><br>

                                    <div><span class="text-secondary"> - Estado:</span>
                                        @if($fase->responsabilidade->verificacaoPagoSubAgente)
                                            <span class="text-success">Pago</span>
                                        @else
                                            <span class="text-danger">Não pago</span>
                                        @endif
                                    </div><br>
                                @endif
                                <div><span class="text-secondary">Para universidade: </span> {{$fase->responsabilidade->valorUniversidade1.'€'}}</div><br>

                                <div><span class="text-secondary"> - Estado:</span>
                                    @if($fase->responsabilidade->verificacaoPagoUni1)
                                        <span class="text-success">Pago</span>
                                    @else
                                        <span class="text-danger">Não pago</span>
                                    @endif
                                </div><br>
                                @if($fase->responsabilidade->valorUniversidade2)
                                    <div><span class="text-secondary">Para 2ª universidade: </span> {{$fase->responsabilidade->valorUniversidade2.'€'}}</div><br>

                                    <div><span class="text-secondary"> - Estado:</span>
                                        @if($fase->responsabilidade->verificacaoPagoUni2)
                                            <span class="text-success">Pago</span>
                                        @else
                                            <span class="text-danger">Não pago</span>
                                        @endif
                                    </div><br>
                                @endif
                                @if($Relacoes)
                                    @foreach($Relacoes as $relacao)
                                        <div><span class="text-secondary">Fornecedor {{$relacao->fornecedor->nome}}: </span> {{$relacao->valor.'€'}}</div><br>

                                        <div><span class="text-secondary"> - Estado:</span>
                                            @if($relacao->verificacaoPago)
                                                <span class="text-success">Pago</span>
                                            @else
                                                <span class="text-danger">Não pago</span>
                                            @endif
                                        </div><br>
                                    @endforeach
                                @endif
                            </div>
                            
                            <div class="col">
                                @if($DocsPessoais->toArray())
                                    <div><span><b>Documentos Pessoais</b></span></div><br>
                                    @foreach($DocsStock as $documento)
                                        @if($documento->tipo == 'Pessoal')
                                            @php
                                                $existe = false;
                                            @endphp
                                            <div><span class="text-secondary">{{$documento->tipoPessoal}}: </span>
                                            @foreach($DocsPessoais as $docpessoal)
                                                @if($documento->tipoPessoal == $docpessoal->tipo)
                                                    {{'<esta aqui>'}}</div><br>
                                                    <div><span class="text-secondary"> - Estado:</span>
                                                        @if($docpessoal->verificacao)
                                                            <span class="text-success">Válido</span>
                                                        @else
                                                            <span class="text-danger">Inválido</span>
                                                        @endif
                                                    </div><br>
                                                    @php
                                                        $existe = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if(!$existe)
                                                {{'<adicionar>'}}</div><br>
                                                <div><span class="text-secondary"> - Estado:</span><span class="text-danger">Inválido</span></div><br>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    @php
                                        $num = 0;
                                    @endphp
                                    @foreach($DocsStock as $documento)
                                        @if($documento->tipo == 'Pessoal')
                                            @if($num==0)
                                                <div><span><b>Documentos Pessoais</b></span></div><br>
                                                @php
                                                    $num++;
                                                @endphp
                                            @endif
                                            <div><span class="text-secondary">{{$documento->tipoPessoal}}: </span>{{'<adicionar>'}}</div><br>
                                            <div><span class="text-secondary"> - Estado:</span><span class="text-danger">Inválido</span></div><br>
                                        @endif
                                    @endforeach
                                @endif
                                @if($DocsAcademicos->toArray())
                                    <div><span><b>Documentos Académicos</b></span></div><br>
                                    @foreach($DocsStock as $documento)
                                        @if($documento->tipo == 'Academico')
                                            @php
                                                $existe = false;
                                            @endphp
                                            <div><span class="text-secondary">{{$documento->tipoAcademico}}: </span>
                                            @foreach($DocsAcademicos as $docacademico)
                                                @if($documento->tipoAcademico == $docacademico->tipo)
                                                    {{'<esta aqui>'}}</div><br>
                                                    <div><span class="text-secondary"> - Estado:</span>
                                                        @if($docacademico->verificacao)
                                                            <span class="text-success">Válido</span>
                                                        @else
                                                            <span class="text-danger">Inválido</span>
                                                        @endif
                                                    </div><br>
                                                    @php
                                                        $existe = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if(!$existe)
                                                {{'<adicionar>'}}</div><br>
                                                <div><span class="text-secondary"> - Estado:</span><span class="text-danger">Inválido</span></div><br>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    @php
                                        $num = 0;
                                    @endphp
                                    @foreach($DocsStock as $documento)
                                        @if($documento->tipo == 'Academico')
                                            @if($num==0)
                                                <div><span><b>Documentos Académicos</b></span></div><br>
                                                @php
                                                    $num++;
                                                @endphp
                                            @endif
                                            <div><span class="text-secondary">{{$documento->tipoAcademico}}: </span>{{'<adicionar>'}}</div><br>
                                            <div><span class="text-secondary"> - Estado:</span><span class="text-danger">Inválido</span></div><br>
                                        @endif
                                    @endforeach
                                @endif
                                <div><span><b>Documentos Transações</b></span></div><br>
                                @if($DocsTransacao->toArray())
                                    @foreach($DocsTransacao as $documento)
                                        <div><span class="text-secondary">{{$documento->tipoPessoal}}:</span>{{'<esta aqui>'}}</div><br>
                                        <div><span class="text-secondary"> - Data Operação: </span> {{$documento->valorRecebido.'€'}}</div><br>
                                        <div><span class="text-secondary"> - Data Recebido: </span> {{$documento->valorRecebido.'€'}}</div><br>
                                        <div><span class="text-secondary"> - Valor Recebido: </span> {{$documento->valorRecebido.'€'}}</div><br>
                                        <div><span class="text-secondary"> - Estado:</span>
                                            @if($docacademico->verificacao)
                                                <span class="text-success">Recebido</span>
                                            @else
                                                <span class="text-danger">Não Recebido</span>
                                            @endif
                                        </div><br>
                                        @php
                                            $existe = true;
                                        @endphp
                                    @endforeach
                                @else 
                                    <div><span class="text-secondary">Sem documentos de transação {{'<adicionar>'}}</span></div><br>
                                @endif
                                <div><span><b>Pagamentos responsabilidades</b></span></div><br>
                                @if($DocsRespons)
                                    @foreach($DocsRespons as $documento)
                                        <div><span class="text-secondary">{{$documento->tipoPessoal}}:</span>{{'<esta aqui>'}}</div><br>
                                        <div><span class="text-secondary"> - Nome autor: </span> {{$documento->nomeAutor.'€'}}</div><br>
                                        <div><span class="text-secondary"> - Data Operação: </span> {{$documento->data.'€'}}</div><br>
                                        <div><span class="text-secondary"> - Valor Recebido: </span> {{$documento->valorRecebido.'€'}}</div><br>
                                        <div><span class="text-secondary"> - Conta: </span>
                                            <a class="name_link" href="#{{--route('produtos.show',$produto)--}}">{{$documento->conta->numConta}}</a>
                                        </div><br>
                                        @php
                                            $existe = true;
                                        @endphp
                                    @endforeach
                                @else 
                                    <div><span class="text-secondary">Sem pagamentos de responsabilidades {{'<adicionar>'}}</span></div><br>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

{{-- Scripts --}}
@section('scripts')
    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection
