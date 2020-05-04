@component('mail::message')
Olá **{{$name}}**,

O seu caminho com a Lyka Systems está prestes a começar, sendo apenas necessário seguir os passos abaixos indicados.

Para aceder à sua conta basta clicar neste link **<a href="{{$link}}">{{$link}}</a>** e em seguida inserir o código de autenticação que se encontra abaixo.

@component('mail::panel')
**{{$key}}**
@endcomponent

Se não sabe como recebeu este e-mail, sugerimos que apague o mesmo.

Obrigado e bom trabalho,

Lyka Systems.
@endcomponent
