<div class="row input-social-network">
    <div class="col-3">
        <div class="form-group">
            <label class="control-label">{{ __('rede') }} <span class="required"> * </span></label>
            {!! Form::select('options[socialnetworks][0][key]', $socialnetworks, null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-9">
        <div class="form-group">
            <label class="control-label">{{ __('url') }} </label>
            {!! Form::text('options[socialnetworks][0][value]', null, ['class' => 'form-control', 'placeholder' => 'URL']) !!}
        </div>
    </div>
</div>
