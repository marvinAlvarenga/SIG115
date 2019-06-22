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
            <br>Reporte de Equipos con costo de Mantenimiento mayor al 40% del precio de adquisicion.
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
     
        @if(isset($produc40))
@if(count($produc40)>0)
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
          
             
                            <th scope="row">N° de serie</th>
                         
                            <th scope="row">N° inv.</th>
                         
                            <th scope="row">Marca</th>
                         
                            <th scope="row">Modelo</th>
                   
                            <th scope="row">Estado</th>
                   
                            <th scope="row">Valor adquisicion</th>
                           
                            <th scope="row">Monto</th>
                           </tr>                     
                    </thead>
                    <tbody>
                        @foreach ($produc40 as $producs40)     
                        <tr>
                      
                        <td>{{$producs40->numSe}}</td>
                      
                        <td>{{$producs40->numInv}}</td>
                      
                        <td>{{$producs40->marca}}</td>
                
                        <td>{{$producs40->modelo}}</td>
                
                        <td>{{$producs40->estado}}</td>
                
                        <td>{{$producs40->valorAdqui}}</td>
                
                        <td>{{$producs40->costoSpares}}</td>
                      
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
 
      
        <div  align="center" >                
           
            <table>
                
                
            </table>
        </div >

<hr>

<form method="post" action="{{route('pdfinfo40', ['tipo' => $tipo,])}}">
  @csrf
<input class="btn btn-primary" type="submit" name="submit" value="Generar PDF">

<a class="btn btn-primary" href="{{route('impinfo40', ['tipo' => $tipo,])}}" role="button">Imprimir</a>
<a class="btn btn-primary"  href="{{route('excellinfo40', ['tipo' => $tipo,])}}">Generar Excell</a>
&nbsp;
<a class="btn btn-primary" class="btn btb-primary" href="{{route('soli40')}}">Regresar</a>

</form>


    @endsection