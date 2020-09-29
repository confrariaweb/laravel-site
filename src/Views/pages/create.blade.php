@extends('dashboard.gentelella.layouts.app')

@section('title', __('Páginas de ' . $page_type->title))

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('Criar uma nova página de ' . $page_type->title) }} <small>{{ __('Ao criar uma pagina ela sera vinculado ao plano escolhido.') }}</small></h2>
                @include('dashboard.gentelella.pages.partials.panel_toolbox')
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                {!! Form::open(['route' => ['admin.pages.store'], 'method' => 'post', 'id' => 'integration-form', 'class' => 'form-horizontal form-label-left']) !!}
                    @include('dashboard.gentelella.pages.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link href="{{ asset('assets/dashboard/gentelella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/starrr/dist/starrr.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('assets/dashboard/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/google-code-prettify/src/prettify.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/parsleyjs/dist/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/autosize/dist/autosize.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/gentelella/vendors/starrr/dist/starrr.js') }}"></script>
@endpush