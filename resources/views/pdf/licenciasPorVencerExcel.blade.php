
<p>Equipo Con licencias vencidas o por vencer</p>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <caption> <h3 class="page-header">Equipo Con licencias vencidas o por vencer</h3></caption>
        <thead>
          <tr>
            <th>Número de Serie</th>
            <th>Número de inventario</th>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Licencia</th>
            <th>Fecha de vencimiento</th>
          </tr>
        </thead>

        <tbody>
              @foreach($products as $product)

              <tr>
                  <td>{{$product->numSe}}</td>
                  <td>{{$product->numInv}}</td>
                  <td>{{$product->descripcion}}</td>
                  <td>{{$product->tipo}}</td>
                  <td>{{$product->nombre}}</td>
                  <td>{{$product->fechaVencimiento}}</td>
          @endforeach
      </tbody>
      </table> 