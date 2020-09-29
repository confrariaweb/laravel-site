<div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12 form-group">
        {!! Form::label('title', __('Titulo do site'), ['class' => 'control-label']) !!}
        {!! Form::text('title', isset($site->title)? $site->title : null, ["class" => "form-control", "id" => "title", "aria-describedby" => "Titulo do site", "placeholder" => "Titulo do site"]) !!}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        {!! Form::label('status', __('Status do site'), ['class' => 'control-label']) !!}
        {!! Form::select('status', ['1'=>trans('Ativo'), '0'=>trans('Desativado')], isset($site->status)? $site->status : null, ['id' => 'statussite', 'class' => 'form-control']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        {!! Form::label('template_id', __('Template do site'), ['class' => 'control-label']) !!}
        {!! Form::select('template_id', $templates, isset($site->template_id)? $site->template_id : null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-5 col-sm-9 col-xs-12">
        {!! Form::label('domain', __('Domínios do site'), ['class' => 'control-label']) !!}
        {!! Form::text('domain', isset($site->domains)? $site->domains->implode('domain', ',') : null, ["class" => "tags form-control", "id" => "tags_domains", "aria-describedby" => "Domínios do site", "placeholder" => "Domínios do site"]) !!}
        <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        {!! Form::label('options[logotipo]', __('Logotipo do site'), ['class' => 'control-label']) !!}
        {!! Form::file('options[logotipo]', ["class" => "form-control", "id" => "logotipo", "aria-describedby" => "Logotipo do site", "placeholder" => "Logotipo do site"]) !!}
    </div>

    <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        <img src="{{ url('storage/' . option($site, 'logotipo')) }}" class="img-fluid">
    </div>

    <div class="col-md-7 col-sm-12 col-xs-12 form-group">
        {!! Form::label('options[slogan]', __('Slogan do site'), ['class' => 'control-label']) !!}
        {!! Form::text('options[slogan]', option($site, 'slogan'), ["class" => "form-control", "id" => "slogan", "aria-describedby" => "Slogan do site", "placeholder" => "Slogan do site"]) !!}
    </div>

</div>

@if(isset($config_template->options))
    <div class="row">
        <div class="col-12">
            <h4>{{ __('Configurações exclusivas do template') }}</h4>
        </div>
        @foreach($config_template->options as $optemp)
            @php
                $optemp = is_array($optemp)? (object) $optemp : $optemp;
            @endphp
            <div class="col-md-{{ $optemp->type == 'file'? 5 : 6 }} col-sm-12 col-xs-12 form-group">
                {!! form_generate($optemp, option($site, $optemp->name)) !!}
            </div>
            @if($optemp->type == 'file')
                <div class="col-md-1 col-sm-12 col-xs-12 form-group">

                    <img src="{{ url('storage/' . option($site, $optemp->name, '')) }}" class="img-fluid">
                </div>
            @endif
        @endforeach
    </div>
@endif

<div class="row">
    <div class="ln_solid"></div>
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 form-group">
        {!! Form::submit(__('Salvar'), ['class' => 'btn btn-success']) !!}
    </div>
</div>