<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">        
        
        <div class="form-group">
            {!! Form::label('domain', trans('domain.name')) !!}
            {!! Form::text('domain', isset($domain->name)? $domain->name : null, ["class" => "form-control", "id" => "title", "aria-describedby" => "Titulo do domain", "placeholder" => "Titulo do domain"]) !!}
            <small id="domainHelp" class="form-text text-muted">
                {!! trans('domain.muted.name') !!}
            </small>
        </div>

    </div>
</div>
<button type="submit" class="btn btn-primary">Enviar</button>