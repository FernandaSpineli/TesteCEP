<h1>Dúvida {{ $support->id }}</h1>

@if ($errors->any())
    @foreach($erros->all() as $error)
        {{ $error }}
    @endforeach
@endif

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    @csrf()
    <input type="text" value=PUT name="_method">
    <input type="text" placeholder="Assunto" name="subject" value="{{ $support->subject }}">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição">{{ $support->body}}</textarea>
    <button type="submit">Enviar</button>
</form>