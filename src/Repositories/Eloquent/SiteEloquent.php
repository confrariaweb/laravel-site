<?PHP

namespace Confrariaweb\Site\Repositories\Eloquent;

use Confrariaweb\Site\Repositories\Contracts\SiteContract;
use Confrariaweb\Site\Models\Site;
use Illuminate\Support\Facades\Cache;

class SiteEloquent implements SiteContract
{

    public $site;

    function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function all($columns = '*')
    {
        return $this->site->all($columns);
    }

    public function destroy($id)
    {
        return $this->site->destroy($id);
    }

    public function find($id)
    {
        return $this->site->find($id);
    }

    public function findThis()
    {
        $site = domain_site();
        return Cache::remember(site_url('site_find_this'), 720, function () use ($site) {
            return $this->site->find($site->id);
        });
    }

    public function findDomain($domain)
    {
        return Cache::remember(site_url('site_find_domain'), 720, function () use ($domain) {
            return $this->site->whereHas('domains', function ($query) use ($domain) {
                $query->where('domain', $domain);
            })->with('template')->first();
        });
    }

    public function create($request)
    {
        return $this->site->create($request);
    }

    public function update($request, $id)
    {
        $update = $this->site->find($id);
        $update->update($request);
        return $update;
    }

    public function delete($id)
    {

    }

    public function findBy($field, $value)
    {

    }

    public function paginate($perPage = 15)
    {

    }

    public function pluck($text, $id)
    {

    }

    public function where($data)
    {
        return $this->site->where($data)->get();
    }

}