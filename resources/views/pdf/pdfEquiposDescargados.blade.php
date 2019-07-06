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
                             <br>Reporte de Equipos que han sido Descargados
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
                <br>
                <div style="height:28px; width:100%; float:left;">
                    <br>
                    <br><p>CONSULTADO EN LAS FECHAS:</p>

                    de: {{$inicial}} &nbsp; hasta: {{$final}}

                </div>
s

                <div tyle="height:28px; width:100%; float:both;"  class="form-group" align="right" >
                        <br>
                        <br>
                        <br>
                        <label for="txtfecha" class="col-sm-2 control-label">Fecha</label>
                        <div class="col-sm-4">
                          <p>{{$date}}</p>
                        </div>
                    </div>
                    <br>

                    <div  align="center" >
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">N&uacute;mero de serie</th>
                            <th scope="col">N&uacute;mero de inventario</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">C&oacute;digo Descargo</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($productos as $producto)
                            <tr>
                              <td>{{ $producto->numSe }}</td>
                              <td>{{ $producto->numInv }}</td>
                              <td>{{ $producto->marca }}</td>
                              <td>{{ $producto->modelo }}</td>
                              <td>{{ $producto->codigo }}</td>
                            </tr>
                          @empty
                            <tr><td colspan="5">Ningun registro cumple los parametros asignados</td></tr>
                          @endforelse
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
