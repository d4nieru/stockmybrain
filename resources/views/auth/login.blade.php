
<a href="/"> < Retour à la page d'accueil</a>

<form method="POST" action="/login">
    @csrf
    Email: <input type="text" name="email"><br>
    Mot de Passe: <input type="password" name="password"><br>
    <button type="submit">Se connecter</button>
</form>

<hr>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif