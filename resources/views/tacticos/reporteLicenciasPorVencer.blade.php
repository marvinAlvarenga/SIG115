@extends('layout.base')
 
@section('content')
<!-- Content Row -->
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
      <br>Reporte de equipo con licencias vencidas o por vencer
    </span>
  </h1>

  <img style="width:150px; height:150px;" src="{{ asset('img/logo.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
 </div>
 @if(count($errors)>0)
 <div class="alert alert-danger">
     <button  type="button" class="close" data-dismiss="alert">
         &times;
     </button>
       {{$errors->first()}}
 </div>
 @endif
<div class="row ">
        <div class="col-sm-4">
          <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('tacticos.licenciasPorVencer') }}" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text ">Estado</span>
                              </div>
                              <select class="form-control"  name="vencida">
                                  <option value=1>Vencidas</option>
                                  <option value=2>Por Vencer</option>

                                </select>
                          </div>
                      </div>
                    </div>
                  
            </div>
          </div>
        </div>
      
              <div class="col-sm-3">
                    <div class="card mb-3 mt-2">
                      <div class="card-body">
                          <div class="form-row">
                              <div class="col">
                          <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="exampleRadios1" value="1" checked>
                                <label class="form-check-label" for="exampleRadios1">PC</label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="exampleRadios2" value="2">
                                <label class="form-check-label" for="exampleRadios2">Impresora</label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="tipo" id="exampleRadios3" value="3"  checked>
                                <label class="form-check-label" for="exampleRadios3">Todo</label>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
              
        <div class="col-sm-3 mt-4">
            <button type="submit" class="btn btn-xs mb-3 btn-primary">Generar Reporte</button>
                </div>
      </div>
    </form>
@if(isset($products))
@if(count($products)>0)
<div class="row">
        <div class="col-lg-12  w-100">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Reporte de equipo con licencias vencidas o por vencer</h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Número de Serie</th>
                      <th>Número de inventario</th>
                      <th>Descripción</th>
                      <th>Tipo</th>
                      <th>Licencia</th>
                      <th>Fecha de vencimiento</th>
                    </tr>
                  </thead>
 
                  <tbody>
                        @foreach($products as $product)
  
                        <tr>
                            <td>{{$product->numSe}}</td>
                            <td>{{$product->numInv}}</td>
                            <td>{{$product->descripcion}}</td>
                            <td>{{$product->tipo}}</td>
                            <td>{{$product->nombre}}</td>
                            <td>{{$product->fechaVencimiento}}</td>
                    @endforeach
                </tbody>
                </table>
                {{$products->appends(Request::all())->render()}}
              </div>
            </div>
    </div>

     </div>
    </div>
    <form method="post" action="{{route('tacticos.licenciasPorVencerPdf',['vencida'=>$vencida,'tipo'=>$tipo,])}}">
        @csrf
      <input class="btn btn-primary" type="submit" name="submit" value="Generar PDF">
 
    <a class="btn btn-primary" href="{{route('tacticos.licenciasPorVencerImprimir',['vencida'=>$vencida,'tipo'=>$tipo,])}}" role="button">Imprimir</a>
    <a class="btn btn-primary" href="{{route('tacticos.licenciasPorVencerExcel',['vencida'=>$vencida,'tipo'=>$tipo,])}}" role="button">Exportar Excel</a>
  </form>
    @else
    <h3>No hay registros que cumplan con los parámetros ingresados</h3>
    @endif
    
    @endif
 
@endsection