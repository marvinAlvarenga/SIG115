@extends('layout.base')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-center text-primary">Registrar Usuarios</h6>
    </div>
    <div class="card-body m">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                <div class="col-md-6">
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}">
                        <option value="">--------------</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{($role->id == old('role')) ? "selected": ""}} >{{ $role->name }}</option>
                        @endforeach                   
                    </select>

                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>

                <div class="col-md-6">
                    <div class="form-check @error('tipo') is-invalid @enderror">
                        <label class="form-check-label" for="empleado">
                            <input type="radio" class="form-check-input" id="empleado" name="tipo" value="1" {{old('tipo')==1?"checked":"checked"}}>Empleado de la Unidad
                        </label>
                        </div>
                        <div class="form-check">
                        <label class="form-check-label" for="practicante">
                            <input type="radio" class="form-check-input" id="practicante" name="tipo" value="2" {{old('tipo')==2?"checked":""}}>Practicante Horas Sociales
                        </label>
                    </div>                    
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Registrar') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
