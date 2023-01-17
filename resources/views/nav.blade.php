
<div class="row">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="" type="submit">Se déconnecter</button>
    </form>
    <span><a href="/home"><button>Home</button></a></span>
</div>