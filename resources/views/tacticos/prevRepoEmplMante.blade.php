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
            <br>Reporte de cantidad de Mantenimientos solicitados por Empleado.
          </span>
        </h1>
      
        <img style="width:150px; height:150px;" src="{{ asset('img/logo.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
       </div>
    <div tyle="height:28px; width:100%; float:both;"  class="form-group" align="right" >
            <br>    
            <br>   
            <br>  
            <label for="txtfecha" class="col-sm-2 control-label">Fecha</label>
            <div class="col-sm-4">
              <p>{{$date}}</p>    
            </div>
        </div>
   
@if(isset($empleManto))
@if(count($empleManto)>0)
<div class="row">
        <div class="col-lg-12  w-100">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Equipo informático agregado al inventario por tipo</h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
          
             
                            <th scope="row">Departamento</th>
    
                            <th scope="row">Ubicacion</th>
                         
                            <th scope="row">Cantidad de mantenimientos solicitados</th>
                         
                            
                           </tr>                     
                    </thead>
                    <tbody>
                        @foreach ($empleManto as $empleMantos)     
                        <tr>
                      
                        <td>{{$empleMantos->nombre}}</td>
    
                        <td>{{$empleMantos->ubicacion}}</td>
                      
                        <td>{{$empleMantos->Cantidad}}</td>
                      
                        </tr>       
                 @endforeach                             
                    </tbody>
                </table>
               
              </div>
            </div>
    </div>

     </div>
    </div>
    @else
    <h3>No hay registros que cumplan con los parámetros ingresados</h3>
    @endif
    
    @endif     



<div class="form-group p-4" style="display:inline-block;">
    <a href="{{url('pdfmantempl',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,])}}">Generar PDF</a>
    &nbsp;
    <a href="{{ route('solimantempl') }}">Regresar</a>
   </div>
    @endsection