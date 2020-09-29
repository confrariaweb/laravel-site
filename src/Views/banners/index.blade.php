@extends('dashboard::default.layouts.app')

@section('title', __('Banners'))
@section('subtitle', __('Lista de banners'))

@section('toolbar')
    <div class="btn-group mr-2">
        <a href="{{ route('admin.sites.banners.create') }}" class="btn btn-sm btn-outline-secondary">Novo</a>
    </div>
    @include('siteBanner::partials.toolbar')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">{{ __('Banner') }}</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ json_decode($banner->file, true)['file'] }}</td>
                            <td>
                                @permission('site-banner-show')
                                    <a href="{{ route('admin.sites.banners.show', $banner->id) }}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-folder"></i> {{ __('Ver') }}
                                    </a>
                                @endpermission
                                @permission('site-banner-edit')
                                    <a href="{{ route('admin.sites.banners.edit', $banner->id) }}" class="btn btn-info btn-xs">
                                        <i class="fa fa-pencil"></i> {{ __('Editar') }}
                                    </a>
                                @endpermission
                                @permission('site-banner-destroy')
                                    <a href="#" class="btn btn-danger btn-xs"
                                       onclick="if(confirm('Tem certeza que deseja deletar?')){ document.getElementById('destroy_{{ $banner->id }}').submit(); }">
                                        <i class="fa fa-trash-o"></i> {{ __('Deletar') }}
                                    </a>
                                    {!! Form::open([ 'method'  => 'DELETE', 'route' => ['admin.sites.banners.destroy', $banner->id], 'id' => 'destroy_' . $banner->id ]) !!}
                                    {!! Form::hidden('id', $banner->id) !!}
                                    {!! Form::close() !!}
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush