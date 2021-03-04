<?PHP

namespace ConfrariaWeb\Site\Repositories;

use ConfrariaWeb\Site\Contracts\SiteContract;
use ConfrariaWeb\Site\Models\Site;
use ConfrariaWeb\Vendor\Traits\RepositoryTrait;
use Illuminate\Database\Eloquent\Builder;

class SiteRepository implements SiteContract
{
    use RepositoryTrait;

    public $site;

    function __construct(Site $site)
    {
        $this->obj = $site;
    }

    protected function sync($obj, $data)
    {
        if (isset($data['domains'])) {
            $obj->domains()->sync($data['domains']);
        }
    }

    public function findByDomain($host)
    {
        return $this->obj->whereHas('domains', function (Builder $query) use ($host) {
            $query->where('domain', $host);
        })->first();
    }
}