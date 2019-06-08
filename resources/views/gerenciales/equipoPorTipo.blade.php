@extends('layout.base')
 
@section('content')
<!-- Content Row -->
<div class="row">
  <div class="col-lg-12  w-100">
<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-0 text-gray-800">SIGME</h1>
    </div>
  </div>
</div>

<div class="row ">
        <div class="col-sm-4">
          <div class="card mb-3">
            <div class="card-body">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text ">Desde</span>
                    </div>
                        <input class="form-control" type="date">
                </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 ">
                <div class="card mb-3 ">
                  <div class="card-body">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text ">Hasta</span>
                          </div>
                              <input class="form-control" type="date">
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                    <div class="card mb-3">
                      <div class="card-body">
                          <div class="form-row">
                              <div class="col">
                          <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">PC</label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">Impresora </label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
                                <label class="form-check-label" for="exampleRadios3">Todo</label>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
        <div class="col-sm-3">
                <a href="#" class="btn btn-sm btn-primary mb-2  p-2 ">Generar Reporte</a>
                </div>
      </div>
      
<div class="row">
        <div class="col-lg-12  w-100">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Equipo informático agregado al inventario por tipo</h6>
        </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        @php($rowe="")
                        @if(($product->state)!=true)
                            @php( $rowe="bg-dnger")
                        @endif
                        <tr class="{{$rowe}}">
                            <td>{{$product->numInv}}</td>
                            
                            <td>{{$product->numSe}}</td>
                            <td>{{$product->marca}}</td>
                            <td>{{$product->modelo}}</td>
                            <td>{{$product->garantia}}</td>
                            <td>{{$product->fechaAdqui}}</td>
                    @endforeach
                </tbody>
                </table>
              </div>
            </div>
    </div>

     </div>
    </div>
 
@endsection