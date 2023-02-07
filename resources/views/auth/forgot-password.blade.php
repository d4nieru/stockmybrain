
@if(session('status'))
    {{ session('status') }}
@endif

<form method="POST" action="/forgot-password">
    @csrf
    Email: <input type="text" name="email"><br>
    <button type="submit">Poursuivre</button>
</form>


<hr>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif

@include('components.footer')