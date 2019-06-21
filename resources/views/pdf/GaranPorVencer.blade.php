@if(isset($empleManto)!= null)
   
        <div  align="center" >                
           <p>Cantidad de mantenimientos solicitados por empleados</p>
            <table>
                
                    <caption> <h3 class="page-header">Cantidad de mantenimientos solicitados por empleado</h3></caption>
                    <thead>
                        <tr>
          
             
                            <th scope="row">Num Serie</th>
    
                            <th scope="row">Num Inv.</th>                   
                                                     
                            <th scope="row">Marca </th>
                         
                            <th scope="row"> Modelo </th>
                         
                            <th scope="row"> Estado </th>
                         
                            <th scope="row"> Tipo </th>
                         
                            <th scope="row">Tiempo faltante(meses) </th>
                         
                           
                            
                           </tr>                     
                    </thead>
                    <tbody>
                           
                        @foreach ($empleManto as $i => $product)    
                        
                        <tr>
                               
                        <td>{{$product->numSe}}</td>
    
                        <td>{{$product->numSe}}</td>

                        <td>{{$product->marca}}</td>

                        <td>{{$product->modelo}}</td>
                      
                        <td>{{$product->estado}}</td>

                        <td>{{$product->tipo}}</td>

                        <td>{{$tiempoFaltante[$i]}}</td>

                        </tr>       
                 @endforeach                             
                    </tbody>
            </table>
        </div >
        @endif

       