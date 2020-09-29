<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
  <ul class="dropdown-menu" role="menu">
      <li><a href="{{ route('admin.templates.index') }}" class="btn btn-sm btn-outline-secondary {{ (\Request::route()->getName() == 'admin.templates.index') ? 'active' : '' }}">{{ __('Lista de templates') }}</a></li>                  
    <li><a href="{{ route('admin.templates.create') }}" class="btn btn-sm btn-outline-secondary {{ (\Request::route()->getName() == 'admin.templates.create') ? 'active' : '' }}">{{ __('Nova template') }}</a></li>
  </ul>
</li>
<li><a class="close-link"><i class="fa fa-close"></i></a>
</li>
</ul>