<div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12 form-group">
        {!! Form::label('title', __('Titulo da página'), ['class' => 'control-label']) !!}
        {!! Form::text('title', isset($page->title)? $page->title : null, ["class" => "form-control", "id" => "title", "aria-describedby" => "Titulo da pagina", "placeholder" => "Titulo da pagina"]) !!}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        {!! Form::label('page_type_id', __('Tipo da página'), ['class' => 'control-label']) !!}
        {!! Form::select('page_type_id', $types, isset($page_type->id)? $page_type->id : null, ['class' => 'form-control', "readonly" => isset($page_type->id)? "readonly" : false]) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12 form-group">
        {!! Form::label('slug', __('Slug da página'), ['class' => 'control-label']) !!}
        {!! Form::text('slug', isset($page->slug)? $page->slug : null, ["class" => "form-control", "id" => "slug", "aria-describedby" => "Slug da pagina", "placeholder" => "Slug da pagina"]) !!}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        {!! Form::label('status', __('Status da página'), ['class' => 'control-label']) !!}
        {!! Form::select('status', ['1'=> __('Ativada'), '0' => __('Desativada')], isset($page->status)? $page->status : null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12 form-group">
        {!! Form::label('content', __('Conteúdo da página'), ['class' => 'control-label']) !!}
        {!! Form::textarea('content', isset($page->content)? $page->content : null, ["class" => "form-control", "id" => "content", "aria-describedby" => "Conteudo da pagina", "placeholder" => "Conteudo da pagina"]) !!}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-info">Posts</a>
    </div>
    
    <div class="col-md-3 col-sm-9 col-xs-12 form-group">
        {!! Form::label('sites', __('Sites'), ['class' => 'control-label']) !!}
        @foreach($sites as $site)
        <div class="">
            <label>
                {!! Form::checkbox('sites[]', $site->id, (isset($page->sites))? $page->sites->contains($site->id) : null, ["class" => "js-switch"]) !!}  {{ $site->title }}
            </label>
        </div>
        @endforeach
    </div>
    
</div>
@if(isset($page_type->options))
<div class="row">
    {!! form_options($page_type->options, isset($page->options)? $page->options : null) !!}
</div>
@endif
<div class="row">
    <div class="ln_solid"></div>
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 form-group">
        {!! Form::submit(__('Salvar'), ['class' => 'btn btn-success']) !!}
    </div>
</div>