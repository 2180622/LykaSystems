<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota de pagamento - Lyka Systems</title>
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <style media="screen">
        body {
            padding: 5px 30px;
        }

        img {
            width: 130px;
        }

        #text-beneficiario {
            font-size: 10pt;
            color: #5B5B5B;
            font-family: 'Lato', sans-serif;
        }

        #nome {
            color: #171717 !important;
            font-size: 11pt;
        }

        table {
            width: 100%;
            color: #000;
        }

        table thead tr th {
            text-transform: uppercase !important;
            font-size: 11pt;
        }

        table thead th {
            padding: 10px 5px !important;
            border-bottom: 2px black solid;
        }
    </style>
    <br>
    <div class="header row">
        <div class="col-md-6">
            <img src="{{asset('/media/logo.png')}}" alt="Logótipo - Estudar Portugal">
        </div>
        <div class="col-md-6">
            <div class="text-right" id="text-beneficiario">
                <p class="mb-1" id="nome">Tiago Oliveira</p>
                <p class="mb-0">Rua das Oliveiras Verdes</p>
                <p class="mb-0">Edifício Amarelo, Nº13</p>
                <p class="mb-0">3100-231 - Leiria</p>
            </div>
        </div>
    </div>

    <table class="mt-3">
        <thead>
            <tr>
                <th id="hey">Descrição do pagamento</th>
                <th>Data de pagamento</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tr>
            <td>Propinas</td>
            <td>15/05/2020</td>
            <td>500,00€</td>
        </tr>
        <tr>
            <td>Matrícula</td>
            <td>12/05/2020</td>
            <td>75,00€</td>
        </tr>
        <tr>
            <td>Outras importâncias</td>
            <td>02/05/2020</td>
            <td>625,00€</td>
        </tr>
    </table>

    <div class="info mt-5">
        <div>
            <p class="font-weight-bold">Informações</p>
            <p class="mb-1">Pagamento: 236584</p>
            <p class="mb-1">Data de emissão: 16/05/2020</p>
        </div>
        <br>
        <div>
            <p class="font-weight-bold">Contactos</p>
            <p class="mb-1">Rua de Leiria, 3000-241, Leiria</p>
            <p class="mb-1">+351 244 523 698 | estudarportugal
                @gmail.com</p>
                <p class="mb-1">www.estudarportugal.com</p>
        </div>
        <br>
        <div>
            <p class="font-weight-bold">Termos e condições</p>
            <p>Aque repellat quo cum tenetur sit ullam ut dolore impedit sint non.</p>
        </div>
    </div>
</body>

</html>
