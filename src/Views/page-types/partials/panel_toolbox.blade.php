<ul class="nav navbar-right panel_toolbox">
    <li>
        <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="fa fa-wrench"></i>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="{{ route('admin.page-types.index') }}" class="btn btn-sm btn-outline-secondary {{ (\Request::route()->getName() == 'admin.page-types.index') ? 'active' : '' }}">
                    {{ __('Lista de tipos de páginas') }}
                </a>
            </li>                  
            <li>
                <a href="{{ route('admin.page-types.create') }}" class="btn btn-sm btn-outline-secondary {{ (\Request::route()->getName() == 'admin.page-types.create') ? 'active' : '' }}">
                    {{ __('Novo tipo página') }}
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a class="close-link">
            <i class="fa fa-close"></i>
        </a>
    </li>
</ul>