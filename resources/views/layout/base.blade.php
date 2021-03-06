<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  @yield('meta-headers')

  <title>SIGME | Ciencias y Humanidades</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ URL::asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

  @yield('css')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">SIGME-CCHH</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
      <a class="nav-link" href="{{url('/')}}">
          <i class="fas fa-fw fa-home"></i>
          <span>Inicio</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      @can('etl')

      <!-- Heading -->
      <div class="sidebar-heading">
        ETL
      </div>
      <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseETL" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-file"></i>
        <span>ETL</span>
      </a>
      <div id="collapseETL" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('etlManual')}}">Ejecutar Proceso</a>
        </div>
      </div>
      </li>
      <hr class="sidebar-divider">
      @endcan
      @can('report.report')
      <!-- Heading -->
      <div class="sidebar-heading">
        Reportes
      </div>

      
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          @can('report.generateGerenciales')
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGerencial" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-file"></i>
          <span>Reportes Gerenciales</span>
        </a>
        <div id="collapseGerencial" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Reportes:</h6>
            @can('report.mantenimientosRealizados')<a class="collapse-item" href="{{route('gerenciales.mantenimientosRealizados')}}">Mantenimientos realizados</a>@endcan
            @can('report.repuestosCambiados')<a class="collapse-item" href="{{route('gerenciales.repuestosCambiados')}}">Repuestos cambiados</a>@endcan
            @can('report.clientesYMantenimientos')<a class="collapse-item" href="{{ route('MantsXUser') }}">Clientes y mantenimientos</a>@endcan
            @can('report.mayor40Adqui')<a class="collapse-item" href="{{ route('soli40') }}">Reporte de Equipos <br> con costo de Mantenimiento <br>mayor al 40% del <br>precio de adquisicion.</a>@endcan
            @can('report.cantidadManteniDepto')<a class="collapse-item" href="{{ route('solidepmant') }}">Reporte de Mantenimientos <br> por departamento</a>@endcan
          </div>
        </div>
        @endcan
        @can('report.generateTactico')
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTactico" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-file"></i>
          <span>Reportes Tácticos</span>
        </a>
        <div id="collapseTactico" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Reportes:</h6>
            @can('report.equipoAgregado')<a class="collapse-item" href="{{route('gerenciales.equipoportipo')}}">Equipo agregado</a>@endcan
            @can('report.licencias')<a class="collapse-item" href="{{route('tacticos.licenciasPorVencer')}}">Licencias por vencer</a>@endcan
            @can('report.equipoDescargado')<a class="collapse-item" href="{{ route('EquipoDescargado') }}">Equipo descargado</a>@endcan
            @can('report.equipoAntiguo')<a class="collapse-item" href="{{route('tacticos.equipoAntiguoIndex')}}">Equipo antiguo</a>@endcan
            @can('report.cantidadManteniSolicitados')<a class="collapse-item" href="{{route('solimantempl')}}">Reporte de <br> Mantenimientos Solicitados.</a>@endcan
            @can('report.garantiasVencidas')<a class="collapse-item" href="{{route('soligaranven')}}">Equip. Garantias vencidas</a>@endcan

          </div>
        </div>
        @endcan

      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">
      @endcan

      @can('gesti.users')
      <!-- Heading -->
      <div class="sidebar-heading">
        Usuarios
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-user"></i>
          <span>Gestión de Usuarios</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Usuarios:</h6>
          @can('users.index')<a class="collapse-item" href="{{ route('usuarios.index') }}">Consultar Usuarios</a>@endcan
          @can('users.create')<a class="collapse-item" href="{{ route('register') }}">Registrar usuarios</a>@endcan
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      @endcan
      @can('bitacora')

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('logs')}}">
          <i class="fas fa-fw fa-history"></i>
          <span>Bitacoras</span></a>
      </li>
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      @endcan

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 medium">{{(Auth::user())?Auth::user()->name:'Invitado'}}</span>
                {{--  <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgk/60x60">  --}}
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar sesión
                      </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
              <!-- Main content -->
              @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="footer-copyright sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright footer-copyright text-center my-auto">
            <span>Copyright &copy; Universidad de El Salvador 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Listo para irte?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona "Cerrar sesión" si estas listo para cerrar la sesión actual.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

  @yield('js')

</body>

</html>
