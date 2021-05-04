<div class="card mt-3">
  <div class="card-header">
    MetaTags
  </div>
  <div class="card-body">
      
  <div class="row">
    <div class="col-9">
        <div class="form-group">
            <label class="control-label">{{ __('title') }} </label>
            {!! Form::text('options[metatags][title]', null, ['class' => 'form-control', 'placeholder' => 'Titulo']) !!}
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label class="control-label">{{ __('robots') }} <span class="required"> * </span></label>
            {!! Form::select('options[metatags][robots]', $metatags['robots'], null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <div class="form-group">
            <label class="control-label">{{ __('keywords') }} </label>
            {!! Form::textarea('options[metatags][keywords]', null, ['class' => 'form-control', 'placeholder' => __('keywords')]) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <div class="form-group">
            <label class="control-label">{{ __('description') }} </label>
            {!! Form::textarea('options[metatags][description]', null, ['class' => 'form-control', 'placeholder' => __('description')]) !!}
        </div>
    </div>
</div>
  </div></div>