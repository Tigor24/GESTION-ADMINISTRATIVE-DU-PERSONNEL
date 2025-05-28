<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link text-center">
    <span class="brand-text font-weight-light">Plateforme RH</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

        @php $role = Auth::user()->role; @endphp

        @if($role === 'agent')
          <li class="nav-item">
            <a href="{{ route('agent.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Accueil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('agent.conges') }}" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>Mes congés</p>
            </a>
          </li>

        @elseif($role === 'directeur')
          <li class="nav-item">
            <a href="{{ route('directeur.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Accueil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('directeur.conges') }}" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Demandes à valider</p>
            </a>
          </li>

        @elseif($role === 'rh')
          <li class="nav-item">
            <a href="{{ route('rh.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Accueil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('rh.conges') }}" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Demandes RH</p>
            </a>
          </li>

        @elseif($role === 'dpaf')
          <li class="nav-item">
            <a href="{{ route('dpaf.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Accueil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('dpaf.conges') }}" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>Demandes DPAF</p>
            </a>
          </li>
        @endif

      </ul>
    </nav>
  </div>
</aside>
