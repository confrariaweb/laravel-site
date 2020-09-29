@extends('dashboard.gentelella.layouts.app')

@section('title', trans('Dominios'))

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            {!! Form::open(['route' => ['admin.domains.store'], 'method' => 'post']) !!}
                @include('dashboard.gentelella.domains.partials.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection