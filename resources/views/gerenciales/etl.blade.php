@extends('layout.base')

@section('meta-headers')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

<div id = 'msg'></div>

<div class="col-sm-10">
  <div class="card mb-3 mt-2">
    <div class="card-body">
      <div class="form-row">
        <h1>ETL:</h1>
          <p>Este bot&oacute;n ejecutar&aacute; el proceso de Extraci&oacute;n, Transformaci&oacute;n y Carga de datos.
            Dicha acci&oacute;n causar&aacute; que los <strong>datos nuevos</strong> ingresados en el servidor principal, sean importados
            al sistema de apoyo gerencial. <strong>Se consideran datos nuevos, todos los registros realizados a partir de
            hace un d&iacute;a a la 1:00 a.m. </strong></p>
          <p><strong>Por favor. No cierre la pagina hasta que se le notifique la finalizaci&oacute;n del proceso.
          Si lo hace la actualizaci&oacute;n no tendr&aacute; efecto alguno.</strong></p>
      </div>
    </div>
  </div>
</div>






     <button id="btnGenETL" type="button" class="btn btn-primary" onclick="getMessage()">
       Iniciar ETL
     </button>



     <script>
        window.getMessage = function() {

          $('#btnGenETL').attr('disabled', 'true');

          var imag = "<img style='width:60px; height:60px;'  src='{{ asset('img/loading.gif') }}' class='img-fluid pull-xs-left' alt='Cargando...'>"
          $('#msg').html(imag + ' Procesando. Por favor, no cierre esta ventana.');

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
           $.ajax({
              type:'POST',
              url:'/etl',
              data:'',
              success:function(data) {
                 $("#msg").html(data.msg);
                 $("#msg").attr('class','alert alert-info col-sm-10');
                 $('#btnGenETL').removeAttr('disabled');
              },
              error:function(data){
                $("#msg").html(data.responseJSON['msg']);
                $("#msg").attr('class', 'alert alert-danger col-sm-10');
                $('#btnGenETL').removeAttr('disabled');
              }
           });

        }
     </script>

@endsection
