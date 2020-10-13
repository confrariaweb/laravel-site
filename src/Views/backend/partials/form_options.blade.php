@foreach($options as $name => $option)
    <div class="form-group">
        <label class="control-label">{{ $option['label']?? '' }} </label>
        <x-option
                class="teste"
                type="{{ $option['type']?? 'text' }}"
                name="{{ $name }}"
                placeholder="{{ $option['placeholder']?? '' }}"
                value="{{ $option['value']?? '' }}"
        ></x-option>
    </div>
@endforeach