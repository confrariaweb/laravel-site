<?PHP

namespace ConfrariaWeb\Site\Services;

use ConfrariaWeb\Site\Contracts\SiteContract;
use ConfrariaWeb\Site\Models\Site;
use ConfrariaWeb\Vendor\Services\Service;
use Illuminate\Support\Facades\Config;

class SiteService extends Service
{

    public function __construct(SiteContract $site)
    {
        parent::__construct($site);
    }

    public function findByDomain($host)
    {
        return $this->obj->findByDomain($host);
    }

}
