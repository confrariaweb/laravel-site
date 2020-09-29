<div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        {!! Form::label('title', __('Titulo'), ['class' => 'control-label']) !!}
        {!! Form::text('title', isset($page_type->title)? $page_type->title : null, ["class" => "form-control", "id" => "title", "aria-describedby" => "Titulo da pagina", "placeholder" => "Titulo da pagina"]) !!}
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
        {!! Form::label('slug', __('Slug da página'), ['class' => 'control-label']) !!}
        {!! Form::text('slug', isset($page_type->slug)? $page_type->slug : null, ["class" => "form-control", "id" => "slug", "aria-describedby" => "Slug da pagina", "placeholder" => "Slug da pagina"]) !!}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        {!! Form::label('posts', __('Posts na página'), ['class' => 'control-label']) !!}
        {!! Form::select('posts', [1 => __('Sim'), 0 => __('Não')], isset($page_type->posts)? $page_type->posts : null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        {!! Form::label('status', __('Status da página'), ['class' => 'control-label']) !!}
        {!! Form::select('status', ['1'=> __('Ativada'), '0' => __('Desativada')], isset($page_type->status)? $page_type->status : null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-9 col-xs-12 form-group">
        {!! Form::label('accounts', __('Contas do tipo de página'), ['class' => 'control-label']) !!}
        @foreach($accounts as $account)
        <div class="">
            <label>
                {!! Form::checkbox('accounts[]', $account->id, (isset($page_type->accounts))? $page_type->accounts->contains($account->id) : null, ["class" => "js-switch"]) !!}  {{ $account->identifier }}
            </label>
        </div>
        @endforeach
    </div>

    <div class="col-md-4 col-sm-9 col-xs-12 form-group">
        {!! Form::label('plans', __('Planos'), ['class' => 'control-label']) !!}
        @foreach($plans as $plan)
        <div class="">
            <label>
                {!! Form::checkbox('plans[]', $plan->id, (isset($page_type->plans))? $page_type->plans->contains($plan->id) : null, ["class" => "js-switch"]) !!}  {{ $plan->name }}
            </label>
        </div>
        @endforeach
    </div>

    <div class="col-md-4 col-sm-9 col-xs-12 form-group">
        {!! Form::label('plans', __('Templates'), ['class' => 'control-label']) !!}
        @foreach($templates as $template)
        <div class="">
            <label>
                {!! Form::checkbox('templates[]', $template->id, (isset($page_type->templates))? $page_type->templates->contains($template->id) : null, ["class" => "js-switch"]) !!}  {{ $template->title }}
            </label>
        </div>
        @endforeach
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-9 col-xs-12 form-group">
        {!! Form::label('sites', __('Sites'), ['class' => 'control-label']) !!}
        @foreach($sites as $site)
        <div class="">
            <label>
                {!! Form::checkbox('sites[]', $site->id, (isset($page_type->sites))? $page_type->sites->contains($site->id) : null, ["class" => "js-switch"]) !!}  {{ $site->title }}
            </label>
        </div>
        @endforeach
    </div>

    <div class="col-md-4 col-sm-9 col-xs-12 form-group" style="border: 1px solid #f0f0f0">
        <div class="col-md-8">
        {!! Form::label('options', __('Opções para página'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-2">{!! Form::label('options', __('Página'), ['class' => 'control-label']) !!}</div>
        <div class="col-md-2">{!! Form::label('options', __('Post'), ['class' => 'control-label']) !!}</div>
        @foreach($options as $k => $option)
        <div class="col-md-8">
            <label>
                {!! Form::checkbox('options[]', $option->id, (isset($page_type->options) && $page_type->options->contains($option->id))? $option->id : null, ["class" => "js-switch"]) !!}  {{ $option->label . ' (' . $option->type . ')' }}
            </label>
        </div>
        <div class="col-md-2">
            <label>
                {!! Form::checkbox('options_page[]', $option->id, (isset($page_type->options) && $page_type->options->contains($option->id) && $page_type->options()->wherePivot('option_id', $option->id)->wherePivot('page', 1)->exists())? $option->id : null, ["class" => "js-switch"]) !!}
            </label>
        </div>
        <div class="col-md-2">
            <label>
                {!! Form::checkbox('options_post[]', $option->id, (isset($page_type->options) && $page_type->options->contains($option->id) && $page_type->options()->wherePivot('option_id', $option->id)->wherePivot('post', 1)->exists())? $option->id : null, ["class" => "js-switch"]) !!}
            </label>
        </div>
        @endforeach
    </div>  
    
</div>

<div class="row">
    <div class="ln_solid"></div>
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 form-group">
        {!! Form::submit(__('Salvar'), ['class' => 'btn btn-success']) !!}
    </div>
</div>