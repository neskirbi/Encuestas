<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <!--<li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Contact</a>
    </li>-->
    
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    @include('widgets.cambioplanta')
    

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown" title="Solicitudes de Pago">
      <a class="nav-link" href="{{ url('solicitudes') }}" aria-expanded="false">
        <i class="fa fa-money" aria-hidden="true"></i>
        <span class="badge badge-warning navbar-badge">{{GetSolicitudes()}}</span>
      </a>      
    </li>

    
      
  </ul>
</nav>


