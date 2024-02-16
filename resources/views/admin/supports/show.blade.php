<h1>Detalhes da dúvida {{ $support->id }}</h1>

<ul>
    <li>Assunto: {{ $support->subject }}</li>
    <li>Status: {{ $support->status }}</li>
    <li>descrição: {{ $support->body }}</li>
</ul>

<form action="{{ route('supports.destroy', $supports->id) }}" method="post">
    @csrf()
    @method('DELETE')
    <button type="submit">Deletar</button>
</form>