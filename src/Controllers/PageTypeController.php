<?php

namespace Confrariaweb\Site\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Entrust;

class PageTypeController extends Controller
{
    
    public $data = null;
    
    function __construct() {
        $this->data['options'] = resolve('OptionService')->all();
        $this->data['accounts'] = resolve('AccountService')->all();
        $this->data['sites'] = resolve('SiteService')->all();
        $this->data['plans'] = resolve('PlanService')->all();
        $this->data['templates'] = resolve('TemplateService')->all();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Entrust::can('site-page-type-index'), 403);
        $this->data['page_types'] = resolve('SitePageTypeService')->all();
        return view('pageType::index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('page-type-create');
        return view('dashboard.gentelella.page-types.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('page-type-create');
        $data = $request->all();
        $id = resolve('PageTypeService')->create($data)->id;
        return redirect()->route('admin.page-types.edit', $id)
                ->with('status', __('Tipo de página criada com sucesso'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('page-type-show');
        $this->data['page_type'] = resolve('PageTypeService')->find($id);
        abort_unless($this->data['page_type'], 404);
        return view('dashboard.gentelella.page-types.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('page-type-edit');
        $this->data['page_type'] = resolve('PageTypeService')->find($id);
        //dd($this->data['page_type']->options);
        abort_unless($this->data['page_type'], 404);
        return view('dashboard.gentelella.page-types.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('page-type-edit');
        $data = $request->all();
        resolve('PageTypeService')->update($data, $id);
        return redirect()->route('admin.page-types.edit', $id)
                ->with('status', __('Tipo de página editada com sucesso'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('page-type-destroy');
        resolve('PageTypeService')->destroy($id);
        return redirect()->route('admin.page-types.index')
                ->with('status', __('Tipo de página deletado com sucesso'));
    }
    
}
