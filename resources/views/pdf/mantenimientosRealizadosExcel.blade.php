<p>Cantidad de manteniminetos por cada usuario</p>
                
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>E-Mail</th>
            <th>Status</th>
            <th>Tipo</th>
            <th>Total mantenimientos</th>
            <th scope="row"> DE:{{$fechaInicial}} </th>
                      
        <th scope="row"> HASTA:{{$fechaFinal}}</th>
          </tr>
        </thead>

        <tbody>
              @foreach($users as $user)

              <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->estado}}</td>
                  <td>{{$user->tipo}}</td>
                  <td>{{$user->total}}</td>
          @endforeach
      </tbody>
      </table>