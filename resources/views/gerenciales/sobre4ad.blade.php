@extends('layout.base')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
            table {
                border: none;
                width: 100%;
                border-collapse: collapse;
            }

            th {
                padding: 5px 10px;
                text-align: center;
                border: 1px solid #999;
            }
            td { 
               
                text-align: left;
                border: 1px solid #999;
                height: auto;
             
            }

        </style>
    <title>Document</title>
</head>
<body>
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
     
   
        <div  align="center" >                
           
            <table>
                
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
        </div >

<hr>


<div class="form-group p-4" style="display:inline-block;">
    <a href="{{url('pdfinfo40', ['tipo' => $tipo,])}}">Generar PDF</a>
    &nbsp;
    <a href="{{url('soli40')}}">Regresar</a>
</div>
    @endsection