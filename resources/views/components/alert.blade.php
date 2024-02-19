<div class="alert alert-danger">
    @if ($errors->any())
        @foreach($erros->all() as $error)
            {{ $error }}
        @endforeach
    @endif
</div> 