<?php

namespace Confrariaweb\Site\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App;

class SiteController extends Controller
{

    public $template = null;
    public $data = null;
    public $site = null;

    function __construct()
    {
        if(!App::runningInConsole()) {
            $host = parse_url(url()->current())['host'];
            $this->site = resolve('SiteService')->findByDomain($host);
            if (!$this->site->template) {
                abort(404);
            }
        }
        $this->data['plans'] = resolve('PlanService')->all();
        $this->data['properties'] = resolve('PropertyService')->all();
        //dd($this->data['properties']->take(10));
        $this->data['types_pluck'] = resolve('PropertyTypeService')->pluck();
        $this->data['finalities_pluck'] = resolve('PropertyFinalityService')->pluck();
        $this->data['finalities'] = resolve('PropertyFinalityService')->all();
        $this->data['site'] = $this->site;
        //$this->data['template'] = json_decode($this->data['site']->templates->first()->pivot->configuration);
    }

    public function home()
    {
        //dd(Auth::user());
        return view('templates.' . $this->site->template['path'] . '.home.index', $this->data);
    }

    public function propertyIndex(Request $request)
    {
        $filter = $request->only('take', 'order', 'by');
        $data = $request->all();
        $this->data['properties'] = resolve('PropertyService')->where($data, $filter);
        return view('templates.' . $this->site->template['path'] . '.properties.index', $this->data);
    }

    public function propertyShow($slug)
    {
        $this->data['property'] = resolve('PropertyService')->findBy('slug', $slug);
        $this->data['images'] = property($this->data['property'], ['model' => 'images', 'default' => []]);
        return view('templates.' . $this->site->template['path'] . '.properties.show', $this->data);
    }

    public function pageIndex()
    {
        return view('templates.' . $this->site->template['path'] . 'pages.index', $this->data);
    }

    public function pageShow($slug)
    {
        $this->data['page'] = resolve('PageService')->findBy('slug', $slug);
        $view = $this->data['page']->type->slug;
        return view('templates.' . $this->site->template['path'] . '.pages.' . $view, $this->data);
    }

    public function postIndex()
    {
        return view('templates.' . $this->site->template['path'] . 'posts.index', $this->data);
    }

    public function postShow()
    {
        return view('templates.' . $this->site->template['path'] . 'posts.show', $this->data);
    }

}
