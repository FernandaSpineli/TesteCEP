<h1>Listagem dos endereços</h1>

<x-alert/>

<table>
    <thead>
            <th>Cep</th>
            <th>Rua</th>
            <th>Complemento</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>DDD</th>
            <th></th>
    </thead>
    <tbody>
        @foreach ($addresses->items() as $address)
            <tr>
                <td>{{ $address->cep }}</td>
                <td>{{ $address->logradouro }}</td>
                <td>{{ $address->complemento }}</td>
                <td>{{ $address->bairro }}</td>
                <td>{{ $address->localidade }}</td>
                <td>{{ $address->uf }}</td>
                <td>{{ $address->ddd }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<x-pagination :paginator="$addresses" />