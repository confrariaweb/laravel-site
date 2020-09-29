<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">        
        
        <div class="form-group">
            {!! Form::label('files', __('Banner')) !!}
            {!! Form::file('files[]', ["class" => "form-control", "id" => "banner", "aria-describedby" => "banner", "placeholder" => "banner"]) !!}
        </div>

    </div>
</div>

@if(isset($config_template->banners['options']))
    <div class="row">
        <div class="col-12">
            <h4>{{ __('Configurações exclusivas do template') }}</h4>
        </div>
        @foreach($config_template->banners['options'] as $optemp)
            @php
                $optemp = is_array($optemp)? (object) $optemp : $optemp;
            @endphp
            <div class="col-md-{{ $optemp->type == 'file'? 5 : 6 }} col-sm-12 col-xs-12 form-group">
                {!! form_generate($optemp, option($banner, $optemp->name)) !!}
            </div>
            @if($optemp->type == 'file')
                <div class="col-md-1 col-sm-12 col-xs-12 form-group">
                    <img src="{{ url('storage/' . option($banner, $optemp->name, '')) }}" class="img-fluid">
                </div>
            @endif
        @endforeach
    </div>
@endif




<button type="submit" class="btn btn-primary">Enviar</button>