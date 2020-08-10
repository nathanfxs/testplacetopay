@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Consulta el estado de tu orden:</strong></div>

                <div class="card-body">

                @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        - {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
