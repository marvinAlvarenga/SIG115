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
            <br>Unidad de Mantenimiento de Inform&aacute;tica
          </span>
          <span class="h4">
            <br>Reporte de Mantenimientos por departamento.
          </span>
        </h1>
      
        <img style="width:150px; height:150px;" src="{{ asset('img/logo.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
       </div>
 
     


        @if(isset($manDeto))
@if(count($manDeto)>0)
<div class="row">
        <div class="col-lg-12  w-100">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Cantidad de mantenimientos por departamento</h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
          
             
                            <th scope="row">Departamento</th>
                         
                            <th scope="row">Cantidad de mantenimientos</th>
                         
                            
                           </tr>                     
                    </thead>
                    <tbody>
                        @foreach ($manDeto as $manDeto)     
                        <tr>
                      
                        <td>{{$manDeto->Departamento}}</td>
                      
                        <td>{{$manDeto->Cantidad}}</td>
                      
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
   
    <form method="post" action="{{route('pdfmanDeto',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,'tipo'=>$tipo,])}}">
      @csrf
    <input class="btn btn-primary" type="submit" name="submit" value="Generar PDF">

  <a class="btn btn-primary" href="{{route('impmanDeto',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,'tipo'=>$tipo,])}}" role="button">Imprimir</a>
  <a class="btn btn-primary" href="{{route('excelmanDeto',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,'tipo'=>$tipo,])}}" role="button">Generar Excel</a>
    &nbsp;
    <a class="btn btn-primary" href="{{ route('solidepmant') }}" role="button">Regresar</a>
   
</form>

    
    
    @endsection