<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <span class="nav-link">
        Connecté : {{ Auth::user()->name }} ({{ Auth::user()->role }})
      </span>
    </li>
    <li class="nav-item">
      <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-danger btn-sm ml-2">Déconnexion</button>
      </form>
    </li>
  </ul>
</nav>
