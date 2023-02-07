
<div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">🚪🚶 Se déconnecter</button>
    </form>
</div>

<header>
    <div>
        <a href="/dashboard">
            <button>🏠 Page d'Accueil</button>
        </a>
    </div>

    <div>
        <a href="/settings">
            <button>⚙️ Paramètres</button>
        </a>
    </div>

    <div>
        <form method="GET" action="{{ url()->previous() }}">
            <button>⬅️ Retour en arrière</button>
        </form>
    </div>
</header>

<br>
