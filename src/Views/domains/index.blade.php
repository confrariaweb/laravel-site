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
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('domain.title') }}</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($domains as $domain)
                        <tr>
                          <th scope="row">{{ $domain->id }}</th>
                          <td>{{ $domain->domain }}</td>
                          <td>
                              <a href='{{ route('admin.domains.edit', $domain->id) }}'>Editar</a>
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