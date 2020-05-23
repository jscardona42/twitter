@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if(isset($tweet))
            <div class="card">
                <div class="card-header text-center">Modificar Tweet</div>
                <div class="card-body">
                    <form action="{{url('/tweets/'.$tweet->id)}}" method="post">
                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <textarea name="content" id="content" class="form-control">{{$tweet->content}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header text-center">Nuevo Tweet</div>
                <div class="card-body">
                    <form action="{{url('/tweets')}}" method="post">
                        {{csrf_field()}}
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <textarea name="content" id="content" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Publicar</button>
                        </div>
                    </form>
                </div>
            </div>
            @endisset
        </div>
    </div>
    @isset($tweets)
    <fieldset class="p-4 fieldset-blue">
        <legend class="w-auto p-2 text-bold text-center">Listado de tweets</legend>
        <div class="row mt-4 text-center mx-auto">
            @foreach($tweets as $tweet)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <p>{{ $tweet->name}}</p>
                    </div>
                    <div class="card-body">
                        <p>{{ $tweet->content}}</p>
                        <p>{{ $tweet->created_at}}</p>
                        {{ __('Es el mismo autor')}}
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{url('tweets/'.$tweet->id)}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('GET')}}
                                    <button class="btn btn-primary btn-block">Editar</button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{url('tweets/'.$tweet->id)}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" onclick="return confirm('¿Borrar?');" class="btn btn-danger btn-block">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </fieldset>
    @endisset
</div>
@endsection