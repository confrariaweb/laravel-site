<?php
namespace ConfrariaWeb\Site\Controllers\Frontend;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    private $data;
    private $site;

    function __construct()
    {
        $this->data = [];
        $host = parse_url(url()->current())['host'];
        $this->site = resolve('SiteService')->findByDomain($host);
    }

    public function home()
    {
        if (isset($this->site->template->service)) {
            $this->data = resolve($this->site->template->service)->home();
        }
        return view(cwView('home.home'), $this->data);
    }

}
