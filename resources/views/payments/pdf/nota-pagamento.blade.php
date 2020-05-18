<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Nota de pagamento - Lyka Systems</title>
</head>

<style media="screen">
    img {
        width: 130px;
    }
</style>

<body>
    <img src="{{asset('/media/logo.png')}}" alt="Logótipo - Estudar Portugal">
    <p>{{$responsabilidade->cliente->nome.' '.$responsabilidade->cliente->apelido}}</p>
</body>

</html>
