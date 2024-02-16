<h1>Nova Dúvida</h1>

@if ($errors->any())
    @foreach($erros->all() as $error)
        {{ $error }}
    @endforeach
@endif

<form action="{{ route('supports.store') }}" method="POST">
    @csrf()
    <input type="text" placeholder="Assunto" name="subject" value="{{ old('body') }}">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição">{{ old('body') }}</textarea>
    <button type="submit">Enviar</button>
</form>