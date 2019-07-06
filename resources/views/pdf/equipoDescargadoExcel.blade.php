<p>Reporte de Equipos Descargados.</p>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <caption> <h3 class="page-header">Equipo que ha sido descargado.</h3></caption>
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
          @foreach($productos as $producto)
            <tr>
              <td>{{ $producto->numSe }}</td>
              <td>{{ $producto->numInv }}</td>
              <td>{{ $producto->marca }}</td>
              <td>{{ $producto->modelo }}</td>
              <td>{{ $producto->codigo }}</td>
            </tr>
          @endforeach
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
