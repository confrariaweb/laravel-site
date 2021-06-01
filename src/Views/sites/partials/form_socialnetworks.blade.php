<div class="card mt-3">
  <div class="card-header">
    Redes sociais
  </div>
  <div class="card-body">
      
  <div id="inputs-social-networks">
    @foreach($site->options['socialnetworks'] as $socialnetwork)
        @include('site::sites.partials.form_socialnetworks_input', ['key' => $loop->index])
    @endforeach
</div>
<div class="row">
    <div class="col-12">
        <button type="button" class="btn btn-primary" id="socialnetwork">add rede social</button>
    </div>
</div>

  </div>
</div>

@push('scripts')
    <script>
        $(document).on("click","#socialnetwork",function() {
            console.log("click bound to document listening for #test-element");
            var element = $('.input-social-network:first').clone();
            element.find('select').attr('name', 'options[socialnetworks][' + $('.input-social-network').length + '][key]');
            element.find('input').attr('name', 'options[socialnetworks][' + $('.input-social-network').length + '][value]');
            $("#inputs-social-networks").append(element);
        });
    </script>
@endpush