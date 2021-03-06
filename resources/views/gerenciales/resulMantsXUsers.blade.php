@extends('layout.base')

@section('content')

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
        <br>Reporte de Usuarios que solicitan mas Mantenimientos
      </span>
    </h1>

    <img style="width:150px; height:150px;" src="{{ asset('img/logo.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
   </div>

<div class="p-5">

  <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Usuarios que solicitan mas mantenimientos</h6>
      </div>
          <div class="card-body">
            <div class="table-responsive">

  <table class="table table-bordered" style="width:850px;" align="center">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Ubicaci&oacute;n</th>
        <th scope="col" style="width: 250px;">Mantenimientos Solicitados</th>
      </tr>
    </thead>
    <tbody>
      @forelse($usuarios as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->nombre }}</td>
          <td>{{ $user->ubicacion }}</td>
          <td>{{ $user->count }}</td>
        </tr>
      @empty
        <tr><td colspan="4">Ningun registro cumple los parametros asignados</td></tr>
      @endforelse
    </tbody>
  </table>
</div></div></div>

      <a class="btn btn-primary" href="{{route('pdfMantsXUser',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,'count'=>$count, 'valor'=>'pdf'])}}" role="button">Exportar a PDF</a>
      <a class="btn btn-primary" href="{{route('impMantsXUser',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,'count'=>$count, 'valor'=>'print'])}}" role="button">Imprimir</a>
      <a class="btn btn-primary" href="{{route('impMantsXUser',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,'count'=>$count, 'valor'=>'excel'])}}" role="button">Exportar Excel</a>

        &nbsp;
        <a class="btn btn-primary" href="{{ route('MantsXUser') }}" role="button">Regresar</a>

</div>

@endsection
