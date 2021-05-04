<div class="card">
  <div class="card-header">
    Informações gerais do site
  </div>
  <div class="card-body">
    <div class="row">
        <div class="col-9">
            <div class="form-group">
                <label class="control-label">{{ __('title') }} <span class="required"> * </span></label>
                {!! Form::text('title', isset($site) ? $site->title : null, ['class' => 'form-control', 'placeholder' => 'Digite o titulo', 'required']) !!}
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">{{ __('status') }} <span class="required"> * </span></label>
                {!! Form::select('status', [1 => 'Ativado', 0 => 'Desativado'], isset($account) ? $account->status : null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">{{ __('template') }} <span class="required"> * </span></label>
                {!! Form::select('template_id', $templates, isset($site)? $site->template_id: NULL, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
  </div>
</div>