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
      <br>Reporte de cantidad de repuestos cambiados 
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
 @if(!isset($spares))
<div class="row ">
        <div class="col-sm-7">
          <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('gerenciales.repuestosCambiados') }}" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text ">Desde</span>
                              </div>
                                  <input class="form-control" type="date" id="gridCheck" name="desde">
                          </div>
                      </div>
                      <div class="col">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text ">Hasta</span>
                              </div>
                                  <input class="form-control" type="date" name="hasta">
                          </div>
                      </div>
                    </div>
                  
            </div>
          </div>
        </div>
      
              <div class="col-sm-4">
                    <div class="card mb-3">
                      <div class="card-body">
                          <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text ">Departamento</span>
                          </div>
                          <select class="custom-select" name="tipo">
                              <option value="0">Todo</option>
                              @foreach ($depto as $deptos)   
                              <option value="{{$deptos->id}}">{{$deptos->nombre}}</option>
                              @endforeach  
                              
                              
                            </select>
                          </div>
                      </div>
                    </div>
                  </div>
              
        <div class="col-sm-3">
            <button type="submit" class="btn btn-sm mb-3 btn-primary">Generar Reporte</button>
                </div>
      </div>
    </form>
    @endif
@if(isset($spares))
@if(count($spares)>0)
<div class="row">
        <div class="col-lg-12  w-100">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Reporte de cantidad de repuestos cambiados 
        </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Tipo</th>
                      <th>Marca</th>
                      <th>Valor Unitario</th>
                      <th>Total Usados</th>
                    </tr>
                  </thead>
 
                  <tbody>
                        @foreach($spares as $spare)
  
                        <tr>
                            <td>{{$spare->nombre}}</td>
                            <td>{{$spare->tipo}}</td>
                            <td>{{$spare->marca}}</td>
                            <td>{{$spare->valorAdqui}}</td>
                            <td>{{$spare->count}}</td>
                    @endforeach
                </tbody>
                </table>
                {{$spares->appends(Request::all())->render()}}
              </div>
            </div>
    </div>

     </div>
    </div>
    <form method="post" action="{{route('gerenciales.repuestosCambiadosPdf',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,'tipo'=>$tipo])}}">
        @csrf
      <input class="btn btn-primary" type="submit" name="submit" value="Generar PDF">
 
    <a class="btn btn-primary" href="{{route('gerenciales.repuestosCambiadosImprimir',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,'tipo'=>$tipo])}}" role="button">Imprimir</a>
    <a class="btn btn-primary" href="{{route('gerenciales.repuestosCambiadosExcel',['fecha_inicial'=>$fecha_inicial,'fecha_final'=>$fecha_final,'tipo'=>$tipo,])}}" role="button">Exportar Excel</a>
    <a class="btn btn-primary" href="{{ url()->previous() }}" class="btn btn-default">Regresar</a>
  </form>
    @else
    <h3>No hay registros que cumplan con los parámetros ingresados</h3>
    <a class="btn btn-primary" href="{{ url()->previous() }}" class="btn btn-default">Regresar</a>
    @endif
    
    @endif
 
@endsection