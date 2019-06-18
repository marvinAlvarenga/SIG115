@extends('layout.base')

@section('content')

<div class="card shadow mb-4">
    <div class="card-body m">
        <!-- Content Row -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <img style="width:120px; height:148px;" src="{{ asset('img/logoUes.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
        
            <h1 class="h2 mb-0 text-gray-800 text-center">
            Universidad de El Salvador
            <span class="h3">
                <br>Facultad de Ciencias y Humanidades
            </span>
            <span class="h4">
                <br><br>Unidad de Mantenimiento de Inform&aacute;tica
            </span>
            <span class="h4">
                <br>Reporte de empleados con equipo antiguo ( > 3 años)
            </span>
            </h1>
        
            <img style="width:150px; height:150px;" src="{{ asset('img/logo.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
        </div>
        @if(isset($computadoras) && $computadoras != null)
        <span class="h5">Computadoras</span>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Ubicación</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Fecha Adquisición</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($computadoras as $i => $compu)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$compu->employee->nombre}}</td>
                    <td>{{$compu->employee->ubicacion}}</td>
                    <td>{{$compu->marca}}</td>
                    <td>{{$compu->modelo}}</td>
                    <td>{{(new Carbon\Carbon($compu->fechaAdqui))->format('d/m/Y')}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

        @if(isset($impresoras) && $impresoras != null)
        <span class="h5">Impresoras</span>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Ubicación</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Fecha Adquisición</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($impresoras as $i => $impre)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$impre->employee->nombre}}</td>
                    <td>{{$impre->employee->ubicacion}}</td>
                    <td>{{$impre->marca}}</td>
                    <td>{{$impre->modelo}}</td>
                    <td>{{(new Carbon\Carbon($impre->fechaAdqui))->format('d/m/Y')}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

        @if (!@isset($computadoras) && !isset($impresoras) || $computadoras==null && $impresoras==null)
          <span class="h5">No hay datos que mostrar para los parámetros seleccionados</span>
          @else
          <div class="row justify-content-center">
            <div class="col-6">
            
            <input type="submit" class="btn btn-lg btn-primary" value="Imprimir reporte">
            <a href="{{route('tacticos.equipoAntiguoIndex')}}" class="btn btn-lg btn-primary">Regresar</a>
        </div>
    </div>
        @endif      
    </div>
</div>

@endsection

@section('css')

<link href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection
