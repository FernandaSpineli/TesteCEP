<h1>Detalhes do endereço {{ $address->cep }}</h1>

<x-alert/>
<ul>
    <li>Cep: {{ $address->cep }}</li>
    <li>Bairro: {{ $address->bairro }}</li>
    <li>Rua: {{ $address->logradouro }}</li>
    <li>Cidade: {{ $address->localidade }}</li>
    <li>Estado: {{ $address->uf }}</li>
    <li>DDD: {{ $address->ddd }}</li>
</ul>
