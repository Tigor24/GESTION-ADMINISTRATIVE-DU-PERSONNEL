<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link text-center">
      <span class="brand-text font-weight-light">Plateforme RH</span>
  </a>

  <div class="sidebar">
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
              @php $role = Auth::user()->role; @endphp

              {{-- Admin --}}
              @if ($role === 'admin')
                  <li class="nav-header">ADMINISTRATION</li>
                  <li class="nav-item">
                      <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-tools"></i>
                          <p>Dashboard Admin</p>
                      </a>
                  </li>

              {{-- RH --}}
              @elseif ($role === 'rh')
                  <li class="nav-header">ESPACE RH</li>
                  <li class="nav-item">
                      <a href="{{ url('/rh/dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-user-cog"></i>
                          <p>Dashboard RH</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('rh.conges') }}" class="nav-link">
                          <i class="nav-icon fas fa-clipboard-check"></i>
                          <p>Analyse des congés</p>
                      </a>
                  </li>

              {{-- Directeur --}}
              @elseif ($role === 'directeur')
                  <li class="nav-header">ESPACE DIRECTEUR</li>
                  <li class="nav-item">
                      <a href="{{ url('/directeur/dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-user-tie"></i>
                          <p>Dashboard Directeur</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('directeur.conges') }}" class="nav-link">
                          <i class="nav-icon fas fa-share-square"></i>
                          <p>Transfert vers DPAF</p>
                      </a>
                  </li>

              {{-- DPAF --}}
              @elseif ($role === 'dpaf')
                  <li class="nav-header">ESPACE DPAF</li>
                  <li class="nav-item">
                      <a href="{{ url('/dpaf/dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-briefcase"></i>
                          <p>Dashboard DPAF</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('dpaf.conges') }}" class="nav-link">
                          <i class="nav-icon fas fa-random"></i>
                          <p>Demandes reçues</p>
                      </a>
                  </li>

{{-- Agent --}}
@elseif ($role === 'agent')
    <li class="nav-header">MON ESPACE</li>

    <li class="nav-item">
        <a href="{{ route('agent.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>Dashboard Congés</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('agent.conges.create') }}" class="nav-link">
            <i class="nav-icon fas fa-plus-circle"></i>
            <p>Nouvelle demande</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('agent.conges.historique') }}" class="nav-link">
            <i class="nav-icon fas fa-history"></i>
            <p>Historique des congés</p>
        </a>
    </li>
@endif

          </ul>
      </nav>
  </div>
</aside>
