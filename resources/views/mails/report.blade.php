@component('mail::message')
Olá Lyka Systems,

O seguinte e-mail foi enviado através da platafora Lyka Systems pelo utilizador **{{$name}}**.
Abaixo pode verificar alguns dos contactos que o cliente disponibilizou.

Endereço eletrónico: **{{$email}}**

Telemóvel: **{{$phone}}**


De seguida pode encontrar o relatório a descrever o problema que o utilizador está a enfrentar.

@component('mail::panel')
{{$text}}
@endcomponent

Apenas lembramos que o utilizador espera uma mensagem em retorno com uma solução futura ou presente.

Obrigado,

**{{$name}}**
@endcomponent
