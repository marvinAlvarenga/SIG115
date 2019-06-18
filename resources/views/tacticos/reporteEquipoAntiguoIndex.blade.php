@extends('layout.base')

@section('content')

<div class="card shadow mb-4">
    <div class="card-body m">
        <!-- Content Row -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <img style="width:120px; height:148px;" src="{{ asset('img/logoUes.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
        
            <h1 class="h2 mb-0 text-gray-800 text-center">
            Universidad de El Salvador
            <span class="h3">
                <br>Facultad de Ciencias y Humanidades
            </span>
            <span class="h4">
                <br><br>Unidad de Mantenimiento de Inform&aacute;tica
            </span>
            <span class="h4">
                <br>Reporte de empleados con equipo antiguo ( > 3 años)
            </span>
            </h1>        
            <img style="width:150px; height:150px;" src="{{ asset('img/logo.jpg') }}" class="img-fluid pull-xs-left" alt="Logo Minerva">
        </div>
        @if(!isset($computadoras) && !isset($impresoras))
                    @if (session('status'))
                        <div class="alert alert-info" role="alert">
                            {{ session('status') }}
                        </div>
                @endif

        
                <form action="{{ route('tacticos.equipoAntiguoGenerate') }}" method="POST" class='pl-5'>
                    @csrf
                        <label><h5>Tipo de Equipo:</h5></label><br>
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" id="todos">Todos
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" id="computadora" name="tipo[]" value="1">Computadora
                              </label>
                              <label class="checkbox-inline">
                                <input type="checkbox" id="impresora" name="tipo[]" value="2">Impresora
                              </label>
                        </div>
                        <div class="row justify-content-center">
                        <div class="col-6">
                        
                        <input type="submit" class="btn btn-lg btn-primary" value="Generar Reporte">
                        <button class="btn btn-lg btn-primary" id="limpiar">Limpiar Campos</button>
                    </div>
                </div>
                </form>
        @else

                @if($computadoras != null)
                <span class="h5">Computadoras</span>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Ubicación</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Fecha Adquisición</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($computadoras as $i => $compu)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$compu->employee->nombre}}</td>
                    <td>{{$compu->employee->ubicacion}}</td>
                    <td>{{$compu->marca}}</td>
                    <td>{{$compu->modelo}}</td>
                    <td>{{(new Carbon\Carbon($compu->fechaAdqui))->format('d/m/Y')}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

        @if($impresoras != null)
        <span class="h5">Impresoras</span>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Ubicación</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Fecha Adquisición</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($impresoras as $i => $impre)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$impre->employee->nombre}}</td>
                    <td>{{$impre->employee->ubicacion}}</td>
                    <td>{{$impre->marca}}</td>
                    <td>{{$impre->modelo}}</td>
                    <td>{{(new Carbon\Carbon($impre->fechaAdqui))->format('d/m/Y')}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

        @if ($computadoras==null && $impresoras==null)
          <span class="h5">No hay datos que mostrar para los parámetros seleccionados</span>
          @else
          <div class="row justify-content-center">
            <div class="col-9">
            <form action="{{route('tacticos.equipoAntiguoImprimirPost')}}" method="POST">
              @csrf
              @if($computadoras!=null)
            <input type="hidden" name="tipo[]" value="{{$computadoras[0]->tipo}}">
            @endif
            @if($impresoras!=null)
            <input type="hidden" name="tipo[]" value="{{$impresoras[0]->tipo}}">
            @endif
            <input type="submit" class="btn btn-lg btn-primary" value="Imprimir reporte">
            <a href="{{route('tacticos.equipoAntiguoIndex')}}" class="btn btn-lg btn-primary">Regresar</a>
            <a href="{{route('tacticos.equipoAntiguoPdf',[$computadoras!=null?$computadoras[0]->tipo:'null',$impresoras!=null?$impresoras[0]->tipo:null])}}" id="pdf" class="btn btn-lg btn-primary">Exportar a PDF</a>
            <a href="{{route('tacticos.equipoAntiguoExcel',[$computadoras!=null?$computadoras[0]->tipo:'null',$impresoras!=null?$impresoras[0]->tipo:null])}}" id="pdf" class="btn btn-lg btn-primary">Exportar a Excel</a>

            </form>
            
        </div>
    </div>
        @endif 
        @endif     
    </div>
</div>

@endsection

@section('js')

<script>

const todosCheckBox = document.getElementById('todos')
const compuCheckBox = document.getElementById('computadora')
const impreCheckBox = document.getElementById('impresora')
const limpiarBtn = document.getElementById('limpiar')
const pdfBtn = document.getElementById('pdf')

todosCheckBox.addEventListener('change', (event) => {
  let state = event.target.checked
  compuCheckBox.checked = state
  impreCheckBox.checked = state
})

compuCheckBox.addEventListener('change', (event) => {
  todosCheckBox.checked = event.target.checked && impreCheckBox.checked
})

impreCheckBox.addEventListener('change', (event) => {
  todosCheckBox.checked = event.target.checked && compuCheckBox.checked
})

limpiarBtn.addEventListener('click', (event) => {
    event.preventDefault()
    compuCheckBox.checked = false
  impreCheckBox.checked = false
  todosCheckBox.checked = false
})

pdfBtn.addEventListener('click', (event) => {
    event.preventDefault()
})

</script>
    
@endsection