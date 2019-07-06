@if(isset($manDeto)!= null)
   
        <div  align="center" >                
           <p>Empleados con computadoras viejas</p>
            <table>
                
                    <caption> <h3 class="page-header">Empleados con computadoras viejas</h3></caption>
                    <thead>
                        <tr>
          
             
                            <th scope="row">Departamento</th>
                         
                            <th scope="row">Cantidad de mantenimientos</th>
                         
                            <th scope="row"> DE:{{$fechaInicial}} </th>
                      
                            <th scope="row"> HASTA:{{$fechaFinal}}</th>
                           </tr>                     
                    </thead>
                    <tbody>
                        @foreach ($manDeto as $manDeto)     
                        <tr>
                      
                        <td>{{$manDeto->Departamento}}</td>
                      
                        <td>{{$manDeto->Cantidad}}</td>
                      
                        </tr>       
                 @endforeach                       
                    </tbody>
            </table>
        </div >
        @endif

       