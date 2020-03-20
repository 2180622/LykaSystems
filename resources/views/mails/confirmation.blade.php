@component('mail::message')
Olá **{{$name}}**,

A Lyka Systems informa que você foi adicionado(a) na aplicação. Para aceder à sua conta basta clicar no botão abaixo e seguir os passos que serão fornecidos na aplicação.
@component('mail::button', ['url' => $link])
Ativar Conta
@endcomponent
Bom trabalho,
Lyka Systems.
@endcomponent
