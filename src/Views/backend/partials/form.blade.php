<div class="row">
    <div class="col-9">
        <div class="form-group">
            <label class="control-label">Título <span class="required"> * </span></label>
            {!! Form::text('title', isset($site) ? $site->title : null, ['class' => 'form-control', 'placeholder' => 'Digite o titulo', 'required']) !!}
        </div>
        <div class="form-group">
            <label class="control-label">Domínio <span class="required"> * </span></label>
            {!! Form::select('sync[domains][]', $domains, isset($site)? $site->domains->pluck('id') : NULL, ['multiple'=>'multiple', 'class' => 'form-control', 'placeholder' => 'Selecione o domínio']) !!}
        </div>
        <div class="form-group">
            <label class="control-label">Template <span class="required"> * </span></label>
            {!! Form::select('template_id', $templates, isset($site)? $site->template_id: NULL, ['class' => 'form-control', 'placeholder' => 'Selecione o template']) !!}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="control-label">Status <span class="required"> * </span></label>
            {!! Form::select('status', [1 => 'Ativado', 0 => 'Desativado'], isset($account) ? $account->status : null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>