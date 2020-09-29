@extends('dashboard::default.layouts.app')

@section('title', __('Sites'))
@section('subtitle', __('Editar sites'))

@section('toolbar')
    <div class="btn-group mr-2">
        <a href="{{ route('admin.sites.create') }}" class="btn btn-sm btn-outline-secondary">Novo</a>
    </div>
    @include('site::partials.toolbar')
@endsection

@section('content')
    {!! Form::model($site, ['route' => ['admin.sites.update', $site->id], 'files' => true, 'method' => 'put', 'id' => 'site-form', 'class' => 'form-horizontal form-label-left']) !!}
    @include('site::partials.form')
    {!! Form::close() !!}
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush