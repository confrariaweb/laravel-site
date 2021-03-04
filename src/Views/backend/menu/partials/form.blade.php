<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label class="control-label">Título <span class="required"> * </span></label>
            {!! Form::text('title', isset($menu) ? $menu->title : null, ['class' => 'form-control', 'placeholder' => 'Digite o titulo', 'required']) !!}
        </div>
        <div class="form-group">
            <label class="control-label">Url <span class="required"> * </span></label>
            {!! Form::select('route', $routes, isset($menu)? $menu->route : NULL, ['class' => 'form-control', 'placeholder' => 'Selecione a rota']) !!}
        </div>
    </div>
</div>