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
            <br>Reporte de Garantias proximas a vencer
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
          <h6 class="m-0 font-weight-bold text-primary">Equipos con licencias a vencer o vencidas</h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
          
             
                            <th scope="row">Num Serie</th>
    
                            <th scope="row">Num Inv.</th>                   
                                                     
                            <th scope="row">Marca </th>
                         
                            <th scope="row"> Modelo </th>
                         
                            <th scope="row"> Estado </th>
                         
                            <th scope="row"> Tipo </th>
                         
                            <th scope="row">Tiempo faltante(meses) </th>
                         
                           
                            
                           </tr>                     
                    </thead>
                    <tbody>
                           
                        @foreach ($empleManto as $i => $product)    
                        
                        <tr>
                               
                        <td>{{$product->numSe}}</td>
    
                        <td>{{$product->numSe}}</td>

                        <td>{{$product->marca}}</td>

                        <td>{{$product->modelo}}</td>
                      
                        <td>{{$product->estado}}</td>

                        <td>{{$product->tipo}}</td>

                        <td>{{$tiempoFaltante[$i]}}</td>

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




    <a class="btn btn-primary" href="{{url('pdfgaranve',['tipo'=>$tipo,])}}" role="button">Generar PDF</a>
    &nbsp;
    <a class="btn btn-primary" href="{{ route('soligaranven') }}" role="button">Regresar</a>
  
    @endsection