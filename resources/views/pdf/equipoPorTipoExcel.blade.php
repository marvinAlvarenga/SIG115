<p>Equipo agregado al inventario</p>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <caption> <h3 class="page-header">Equipo agregado al inventario</h3></caption>
    <thead>
      <tr>
        <th>Serie</th>
        <th>Inventario</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Garantía</th>
        <th>Adquisicion</th>
      </tr>
    </thead>

    <tbody>
          @foreach($products as $product)
          <tr>
              <td>{{$product->numSe}}</td>
              <td>{{$product->numInv}}</td>
              <td>{{$product->marca}}</td>
              <td>{{$product->modelo}}</td>
              <td>{{$product->garantia}}</td>
              <td>{{$product->fechaAdqui}}</td>
            </tr>
      @endforeach
  </tbody>
  </table>