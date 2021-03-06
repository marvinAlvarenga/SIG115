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
        <br>Reporte de Equipo con costos de mante mayor al 40% del valor de adquisicion
      </span>
    </h1>
  
    <img style="width:150px; height:150px;" src="{{ asset('img/logo.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
   </div>
  
  
  {{ $errores }}
  <div class="pl-5">
  
  <form action="{{ route('info40') }}" method="POST">
    
    <div style="display:inline-block;">
      <select class="custom-select"  name="tipo">
          <option value="2">Impresora</option>
          <option value="1">Computadora</option>
          <option value="0">Todo</option>
          
        </select>
      
    </div>
    
    <br><br>
    <div class="pl-4">
    <input type="submit" class="btn btn-primary" value="Generar Reporte" style="width:220px;">
    &nbsp;&nbsp;&nbsp;&nbsp;
    
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  </form>
  </div>
  <br><br><br><br>

@endsection