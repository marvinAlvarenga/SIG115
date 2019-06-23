<p>Cantidad de repuestos cambiados</p>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <caption> <h3 class="page-header">Cantidad de repuestos cambiados</h3></caption>
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Valor Unitario</th>
                    <th>Total Usados</th>
                  </tr>
                </thead>

                <tbody>
                      @foreach($spares as $spare)

                      <tr>
                          <td>{{$spare->nombre}}</td>
                          <td>{{$spare->tipo}}</td>
                          <td>{{$spare->marca}}</td>
                          <td>{{$spare->valorAdqui}}</td>
                          <td>{{$spare->count}}</td>
                  @endforeach
              </tbody>
              </table> 