@extends('layout.base')
 
@section('content')
<!-- Content Row -->


<div class="row ">
        <div class="col-sm-7">
          <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('gerenciales.equipoportipo') }}" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text ">Desde</span>
                              </div>
                                  <input class="form-control" type="date" id="gridCheck" name="desde">
                          </div>
                      </div>
                      <div class="col">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text ">Hasta</span>
                              </div>
                                  <input class="form-control" type="date" name="hasta">
                          </div>
                      </div>
                    </div>
                  
            </div>
          </div>
        </div>
      
              <div class="col-sm-3">
                    <div class="card mb-3 mt-2">
                      <div class="card-body">
                          <div class="form-row">
                              <div class="col">
                          <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="exampleRadios1" value="1" checked>
                                <label class="form-check-label" for="exampleRadios1">PC</label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="exampleRadios2" value="2">
                                <label class="form-check-label" for="exampleRadios2">Impresora</label>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-check disabled">
                                <input class="form-check-input" type="radio" name="tipo" id="exampleRadios3" value="3"  checked>
                                <label class="form-check-label" for="exampleRadios3">Todo</label>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
              
        <div class="col-sm-3">
            <button type="submit" class="btn btn-sm mb-3 btn-primary">Generar Reporte</button>
                </div>
      </div>
    </form>
      
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