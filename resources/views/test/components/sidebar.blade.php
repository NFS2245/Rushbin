<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
      <a class="{{ Request::is('dashboard*') ? 'nav-link' : 'nav-link collapsed' }}" href="{{ route('dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Daftar Sampah</span>
      </a>
  </li>

  <li class="nav-item">
      <a class="{{ Request::is('transaksi*') ? 'nav-link' : 'nav-link collapsed' }}" href="{{ route('transaksi.beli') }}">
          <i class="bi bi-envelope"></i><span>Transaksi</span>
      </a>
  </li>

  <li class="nav-item">
      <a class="{{ Request::is('laporan*') ? 'nav-link' : 'nav-link collapsed' }}" href="{{ route('laporan.beli') }}">
          <i class="bi bi-journal-text"></i><span>Laporan</span>
      </a>
  </li>

  <li class="nav-item">
      <a class="{{ Request::is('pickup*') ? 'nav-link' : 'nav-link collapsed' }}" href="{{ route('pickup') }}">
          <i class="bi bi-menu-button-wide"></i><span>Pickup</span>
      </a>
  </li>

  <li class="nav-item">
      <a class="{{ Request::is('customer*') ? 'nav-link' : 'nav-link collapsed' }}" href="{{ route('customer') }}">
          <i class="bi bi-bar-chart"></i><span>Informasi Customer</span>
      </a>
  </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-person"></i><span>About Us</span>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
        </ul>
      </li><!-- End Icons Nav -->

      
</li><!-- End Login Page Nav -->

  </aside><!-- End Sidebar-->