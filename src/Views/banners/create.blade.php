@extends('dashboard::default.layouts.app')

@section('title', __('Banners'))
@section('subtitle', __('Criação de banners'))

@section('toolbar')
    <div class="btn-group mr-2">
        <a href="{{ route('admin.sites.banners.create') }}" class="btn btn-sm btn-outline-secondary">Novo</a>
    </div>
    @include('siteBanner::partials.toolbar')
@endsection

@section('content')
    {!! Form::open(['route' => ['admin.sites.banners.store'], 'files' => true, 'method' => 'post', 'id' => 'site-banner-form', 'class' => 'form-horizontal form-label-left']) !!}
    @include('siteBanner::partials.form')
    {!! Form::close() !!}
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush