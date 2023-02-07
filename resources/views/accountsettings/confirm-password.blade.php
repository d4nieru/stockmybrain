
<h1>Avant d'effectuer l'action, veuillez confirmer votre mot de passe ?</h1>

<form method="POST" action="/user/confirm-password">
    @csrf
    Mot de Passe: <input type="password" name="password"><br>
    <button type="submit">Poursuivre</button>
</form>

<hr>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif

@include('components.footer')