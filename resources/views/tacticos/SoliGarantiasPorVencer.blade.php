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
      <br>Reporte de Garantias vencidas o por vencer
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
                <form method="GET" action="{{ route('pregaranven') }}" enctype="multipart/form-data">
                  <div class="form-row">
                      <div class="col">
                  <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="exampleRadios1" value="1" checked>
                        <label class="form-check-label" for="exampleRadios1">Por vencer</label>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="exampleRadios2" value="2">
                        <label class="form-check-label" for="exampleRadios2">Vencidas</label>
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
                    
                  </div>
              
        <div class="col-sm-3">
            <button type="submit" class="btn btn-sm mb-3 btn-primary">Generar Reporte</button>
                </div>
      </div>
    </form>
 
@endsection