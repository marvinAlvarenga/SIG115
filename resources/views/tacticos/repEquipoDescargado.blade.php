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
        <br>Reporte de Equipos Descargados
      </span>
    </h1>

    <img style="width:150px; height:150px;" src="{{ asset('img/logo.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
  </div>

<div style="padding-left: 100px;">

  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">N&uacute;mero de serie</th>
        <th scope="col">N&uacute;mero de inventario</th>
        <th scope="col">Marca</th>
        <th scope="col">Modelo</th>
        <th scope="col">C&oacute;digo Descargo</th>
      </tr>
    </thead>
    <tbody>
      @forelse($productos as $producto)
        <tr>
          <td>{{ $producto->numSe }}</td>
          <td>{{ $producto->numInv }}</td>
          <td>{{ $producto->marca }}</td>
          <td>{{ $producto->modelo }}</td>
          <td>{{ $producto->codigo }}</td>
        </tr>
      @empty
        <tr><td colspan="5">Ningun registro cumple los parametros asignados</td></tr>
      @endforelse
  </tbody>
</table>
</div>
<a class="btn btn-primary" href="{{route('pdfequipodescargado',['tipo'=> implode(',',$tipo),'fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final, 'valor'=>'pdf'])}}" role="button">Exportar a PDF</a>
<a class="btn btn-primary" href="{{route('impequipodescargado',['tipo'=> implode(',',$tipo),'fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final, 'valor'=>'print'])}}" role="button">Imprimir</a>
<a class="btn btn-primary" href="{{route('impequipodescargado',['tipo'=> implode(',',$tipo),'fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final, 'valor'=>'excel'])}}" role="button">Eportar Excel</a>

  &nbsp;
  <a class="btn btn-primary" href="{{ route('EquipoDescargado') }}" role="button">Regresar</a>

@endsection
