@if(isset($produc40) != null)
   
        <div  align="center" >                
           <p>Equipo con mas de del 40% porciento del valor de adquisicion</p>
            <table>
                
                    <caption> <h3 class="page-header">Equipo con mas de del 40 porciento del valor de adquisicion</h3></caption>
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
            
                    <td>${{$producs40->valorAdqui}}</td>
            
                    <td>${{$producs40->costoSpares}}</td>
                  
                    </tr>       
                    
             @endforeach                       
                </tbody>
            </table>
        </div >
        @endif

       