@extends('dashboard::default.layouts.app')

@section('title', __('Sites'))
@section('subtitle', __('Lista de sites'))

@section('toolbar')
    <div class="btn-group mr-2">
        <a href="{{ route('admin.domains.create') }}" class="btn btn-sm btn-outline-secondary">Novo</a>
    </div>
    @include('domain::partials.toolbar')
    @endsection

    @section('content')
            {!! Form::model($domain, ['route' => ['admin.domains.update', $domain->id], 'method' => 'put']) !!}
                @include('domain::partials.form')
            {!! Form::close() !!}
    @endsection

@push('styles')

@endpush

@push('scripts')

@endpush