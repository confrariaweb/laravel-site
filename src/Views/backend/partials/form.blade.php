<div class="form-group">
    <label class="control-label">Título <span class="required"> * </span></label>
    {!! Form::text('title', isset($site) ? $site->title : null, ['class' => 'form-control', 'placeholder' => 'Digite o titulo', 'required']) !!}
</div>

<div class="form-group">
    <label class="control-label">Template <span class="required"> * </span></label>
    {!! Form::select('template_id', $templates, isset($site)? $site->template_id : NULL, ['class' => 'form-control', 'placeholder' => 'Selecione o template']) !!}
</div>

<div class="form-group">
    <label class="control-label">Domínio <span class="required"> * </span></label>
    {!! Form::select('sync[domains][]', $domains, isset($site)? $site->domains->pluck('id') : NULL, ['multiple'=>'multiple', 'class' => 'form-control', 'placeholder' => 'Selecione o dominio']) !!}
</div>