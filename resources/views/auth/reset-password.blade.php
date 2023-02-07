
<h1>Réinitialiser le mot de passe</h1>

<form method="POST" action="/reset-password">
    @csrf
    <input type="hidden" name="token" value="{{ request()->route('token') }}">
    Email: <input type="email" name="email"><br>
    Nouveau Mot de Passe: <input type="password" name="password"><br>
    Confirmez le Nouveau Mot de Passe: <input type="password" name="password_confirmation">
    <button type="submit">Poursuivre</button>
</form>

<hr>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif

@include('components.footer')