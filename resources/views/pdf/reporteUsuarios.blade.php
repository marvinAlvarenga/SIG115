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
                 <br>Reporte de usuarios registrados en el sistema
                 <br>San salvador, El Salvador Centro América</h5>
                
            </div>      
            <div style="height:5px; width:70%; clear:both;"> <img src="img/logoUes.jpg"  width="100" height="100"alt="Logo" align="left"> </div>
            <div style="height:5px; width:100%; clear:right;"> <img src="img/logo.jpg" width="100" height="100"alt="Logo" align="right"> </div>   
            
        </div>      
        <br>    
        <br>   
        <br>
        <br>
        <br>
<div style="height:28px; width:100%; float:left;"><label for="txtfecha" class="col-sm-2 control-label">Fecha de generación del reporte: </label><p>{{(Carbon\Carbon::now())->format('d/m/y')}}</p></div>
    <div tyle="height:28px; width:100%; float:both;"  class="form-group" align="right" >
            <br>    
            <br>   
            <br>  
            
            <div class="col-sm-4">
                
                <p>Generado por: {{Auth::user()->name}}<p>
            </div>
        </div>
        @if(isset($usuarios) && $usuarios != null)
   
        <div  align="center" >                
           
            <table>
                
                    <caption> <h3 class="page-header">Usuarios registrados en el sistema</h3></caption>
                <thead>
                    <tr>
      
         
                        <th scope="row">N°</th>
                     
                        <th scope="row">Nombre</th>
                     
                        <th scope="row">E_Mail</th>
                     
                        <th scope="row">Estado</th>
               
                        <th scope="row">Tipo</th>
               
                        <th scope="row">Fecha Admisión</th>
                       
                       </tr>                     
                </thead>
                <tbody>
                    @foreach ($usuarios as $i => $usuario)     
                    <tr>
                  
                    <td>{{$i+1}}</td>
                  
                    <td>{{$usuario->name}}</td>
                  
                    <td>{{$usuario->email}}</td>
            
                    <td>{{$usuario->estado==0 ? "Deshabilitado": "Habilitado"}}</td>
            
                    <td>{{$usuario->tipo==1 ? "Empleado de la Unidad" : "Practicante de Horas Sociales"}}</td>
            
                    <td>{{(new Carbon\Carbon($usuario->fechaAdmi))->format('d/m/Y')}}</td>
                  
                    </tr>       
             @endforeach                       
                </tbody>
            </table>
        </div >
        @endif
<hr>

<P  align="right" >&nbsp; _________________________________<br>Firma</p>
    <p align="left">Sello</p>         
</body>
</html>
   

