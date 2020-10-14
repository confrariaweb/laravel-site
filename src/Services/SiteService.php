<?PHP

namespace ConfrariaWeb\Site\Services;

use ConfrariaWeb\Option\Traits\OptionServiceTrait;
use ConfrariaWeb\Site\Contracts\SiteContract;
use ConfrariaWeb\Site\Models\Site;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;
use Illuminate\Support\Facades\Config;

class SiteService
{
    use OptionServiceTrait;
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
            $options = resolve('OptionService')->option_decode($options, $site);
        }
        return $options;
    }

    public function prepareData(array $data, $obj = NULL)
    {
        if ($obj && isset($data['user_id'])) {
            unset($data['user_id']);
        }

        $options = collect();
        if (isset($data['options'])) {
            $folder = isset($obj) ? 'sites/' . $obj->id : 'sites';
            $attributes = ['folder' => $folder];
            $options = resolve('OptionService')->option_encode($data['options'], $attributes);
        }
        $data['options'] = $options;
        return $data;
    }

}
