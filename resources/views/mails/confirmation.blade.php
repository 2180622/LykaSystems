@component('mail::message')
Olá **{{$name}}**,

Clique no botão abaixo para ativar a sua conta LYKA.
@component('mail::button', ['url' => $link])
Ativar Conta
@endcomponent
Bom trabalho,
LYKA SYSTEMS.
@endcomponent
