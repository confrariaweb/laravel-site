<?PHP

namespace ConfrariaWeb\Site\Repositories;

use ConfrariaWeb\Site\Contracts\SiteContract;
use ConfrariaWeb\Site\Models\Site;
use ConfrariaWeb\Vendor\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;

class SiteRepository extends Repository implements SiteContract
{

    public function __construct(Site $site)
    {
        parent::__construct($site);
    }

    public function sync($obj, $data)
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