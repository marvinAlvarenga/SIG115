<!DOCTYPE html>
<html lang="es">
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
    <div >
        
        <div  style="height:5px; width:100%; clear:both;" align="center">
                <h5>UNIVERSIDAD DE EL SALVADOR<br>OFICINA CENTRALES
                <br>SECCIÓN DE MANTENIMIENTO Y REPARACIÓN DE EQUIPO INFORMÁTICO
                 <br>Reporte de empleados con equipo antiguo ( > 3 años)
                 <br>San salvador, El Salvador Centro América</h5>
                
            </div>      
            <div style="height:5px; width:70%; clear:both;"> <img src="{{asset('img/logoUes.jpg')}}"  width="100" height="100"alt="Logo" align="left"> </div>
            <div style="height:5px; width:100%; clear:right;"> <img src="{{asset('img/logo.jpg')}}" width="100" height="100"alt="Logo" align="right"> </div>   
            
        </div>      
        <br>    
        <br>   
        <br>   
<div style="height:28px; width:100%; float:left;"><label for="txtfecha" class="col-sm-2 control-label">Fecha</label><p>{{(Carbon\Carbon::now())->format('d/m/y')}}</p></div>
    <div tyle="height:28px; width:100%; float:both;"  class="form-group" align="right" >
            <br>    
            <br>   
            <br>  
            
            <div class="col-sm-4">
                
                <p>Generado por: {{Auth::user()->name}}<p>
            </div>
        </div>
        @if(session('computadoras') && session('computadoras') != null)
   
        <div  align="center" >                
           
            <table>
                
                    <caption> <h3 class="page-header">Empleados con computadoras viejas</h3></caption>
                <thead>
                    <tr>
      
         
                        <th scope="row">N°</th>
                     
                        <th scope="row">Nombre</th>
                     
                        <th scope="row">Ubicación</th>
                     
                        <th scope="row">Marca</th>
               
                        <th scope="row">Modelo</th>
               
                        <th scope="row">Fecha Adquisición</th>
                       
                       </tr>                     
                </thead>
                <tbody>
                    @foreach (session('computadoras') as $i => $compu)     
                    <tr>
                  
                    <td>{{$i+1}}</td>
                  
                    <td>{{$compu->employee->nombre}}</td>
                  
                    <td>{{$compu->employee->ubicacion}}</td>
            
                    <td>{{$compu->marca}}</td>
            
                    <td>{{$compu->modelo}}</td>
            
                    <td>{{(new Carbon\Carbon($compu->fechaAdqui))->format('d/m/Y')}}</td>
                  
                    </tr>       
             @endforeach                       
                </tbody>
            </table>
        </div >
        @endif

        @if(session('impresoras') && session('impresoras') != null)
   
        <div  align="center" >                
           
            <table>
                
                    <caption> <h3 class="page-header">Empleados con impresoras viejas</h3></caption>
                <thead>
                    <tr>
      
         
                        <th scope="row">N°</th>
                     
                        <th scope="row">Nombre</th>
                     
                        <th scope="row">Ubicación</th>
                     
                        <th scope="row">Marca</th>
               
                        <th scope="row">Modelo</th>
               
                        <th scope="row">Fecha Adquisición</th>
                       
                       </tr>                     
                </thead>
                <tbody>
                    @foreach (session('impresoras') as $i => $impre)     
                    <tr>
                  
                    <td>{{$i+1}}</td>
                  
                    <td>{{$impre->employee->nombre}}</td>
                  
                    <td>{{$impre->employee->ubicacion}}</td>
            
                    <td>{{$impre->marca}}</td>
            
                    <td>{{$impre->modelo}}</td>
            
                    <td>{{(new Carbon\Carbon($impre->fechaAdqui))->format('d/m/Y')}}</td>
                  
                    </tr>       
             @endforeach                       
                </tbody>
            </table>
        </div >
        @endif

<hr>

<P  align="right" >&nbsp; _________________________________<br>Firma</p>
    <p align="left">Sello</p>  
    
       
    <script>window.print()</script>
    
        
        
</body>
</html>
   

