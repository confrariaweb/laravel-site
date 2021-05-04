<?php

namespace ConfrariaWeb\Site\Controllers\Backend;

use ConfrariaWeb\Site\Requests\StoreSiteRequest;
use ConfrariaWeb\Site\Requests\UpdateSiteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\DataTables;

class SiteController extends Controller
{

    protected $data = [];

    function __construct()
    {
        $this->data['page'] = 'general';
        $this->data['templates'] = resolve('TemplateService')->pluck('title');
        $this->data['domains'] = resolve('DomainService')->pluck('domain');
        $this->data['metatags']['robots'] = [
            'index' => '(index) Indexe esta página - exiba-a em seus resultados de busca',
            'noindex' => '(noindex) Não indexe esta página - não a exiba nos resultados de busca. Útil para páginas como de login e acesso à intranet',
            'follow' => '(follow) Siga os links desta pagina para descobrir novas páginas (reveja Googlebot, robots)',
            'nofollow' => '(nofollow) Nenhum dos links desta página deve ser seguido',
            'nosnippet' => '(nosnippet) Orienta o site de busca a não exibir a descrição da página nos resultados de busca',
            'noodp' => '(noodp) Orienta o Google não utilizar a descrição do diretório DMOZ em seus resultados (snippet)',
            'noarchive' => '(noarchive) Instrui o Google a não exibir a versão em cache da página',
            'noimageindex' => '(noimageindex) Não indexe nehuma imagem da página'
        ];
        $this->data['socialnetworks'] = [
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'twitter' => 'Twitter',
            'linkedin' => 'Linkedin',
            'youtube' => 'Youtube',
            'pinterest' => 'Pinterest',
        ];
    }

    public function datatables()
    {
        $sites = resolve('SiteService')->all();
        return DataTables::of($sites)
            ->addColumn('template', function ($site) {
                return !$site->template ? NULL : $site->template->title;
            })
            ->addColumn('domains', function ($site) {
                return $site->domains->count() > 0 ? $site->domains->implode('domain', '<br>') : __('without domain');
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
        return view(config('cw_site.views', 'site::') . 'sites.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('cw_site.views', 'site::') . 'sites.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiteRequest $request)
    {
        $site = resolve('SiteService')->create($request->all());

        if($site->get('error')){
            return back()
                ->with('status', $site->get('status'))
                ->withInput();
        }
        $id = $site->get('obj')->id;
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
    public function edit($id, $page = 'general')
    {
        $this->data['page'] = $page;
        $this->data['site'] = resolve('SiteService')->find($id);
        return view(config('cw_site.views', 'site::') . 'sites.edit', $this->data);
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
        //dd($request->all());
        $site = resolve('SiteService')->update($request->all(), $id);
        if($site->get('error')){
            return back()
                ->with('status', $site->get('status'))
                ->withInput();
        }
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
