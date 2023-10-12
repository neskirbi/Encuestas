<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

    
  </ul>
  
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    
    <li class="nav-item dropdown">
      <a class="nav-link" href="#" data-toggle="modal" data-target="#modalpago" data-referencia="" data-obra="" data-total="0.0" onclick="CargarPago(this);">
      {{number_format(GetSaldo(),2)}} <i class="fa fa-money" aria-hidden="true"></i>
      <span class="badge badge-danger navbar-badge"></span>
      </a>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" href="{{url('carrito')}}">
      <i class="fa fa-shopping-cart"></i>
      <span class="badge badge-warning navbar-badge"><font id="capacidad">{{Carrito()}}</font></span>
      </a>
    </li>
    
  </ul>
</nav>

  
@include('cliente.navigations.modals.modalpago')

@if(Session::has('transferencia'))
<script>
  window.open('transferencia/{{Session::get('transferencia')}}', '_blank').focus();
</script>
@endif