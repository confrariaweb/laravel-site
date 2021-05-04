<?php
namespace ConfrariaWeb\Site\Controllers\Frontend;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public $data;
    public $site;

    function __construct()
    {
        $this->data = [];
        $host = parse_url(url()->current())['host'];
        $this->site = resolve('SiteService')->findByDomain($host);
    }

    public function index()
    {
        $template = $this->site->template;
        $template_path = $template->path;
        $this->data = resolve($template->service)
            ->setTemplate($template)
            ->site('index');
        return view('template-storage::' . $template_path . '.index', $this->data);
    }

    public function page($page, $slug = NULL)
    {
        dd('2', $this->site);
        return view(cwView('home.index'), $this->data);
    }

}
