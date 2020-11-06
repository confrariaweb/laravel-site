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
        abort_unless($this->site, 404);
        abort_unless($this->site->template, 404);
        return view(cwView('home.index'), $this->data);
    }

}
