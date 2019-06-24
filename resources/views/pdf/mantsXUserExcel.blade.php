
<p>Reporte de Usuarios que solicitan mas mantenimientos.</p>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <caption> <h3 class="page-header">Equipo Con licencias vencidas o por vencer</h3></caption>
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Ubicaci&oacute;n</th>
              <th scope="col" style="width: 250px;">Mantenimientos Solicitados</th>
            </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nombre }}</td>
                <td>{{ $user->ubicacion }}</td>
                <td>{{ $user->count }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
