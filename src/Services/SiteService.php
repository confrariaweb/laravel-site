<?PHP

namespace ConfrariaWeb\Site\Services;

use ConfrariaWeb\Option\Traits\OptionServiceTrait;
use ConfrariaWeb\Site\Contracts\SiteContract;
use ConfrariaWeb\Site\Models\Site;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;
use Illuminate\Support\Facades\Config;

class SiteService
{
    use ServiceTrait;

    private $site;

    public function __construct(SiteContract $site)
    {
        $this->obj = $site;
    }

    public function findByDomain($host)
    {
        return $this->obj->findByDomain($host);
    }

    public function getOptions(Site $site = NULL, $options = [])
    {
        $options = collect(Config::get('cw_site.options', []));
        if ($site) {

        }
        return $options;
    }

    public function executeAfter(array $data, $obj = NULL)
    {
        if (isset($data['files'])) {
            $path = (existsAccount()) ? 'accounts/' . account()->id . '/sites/' . $obj->id : 'sites/' . $obj->id;
            resolve('FileService')->uploadAttach($obj, $data['files'], $path);
        }
    }

    public function prepareData(array $data, $obj = NULL)
    {
        if ($obj && isset($data['user_id'])) {
            unset($data['user_id']);
        }

        $data['options'] = resolve('OptionService')->encode($data['options'] ?? []);

        return $data;
    }

}
