@extends('layout.base')

@section('css')

<link href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('js')

<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>


@endsection

@section('content')

<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center text-primary">Usuarios del Sistema</h6>
        </div>
        <div class="card-body m">
            @if (session('status'))
            <div class="alert alert-{{session('type_message')}}" role="alert">
                {{ session('status') }}
            </div>
            @endif
          <a href="{{route('usuarios.reporte')}}" class="btn btn-sm btn-info">Reporte de Usuarios Registrados</a>
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Nombre</th>
                              <th>EMail</th>
                              <th>Tipo</th>
                              <th>Estado</th>
                              <th>Fecha de Adminisión</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                            <th>Nombre</th>
                            <th>EMail</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Fecha de Adminisión</th>
                            <th>Acción</th>
                            </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->tipo==1 ? "Empleado de la Unidad" : "Practicante de Horas Sociales"}}</td>
                                <td>{{$user->estado==0 ? "Deshabilitado": "Habilitado"}}</td>
                                <td>{{(new Carbon\Carbon($user->fechaAdmi))->format('d/m/Y')}}</td>
                                <td><a href="{{route('usuarios.edit', $user->id)}}" class="btn btn-sm btn-primary"><span class="fa fa-edit"></span>Editar</a></td>
                            </tr>                       
                            @endforeach
                          </tbody>
                        </table>
                      </div>
        </div>
    </div>

@endsection