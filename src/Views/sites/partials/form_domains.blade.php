<div class="card mt-3">
  <div class="card-header">
    Dominios
  </div>
  <div class="card-body">
    <div class="form-group">
        <label class="control-label">{{ __('domains') }} <span class="required"> * </span></label>
        {!! Form::select('sync[domains][]', $domains, isset($site)? $site->domains->pluck('id') : NULL, ['multiple'=>'multiple', 'class' => 'form-control']) !!}
      <small class="text-muted">Caso não tenha cadastrado o dominio ainda basta <a href="#">clicar aqui</a></small>
    </div>
  </div>
</div>
