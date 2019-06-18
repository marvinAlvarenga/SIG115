@if(isset($computadoras) && $computadoras != null)
   
        <div  align="center" >                
           <p>Empleados con computadoras viejas</p>
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
                    @foreach ($computadoras as $i => $compu)     
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

        @if(isset($impresoras) && $impresoras != null)
   
        <div  align="center" > 
            <p>Empleados con impresoras viejas</p>               
           
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
                    @foreach ($impresoras as $i => $impre)     
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