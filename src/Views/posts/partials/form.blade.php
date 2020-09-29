<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        {!! Form::label('email', __('Email'), ['class' => 'control-label']) !!}
        {!! Form::email('email', isset($lead->email)? $lead->email : null, ["class" => "form-control", "id" => "email", "aria-describedby" => "Email", "placeholder" => "Email"]) !!}
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        {!! Form::label('phone', __('Telefone'), ['class' => 'control-label']) !!}
        {!! Form::text('phone', isset($lead->phone)? $lead->phone : null, ["class" => "form-control", "id" => "phone", "aria-describedby" => "Telefone", "placeholder" => "Telefone"]) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        {!! Form::label('client_id', __('Cliente'), ['class' => 'control-label']) !!}
        {!! Form::select('client_id', $clients, isset($lead->client_id)? $lead->client_id : null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        {!! Form::label('users', __('Usuarios do lead'), ['class' => 'control-label']) !!}
        {!! Form::select('users[]', $users, isset($lead->users)? $lead->users : null, ['multiple'=>'multiple', 'class' => 'form-control']) !!}
    </div>
</div>

@if(isset($lead->options))
    <div class="row">
        <div class="ln_solid"></div>
        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
            <h4>{{ __('Informações gerais do lead') }}</h4>
        </div>
        @foreach($lead->options as $input_k => $input_v)
            <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                {!! Form::label('options[' . $input_k . ']', __($input_k), ['class' => 'control-label']) !!}
                {!! Form::text('options[' . $input_k . ']', isset($input_vl)? $input_v : null, ["class" => "form-control", "id" => "' . $input_k . '", "aria-describedby" => "' . $input_k . '", "placeholder" => "' . $input_k . '"]) !!}
            </div>
        @endforeach
    </div>
@endif

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        <div class="">
            <label>
                {!! Form::checkbox('read', true, $lead->read, ["class" => "js-switch"]) !!}  Marcar como lido
            </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="ln_solid"></div>
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 form-group">
        {!! Form::submit(__('Enviar'), ['class' => 'btn btn-success']) !!}
    </div>
</div>