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
      <br>Unidad de Mantenimiento de Inform&aacute;tica
    </span>
    <span class="h4">
      <br>Reporte de Mantenimientos Solicitados.
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
               
  <form action="{{ route('premantempl') }}" method="GET">
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
             
             </div>
            </div>
              
        <div class="col-sm-3">
           &nbsp;&nbsp;&nbsp; <button type="submit" class="btn btn-sm mb-3 btn-primary">Generar Reporte</button>
                </div>
      </div>
    </form>
@endsection