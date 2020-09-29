<div class="row form_options" id="option-{{ isset($option->name)? $option->name : 100 }}">
    @php
    $contOptions = isset($option->name)? $option->name : 0;
    @endphp
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        {!! Form::label('options[' . $contOptions . '][type]', __('Tipo do input'), ['class' => 'control-label']) !!}
        {!! Form::select('options[' . $contOptions . '][type]', $options_type, isset($option->type)? $option->type : null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        {!! Form::label('options[' . $contOptions . '][name]', __('Nome do input'), ['class' => 'control-label']) !!}
        {!! Form::text('options[' . $contOptions . '][name]', isset($option->name)? $option->name : null, ["class" => "form-control", "aria-describedby" => "Nome do input", "placeholder" => "Nome do input"]) !!}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        {!! Form::label('options[' . $contOptions . '][label]', __('Label do input'), ['class' => 'control-label']) !!}
        {!! Form::text('options[' . $contOptions . '][label]', isset($option->label)? $option->label : null, ["class" => "form-control", "aria-describedby" => "Label do input", "placeholder" => "Label do input"]) !!}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        {!! Form::label('options[' . $contOptions . '][placeholder]', __('Placeholder do input'), ['class' => 'control-label']) !!}
        {!! Form::text('options[' . $contOptions . '][placeholder]', isset($option->placeholder)? $option->placeholder : null, ["class" => "form-control", "aria-describedby" => "Placeholder do input", "placeholder" => "Placeholder do input"]) !!}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        {!! Form::label('options[' . $contOptions . '][value]', __('Valor do input'), ['class' => 'control-label']) !!}
        {!! Form::text('options[' . $contOptions . '][value]', isset($option->value)? $option->value : null, ["class" => "form-control", "aria-describedby" => "Valor do input", "placeholder" => "Valor do input"]) !!}
    </div>
    <div class="col-md-1 col-sm-12 col-xs-12 form-group">
        {!! Form::label('actions', __('###'), ['class' => 'control-label']) !!}
        <a href="javascript:void(0);" class="btn btn-link text-danger glyphicon glyphicon-remove remove-element" remove-element="option-{{ isset($option->name)? $option->name: 'not-remove' }}" aria-hidden="true"></a>
    </div>
</div>