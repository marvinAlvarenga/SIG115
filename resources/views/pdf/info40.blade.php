<!DOCTYPE html>
<html lang="en">
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
                 <br>DICTAMEN TÉCNICO DE FALLAS DE EQUIPOS
                 <br>San salvador, El Salvador Centro América</h5>
                
            </div>      
            @if(isset($imprimir))
            <div style="height:5px; width:70%; clear:both;"> <img src="{{asset('img/logoUes.jpg')}}"  width="100" height="100"alt="Logo" align="left"> </div>
            <div style="height:5px; width:100%; clear:right;"> <img src="{{asset('img/logo.jpg')}}" width="100" height="100"alt="Logo" align="right"> </div>
            @else 
            <div style="height:5px; width:70%; clear:both;"> <img src="img/logoUes.jpg"  width="100" height="100"alt="Logo" align="left"> </div>
            <div style="height:5px; width:100%; clear:right;"> <img src="img/logo.jpg" width="100" height="100"alt="Logo" align="right"> </div> 
            @endif
        </div>      
        <br>    
        <br>   
        <br>   
<div style="height:28px; width:100%; float:left;"><br><p>Unidad Solicitante: ADMINISTRACION FINANCIERA<p>
    <br>Equipos con mantenimientos superiores a 40% del valor de compra 
</div>
    <div tyle="height:28px; width:100%; float:both;"  class="form-group" align="right" >
            <br>    
           
            <br>  
            <label for="txtfecha" class="col-sm-2 control-label">Fecha</label>
            <div class="col-sm-4">
                <p>{{$date}}</p>
            </div>
        </div>

   
        <div  align="center" >                
           
            <table      >
                
                    <caption> <h3 class="page-header">Datos generales</h3></caption>
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

<P  align="right" >_________________________________<br>Nombre<br> &nbsp; _________________________________<br>Firma</p>
    <p align="left">Sello</p>  
    
       
    @if(isset($imprimir))
    <script>window.print()</script>
    @endif
    
        
        
</body>
</html>
   

