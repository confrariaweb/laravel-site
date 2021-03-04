<?php

namespace ConfrariaWeb\Site\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\DataTables;

class SiteMenuController extends Controller
{

    protected $data = [];

    function __construct()
    {

    }

    public function datatables()
    {
        $menus = resolve('SiteMenuService')->all();
        return DataTables::of($menus)
            ->addColumn('action', function ($menu) {
                return '<div class="btn-group btn-group-sm float-right" role="group">
                    <a href="' . route('dashboard.sites.menus.show', $menu->id) . '" class="btn btn-info">
                        <i class="glyphicon glyphicon-eye"></i> Ver
                    </a>
                    <a href="' . route('dashboard.sites.menus.edit', $menu->id) . '" class="btn btn-primary">
                        <i class="glyphicon glyphicon-edit"></i> Editar
                    </a>
                    <a class="btn btn-danger" href="' . route('dashboard.sites.destroy', $menu->id) . '" onclick="event.preventDefault();
                        document.getElementById(\'sites-menus-destroy-form-' . $menu->id . '\').submit();">
                        Deletar
                    </a>
                    <form id="sites-menus-destroy-form-' . $menu->id . '" action="' . route('dashboard.sites.menus.destroy', $menu->id) . '" method="POST" style="display: none;">
                        <input name="_method" type="hidden" value="DELETE">    
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <input type="hidden" name="id" value="' . $menu->id . '">
                    </form>
                </div>';
            })
            //->rawColumns(['action', 'domains'])
            ->make();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['menus'] = resolve('SiteMenuService')->all();
        return view(cwView('sites.menus.index', true), $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['routes'] = Artisan::call('route:list', ['--path' => 'web']);
        return view(cwView('sites.menus.create', true), $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = resolve('SiteMenuService')->create($request->all())->id;
        return redirect()->route('dashboard.sites.menus.edit', $id)
            ->with('status', __('Menu do site criado com sucesso!'));
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
        $this->data['routes'] = Artisan::call('route:list', ['--path' => 'web']);
        $this->data['menu'] = resolve('SiteMenuService')->find($id);
        return view(cwView('sites.menu.edit', true), $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        resolve('SiteMenuService')->update($request->all(), $id);
        return redirect()->route('dashboard.sites.menus.edit', $id)
            ->with('status', __('Menu do site editado com sucesso!'));
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
