@extends('dashboard::default.layouts.app')

@section('title', __('Sites'))
@section('subtitle', __('Lista de sites'))

@section('toolbar')
    <div class="btn-group mr-2">
        <a href="{{ route('admin.sites.create') }}" class="btn btn-sm btn-outline-secondary">Novo</a>
    </div>
    @include('site::partials.toolbar')
@endsection

@section('content')
    <table id="datatable-sites" class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>{{ __('Titulo') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Dominios') }}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($sites as $site)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $site->title }}</td>
                <td>
                    @if(isset($site->domains))
                        <ul>
                        @foreach($site->domains as $domain)
                            <li>{{ $domain->domain }}</li>
                        @endforeach
                        </ul>
                    @endif
                </td>
                <td>{!! status($site->status) !!}</td>
                <td class="text-right">
                    @permission('site-show')
                        <a href="{{ route('admin.sites.show', $site->id) }}" class="btn btn-primary btn-xs">
                            <i class="fa fa-folder"></i> {{ __('Ver') }}
                        </a>
                    @endpermission
                    @permission('site-edit')
                        <a href="{{ route('admin.sites.edit', $site->id) }}" class="btn btn-info btn-xs">
                            <i class="fa fa-pencil"></i> {{ __('Editar') }}
                        </a>
                    @endpermission
                    @permission('site-destroy')
                        <a href="#" class="btn btn-danger btn-xs"
                           onclick="if(confirm('Tem certeza que deseja deletar?')){ document.getElementById('destroy_{{ $site->id }}').submit(); }">
                            <i class="fa fa-trash-o"></i> {{ __('Deletar') }}
                        </a>
                        {!! Form::open([ 'method'  => 'DELETE', 'route' => ['admin.sites.destroy', $site->id], 'id' => 'destroy_' . $site->id ]) !!}
                        {!! Form::hidden('id', $site->id) !!}
                        {!! Form::close() !!}
                    @endpermission
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush