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
      <br>Reporte de mantenimientos realizado por encargados
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
        <div class="col-sm-7">
          <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('tacticos.mantenimientosRealizados') }}" enctype="multipart/form-data">
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
              
        <div class="col-sm-3">
            <button type="submit" class="btn btn-sm mb-3 btn-primary">Generar Reporte</button>
                </div>
      </div>
    </form>
@if(isset($upkeeps))
@if(count($upkeeps)>0)
<div class="row">
        <div class="col-lg-12  w-100">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Reporte periódico de mantenimientos realizado por todos los encargados de mantenimientoo</h6>
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
                        @foreach($upkeeps as $upkeep)
  
                        <tr>
                            <td>{{$upkeep->id}}</td>
                            <td>{{$upkeep->tipo}}</td>
                            <td>{{$upkeep->marca}}</td>
                            <td>{{$upkeep->valorAdqui}}</td>
                            <td>{{$upkeep->total}}</td>
                    @endforeach
                </tbody>
                </table>
                {{$upkeeps->appends(Request::all())->render()}}
              </div>
            </div>
    </div>

     </div>
    </div>
    @else
    <h3>No hay registros que cumplan con los parámetros ingresados</h3>
    @endif
    
    @endif
 
@endsection