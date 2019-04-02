@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('warning') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                    <h2>Click para crear un nuevo pago</h2>
                </div>
                <div class="col-md-12 mt-4 mb-4">
                    <button data-toggle="collapse" class="btn btn-primary mb-4" data-target="#paymodal">Nuevo pago</button>

                    <div id="paymodal" class="collapse border mt-4">
                        <div class="container mt-4">
                            <form action="{{ route('new.pay') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group col-md-6">
                                    <label for="mount">Monto:</label>
                                    <input type="number" name="mount" class="form-control" placeholder="Pesos Colombianos (COP)">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="description">Descripcion</label>
                                    <input type="textarea" name="description" class="form-control" placeholder="Descripcion del producto">
                                </div>
                                <div class="col-md-12 mb-4 ">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">Intentos de pago</div>
                 <div class="col-md-12 mt-4">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Fecha y hora</th>
                          <th scope="col">Referencia</th>
                          <th scope="col">Autorizacion/Cus</th>
                          <th scope="col">Estado</th>
                          <th scope="col">Valor</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(Auth::user()->payAttempts)
                            @foreach( Auth::user()->payAttempts as $pay)
                                <tr>
                                  <th scope="row">{{ $pay->created_at }}</th>
                                  <td>{{ $pay->internalReference }}</td>
                                  <td>{{ $pay->authorization }}</td>
                                  <td>
                                    @if($pay->status == 'APPROVED')
                                      <span class="badge badge-success">Aprobada</span>
                                    @elseif($pay->status == 'PENDING')
                                      <span class="badge badge-info">Pendiente</span>
                                    @else
                                      <span class="badge badge-danger">Rechazado</span>
                                    @endif
                                  </td>
                                  <td>{{ $pay->mount }}</td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            No hay intentos de pago
                        </tr>
                        @endif
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
