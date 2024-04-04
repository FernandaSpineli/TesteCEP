<h1>Listagem dos endereços</h1>

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
    <body>
        @foreach ($addresses as $address)
            <tr>
                <td>{{ $address[ 'cep' ] }}</td>
                <td>{{ $address[ 'logradouro' ] }}</td>
                <td>{{ $address[ 'complemento' ] }}</td>
                <td>{{ $address[ 'bairro' ] }}</td>
                <td>{{ $address[ 'localidade' ] }}</td>
                <td>{{ $address[ 'uf' ] }}</td>
                <td>{{ $address[ 'ddd' ] }}</td>
            </tr>
        @endforeach
    </body>
</table>