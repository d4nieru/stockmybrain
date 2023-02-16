<header class="site-header">
    <div class="site-header__back-btn">
      <form method="GET" action="{{ url()->previous() }}">
        <button class="site-header__button">⬅️ Retour en arrière</button>
      </form>
    </div>
    <div class="site-header__logo">
      <a href="/dashboard">
        <button class="site-header__button">🏠 Page d'Accueil</button>
      </a>
    </div>
    <div class="site-header__settings">
      <a href="/settings">
        <button class="site-header__button">⚙️ Paramètres</button>
      </a>
    </div>
    <div class="site-header__logout">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="site-header__button">🚪🚶 Se déconnecter</button>
      </form>
    </div>
</header>

<br>
