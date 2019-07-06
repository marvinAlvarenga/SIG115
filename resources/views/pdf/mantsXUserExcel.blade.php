
<p>Reporte de Usuarios que solicitan mas mantenimientos.</p>
<table class="table table-bordered" id="dataTable" cellspacing="0">
        <caption> <h3 class="page-header">Reporte de Usuarios que solicitan mas mantenimientos.</h3></caption>
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Ubicaci&oacute;n</th>
              <th scope="col" >Mantenimientos Solicitados</th>
            </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nombre }}</td>
                <td>{{ $user->ubicacion }}</td>
                <td>{{ $user->count }}</td>
            @endforeach
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
            </tr>
            <tr>
              <td>Desde: {{$fecha_inicial}}</td>
              <td>Hasta: {{$fecha_final}}</td>
            </tr>
          </tbody>
        </table>
