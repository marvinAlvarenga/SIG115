@if(isset($empleMantos)!= null)
   
        <div  align="center" >                
           <p>Mantenimientos realizados en un rango de fecha</p>
            <table>
                
                    <caption> <h3 class="page-header">Mantenimientos realizados en un rango de fecha</h3></caption>
                    <thead>
                        <tr>
          
             
                            <th scope="row">Persona que realizo el mante</th>
    
                            <th scope="row">N° de serie</th>
                         
                            
                            <th scope="row">N° de inv</th>
                            
                            <th scope="row">Marca</th>
                            
                            <th scope="row">Modelo</th>
                            
                            <th scope="row">Tipo</th>
                         
                            
                           </tr>                     
                    </thead>
                    <tbody>
                        @foreach ($empleMantos as $empleMantos)     
                        <tr>
                      
                        <td>{{$empleMantos->nombre}}</td>
    
                        <td>{{$empleMantos->numSe}}</td>
                      
                        <td>{{$empleMantos->numInv}}</td>
                        
                        <td>{{$empleMantos->marca}}</td>
                        
                        <td>{{$empleMantos->modelo}}</td>
                        
                        <td>{{$empleMantos->tipo}}</td>
                      
                        </tr>       
                 @endforeach                             
                    </tbody>
            </table>
        </div >
        @endif

       