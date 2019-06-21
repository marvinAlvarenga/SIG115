@if(isset($empleMantos)!= null)
   
        <div  align="center" >                
           <p>Cantidad de mantenimientos solicitados por empleados</p>
            <table>
                
                    <caption> <h3 class="page-header">Cantidad de mantenimientos solicitados por empleado</h3></caption>
                    <thead>
                        <tr>
          
             
                            <th scope="row">Nombre</th>
    
                            <th scope="row">Ubicacion</th>
                         
                            <th scope="row">Cantidad de mantenimientos solicitados</th>
                         
                            
                           </tr>                     
                    </thead>
                    <tbody>
                        @foreach ($empleMantos as $empleMantos)     
                        <tr>
                      
                        <td>{{$empleMantos->nombre}}</td>
    
                        <td>{{$empleMantos->ubicacion}}</td>
                      
                        <td>{{$empleMantos->Cantidad}}</td>
                      
                        </tr>       
                 @endforeach                             
                    </tbody>
            </table>
        </div >
        @endif

       