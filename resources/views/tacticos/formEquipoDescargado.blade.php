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

  <form action="{{ route('PostEquipoDescargado') }}" method="POST" class='pl-5'>
    <label><h5>Tipo de Equipo:</h5></label><br>
    <div class="row ">
    <div class="col-sm-5">
    <div class="card mb-2">
      <div class="card-body">
        <div class="form-row">

        <div class="col">
          <div class="form-check">
            <input type="checkbox" name="dummy" value="0" id="id_tipo_todo" class="form-check-input">
            <label id="lb_tipot" for="id_tipo_todo" class="form-check-label">Marcar Todo</label>

          </div>
        </div>
        <div class="col">
          <div class="form-check">
<input type="checkbox" class="arrayCheck form-check-input" name="tipo_arr[]" value="1" id="id_tipo_computadora">
            <label for="id_tipo_computadora" class="form-check-label">Computadoras</label>

          </div>
        </div>
        <div class="col">
          <div class="form-check">
<input type="checkbox" class="arrayCheck form-check-input" name="tipo_arr[]" value="2" id="id_tipo_impresora">
            <label for="id_tipo_impresora" class="form-check-label">Impresoras </label>
          </div>
        </div>

      </div></div></div></div></div>


    <br><label><h5>Periodo de Tiempo:</h5></label><br>
    <div class="row ">
            <div class="col-sm-7">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
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


</div></div></div></div></div>


    <br>
    <br>
    <input type="submit" class="btn btn-primary" value="Generar Reporte" style="width:220px;">
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  </form>
  <br><br><br><br>



<script src="{{asset('vendor/jquery/jquery-1.11.0.min.js')}}"></script>

<script type="text/javascript">
$(function(){
  $('#id_tipo_todo').click(function(){
    var tipo_todo = $('#id_tipo_todo');

    var compu = $('#id_tipo_computadora');
    var impre = $('#id_tipo_impresora')

    $('.arrayCheck').prop('checked', tipo_todo.prop("checked"));

    if( compu.prop('checked') == false ){
      tipo_todo.prop("checked", false);
    }

  });
});

$(function(){
  $('#id_tipo_computadora').click(function(){
    var tipo_todo = $('#id_tipo_todo');
    var compu = $('#id_tipo_computadora');
    if( compu.prop('checked') == false ){
      tipo_todo.prop("checked", false);
    }
  });
});

$(function(){
  $('#id_tipo_impresora').click(function(){
    var tipo_todo = $('#id_tipo_todo');
    var impre = $('#id_tipo_impresora');
    if( impre.prop('checked') == false ){
      tipo_todo.prop("checked", false);
    }
  });
});


</script>

@endsection
