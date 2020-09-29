<?php

namespace Confrariaweb\Site\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{

    protected $data = null;
    protected $template = null;

    function __construct()
    {
        $this->data['site'] = resolve('SiteService')->findThis();
        $config_template = 'cw_' . str_replace(['-laravel', '-'], ['', '_'], $this->data['site']->template->package);
        $this->data['config_template'] = (object) config($config_template);
        $this->template = config('cw_dashboard.template') . '.sites.banners';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banners'] = resolve('BannerService')->all();
        return view($this->template . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['banner'] = null;
        return view($this->template . '.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $id = resolve('BannerService')->create($data)->id;
        return redirect()->route('admin.sites.banners.edit', $id)
            ->with('status', trans('Banner criado copm sucesso'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['banner'] = resolve('BannerService')->find($id);
        return view($this->template . '.edit', $this->data);
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
        $data = $request->all();
        resolve('BannerService')->update($data, $id);
        return redirect()->route('admin.sites.banners.edit', $id)
            ->with('status', trans('Banner editado copm sucesso'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        resolve('BannerService')->destroy($id);
        return redirect()->route('admin.sites.banners.index')
            ->with('status', trans('Banner deletado com sucesso'));
    }
}
