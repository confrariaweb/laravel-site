@extends('dashboard.gentelella.layouts.app')

@section('title', __('Paginas de ' . $page_type->title))

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>
                {{ __('Lista de paginas de ' . $page_type->title) }} 
                <small>{{ _('Lista de paginas de ' . $page_type->title) }}</small>
            </h2>
            @include('dashboard.gentelella.pages.partials.panel_toolbox')
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <p class="text-muted font-13 m-b-30">
                {{ __('Abaixo segue a sua lista de paginas') }}
            </p>
            <table id="datatable-pages" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Tipo') }}</th>
                        <th>{{ __('Titulo') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Site') }}</th>
                        <th>{{ __('Ações') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($pages))
                    @foreach($pages as $page)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $page->type->title }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{!! status($page->status) !!}</td>
                        <td>{{ $page->site->title }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.pages.edit.pagetype', ['id' => $page->id, 'slugPageType' => $page_type->slug]) }}" class="btn btn-success btn-xs">
                                <i class="fa fa-edit"></i> {{ __('Editar') }}  
                            </a>                           
                            <a href="#" class="btn btn-danger btn-xs" onclick="if(confirm('Tem certeza que deseja deletar?')){ document.getElementById('destroy_{{ $page->id }}').submit(); }">
                                <i class="fa fa-trash-o"></i> {{ __('Deletar') }}  
                            </a>        
                            {!! Form::open([ 'method'  => 'DELETE', 'route' => ['admin.pages.destroy', $page->id], 'id' => 'destroy_' . $page->id ]) !!}
                                {!! Form::hidden('id', $page->id) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link href="{{ asset('assets/dashboard/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('assets/dashboard/gentelella/vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script>
        $(document).ready( function () {
            $("#datatable-pages").DataTable();
        } );
    </script>
@endpush