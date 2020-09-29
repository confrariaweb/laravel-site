<?php

namespace Confrariaweb\Site\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Entrust;

class PageController extends Controller
{
    
    public $data = null;
    
    function __construct() {
        $this->data['page_types'] = resolve('SitePageTypeService')->all();
        $this->data['types'] = resolve('SitePageTypeService')->pluck();
        $this->data['sites'] = resolve('SiteService')->all();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slugPageType = null)
    {
        abort_unless(Entrust::can('site-page-index'), 403);
        $this->data['page_type'] = $this->findPageType($slugPageType);
        $this->data['pages'] = resolve('SitePageTypeService')->findBy('slug', $slugPageType)->pages;
        return view('dashboard.gentelella.pages.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slugPageType = null)
    {
        $this->authorize('page-create');
        $this->data['page_type'] = $this->findPageType($slugPageType);
        return view('dashboard.gentelella.pages.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('page-create');
        $data = $request->all();
        $pageType = resolve('PageTypeService')->find($data['page_type_id']);
        $id = resolve('PageService')->create($data)->id;
        return redirect()->route('admin.pages.edit.pagetype', ['id' => $id, 'slugPageType' => $pageType->slug])
                ->with('status', __('Pagina criada com sucesso'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slugPageType = null)
    {
        $this->authorize('page-show');
        $this->data['page_type'] = $this->findPageType($slugPageType);
        $this->data['page'] = resolve('PageService')->find($id);
        return view('dashboard.gentelella.pages.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $slugPageType = null)
    {
        $this->authorize('page-edit');
        $this->data['page_type'] = $this->findPageType($slugPageType);
        $this->data['page'] = resolve('PageTypeService')->findBy('slug', $slugPageType)->pages()->where('id', $id)->first();
        abort_unless($this->data['page'], 404);
        return view('dashboard.gentelella.pages.edit', $this->data);
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
        $this->authorize('page-edit');
        $data = $request->all();
        $pageType = resolve('PageTypeService')->find($data['page_type_id']);
        resolve('PageService')->update($data, $id);
        return redirect()->route('admin.pages.edit.pagetype', ['id' => $id, 'slugPageType' => $pageType->slug])
                ->with('status', __('Pagina editada com sucesso'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('page-destroy');
        $page = resolve('PageService')->find($id);
        resolve('PageService')->destroy($id);
        return redirect()->route('admin.pages.index.pagetype', ['slugPageType' => $page->type->slug])
                ->with('status', __('Pagina deletado com sucesso'));
    }
    
    private function findPageType($slugPageType, $pageType = null)
    {
        if($slugPageType){
            $pageType = resolve('PageTypeService')->findBy('slug', $slugPageType);
        }
        return $pageType;
    }
}
