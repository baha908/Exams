
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-microscope"></i>
    </div>
    <div class="sidebar-brand-text mx-3">E-Class <sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
    <a class="nav-link" href="/">
      <i class="fas fa-home"></i>
      <span>Anasayfa</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Sınav Ol -->
  <li class="nav-item {{ Request::is('question/create') ? 'active' : '' }}">
    <a class="nav-link" href="/question/create">
      <i class="fas fa-square-root-alt"></i>
      <span>Soru Ekle</span></a>
  </li>

  <!-- Nav Item - Tables -->
  <li class="nav-item {{ Request::is('question') ? 'active' : '' }}">
    <a class="nav-link" href="/question">
      <i class="fas fa-fw fa-table"></i>
      <span>Soru Havuzu</span></a>
  </li>
 {{--  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="charts.html">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Başarı Grafiği</span></a>
  </li>

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="tables.html">
      <i class="fas fa-fw fa-table"></i>
      <span>Geçmiş Sınavlar</span></a>
  </li> --}}

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
