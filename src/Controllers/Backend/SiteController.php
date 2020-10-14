<?php

namespace ConfrariaWeb\Site\Controllers\Backend;

use ConfrariaWeb\Site\Requests\StoreSiteRequest;
use ConfrariaWeb\Site\Requests\UpdateSiteRequest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class SiteController extends Controller
{

    protected $data = [];

    function __construct()
    {
        $this->data['templates'] = resolve('TemplateService')->pluck('title');
        $this->data['domains'] = resolve('DomainService')->pluck('domain');
    }

    public function datatables()
    {
        $sites = resolve('SiteService')->all();
        return DataTables::of($sites)
            ->addColumn('template', function ($site) {
                return !$site->template ? NULL : $site->template->title;
            })
            ->addColumn('domains', function ($site) {
                return !$site->domains ? NULL : $site->domains->implode('domain', '<br>');
            })
            ->addColumn('action', function ($site) {
                return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('dashboard.sites.show', $site->id) . '" class="btn btn-info">
                        <i class="glyphicon glyphicon-eye"></i> Ver
                    </a>
                    <a href="' . route('dashboard.sites.edit', $site->id) . '" class="btn btn-primary">
                        <i class="glyphicon glyphicon-edit"></i> Editar
                    </a>
                    <a class="btn btn-danger" href="' . route('dashboard.sites.destroy', $site->id) . '" onclick="event.preventDefault();
                        document.getElementById(\'sites-destroy-form-' . $site->id . '\').submit();">
                        Deletar
                    </a>
                    <form id="sites-destroy-form-' . $site->id . '" action="' . route('dashboard.sites.destroy', $site->id) . '" method="POST" style="display: none;">
                        <input name="_method" type="hidden" value="DELETE">    
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <input type="hidden" name="id" value="' . $site->id . '">
                    </form>
                </div>';
            })
            ->rawColumns(['action', 'domains'])
            ->make();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['sites'] = resolve('SiteService')->all();
        return view(cwView('sites.index', true), $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(cwView('sites.create', true), $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiteRequest $request)
    {
        $id = resolve('SiteService')->create($request->all())->id;
        return redirect()->route('dashboard.sites.edit', $id)
            ->with('status', __('Site criado com sucesso!'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['site'] = $site = resolve('SiteService')->find($id);
        $this->data['options'] = resolve('SiteService')->getOptions($site);
        return view(cwView('sites.edit', true), $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiteRequest $request, $id)
    {
        resolve('SiteService')->update($request->all(), $id);
        return redirect()->route('dashboard.sites.edit', $id)
            ->with('status', __('Site editado com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}
