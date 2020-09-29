<?php

namespace Confrariaweb\Site\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Entrust;

class SiteController extends Controller
{

    protected $data = null;
    protected $template = null;

    function __construct()
    {
        $this->data['templates'] = resolve('TemplateService')->pluck('title', 'id', ['template_type_id' => 1]);
        $this->template = config('cw_dashboard.template') . '.sites.sites';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Entrust::can('site-index'), 403);
        $this->data['sites'] = resolve('SiteService')->all();
        return view($this->template . '.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Entrust::can('site-create'), 403);
        return view('site::create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Entrust::can('site-create'), 403);
        $id = resolve('SiteService')->create($request->all())->id;
        return redirect()->route('admin.sites.edit', $id)
            ->with('status', __('Site criado com sucesso!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_unless(Entrust::can('site-show'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Entrust::can('site-edit'), 403);
        $this->data['site'] = resolve('SiteService')->find($id);
        $config_template = 'cw_' . str_replace(['-laravel', '-'], ['', '_'], $this->data['site']->template->package);
        $this->data['config_template'] = (object) config($config_template);
        return view($this->template . '.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_unless(Entrust::can('site-edit'), 403);
        resolve('SiteService')->update($request->all(), $id);
        return redirect()->route('admin.sites.edit', $id)
            ->with('status', __('Site editado com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Entrust::can('site-destroy'), 403);
    }

}
