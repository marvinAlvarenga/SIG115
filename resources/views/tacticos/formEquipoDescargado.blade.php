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

  {{-- {{ $errores }} --}}
<div class="pl-5">
  <form action="{{ route('PostEquipoDescargado') }}" method="POST" class='pl-5'>
    <label><h5>Tipo de Equipo:</h5></label><br>
    <div class="form-group">
      <label id="lb_tipot" for="id_tipo_todo" class="pl-5">Marcar Todo</label>
      <input type="checkbox" name="dummy" value="0" id="id_tipo_todo">
      <label for="id_tipo_computadora" class="pl-5">Computadoras </label>
      <input type="checkbox" class="arrayCheck" name="tipo_arr[]" value="1" id="id_tipo_computadora">
      <label for="id_tipo_impresora" class="pl-5">Impresoras </label>
      <input type="checkbox" class="arrayCheck" name="tipo_arr[]" value="2" id="id_tipo_impresora">
    </div>
    <br><label><h5>Periodo de Tiempo:</h5></label><br>
    <div class="form-group pl-5" style="display:inline-block;">
      <label for="id_fechai">Fecha de Inicio:</label>
      <input type="date" class="form-control" id="id_fechai" name="fecha_inicial" value="">
    </div>
    <div class="form-group pl-5" style="display:inline-block;">
      <label for="id_fechaf">Fecha de Finalizaci&oacute;n:</label>
      <input type="date" class="form-control" id="id_fechaf" name="fecha_final" value="">
    </div>
    <br>
    <br>
    <input type="submit" class="btn btn-primary" value="Generar Reporte" style="width:220px;">
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input class="btn btn-primary" value="Limpiar Campos">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  </form>
  <br><br><br><br>

</div>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
$(function(){
  $('#id_tipo_todo').click(function(){
    var tipo_todo = $('#id_tipo_todo');
    var label = $('#lb_tipot');
    $('.arrayCheck').prop('checked', tipo_todo.prop("checked"));
    if(tipo_todo.prop("checked")){
      label.text('Desmarcar Todo');
    } else {
      label.text('Marcar Todo');
    }
  });
});
</script>

@endsection
