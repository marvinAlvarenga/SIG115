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


{{ $errores }}
<div class="pl-5">

<form action="{{ route('PostMantUsrs') }}" method="POST">
  <div class="row ">
          <div class="col-sm-11">
  <div class="card mb-3">
    <div class="card-body">
      <div class="row">
      <div class="col">

          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text ">Cant. Registros</span>
              </div>
              <input type="number" class="form-control" id="id_count" name="count" value="">
          </div>
      </div>
      <div class="col">
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text ">Desde</span>
              </div>
                <input type="date" class="form-control" id="id_fechai" name="fecha_inicial" value="">
          </div>
      </div>
      <div class="col">
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text ">Hasta</span>
              </div>
                    <input type="date" class="form-control" id="id_fechaf" name="fecha_final" value="">
          </div>
      </div>

    </div>
    </div>
  </div>
</div>
</div>
  <div class="pl-4">
  <input type="submit" class="btn btn-primary" value="Generar Reporte" style="width:220px;">
  &nbsp;&nbsp;&nbsp;&nbsp;
  </div>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
</div>

<br><br><br><br>




@endsection
