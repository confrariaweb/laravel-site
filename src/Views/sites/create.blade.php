<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('sites') }}
                </h2>
            </div>
            <div class="col-6 text-right">
                <div class="btn-group btn-sm" role="group" aria-label="Basic">
                    <a href="{{ route('dashboard.sites.create') }}" class="btn btn-sm btn-primary">{{ __('new') }}</a>
                    <button type="button" class="btn btn-sm btn-success" onclick="$('#site-form').submit();">{{ __('save') }}</button>
                    <a href="{{ route('dashboard.sites.index') }}" class="btn btn-sm btn-warning">{{ __('return') }}</a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {!! Form::open(['route' => 'dashboard.sites.store', 'class' => 'site-form', 'id' => 'site-form', 'files' => true]) !!}
                        @include('site::sites.partials.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>