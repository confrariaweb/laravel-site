<?PHP

namespace Confrariaweb\Site\Services;

use Confrariaweb\Site\Repositories\Contracts\SiteContract;
use Validator;
use Auth;

class SiteService
{

    private $site;

    public function __construct(SiteContract $site)
    {
        $this->site = $site;
    }

    function all($columns = '*')
    {
        return $this->site->all($columns);
    }

    function where($data)
    {
        return $this->site->where($data);
    }

    function find($id)
    {
        $data = $this->site->find($id);
        return $data;
    }

    function findByDomain($domain)
    {
        $data = $this->site->findDomain($domain);
        return $data;
    }

    function findThis()
    {
        $data = $this->site->findThis();
        return $data;
    }

    function create($data)
    {
        Validator::make($data, [
            'title' => 'required|max:255',
        ]);
        $account = domain_account();
        $data['account_id'] = isset($data['account_id']) ? $data['account_id'] : $account->id;
        $data['user_id'] = isset($data['user_id']) ? $data['user_id'] : Auth::user()->id;
        //$data['options'] = resolve('OptionService')->optionEnconde(isset($data['options'])? $data['options'] : []);
        $site = $this->site->create($data);
        if (isset($data['domain'])) {
            $this->domainAdd($data['domain'], $site->id);
        }
        if (isset($data['domains']) && is_array($data['domains'])) {
            $this->domainAdd($data['domains'], $site->id);
        }
        return $site;
    }

    function update($data, $id)
    {
        Validator::make($data, [
            'name' => 'required|max:255',
        ]);
        $data['sites'][] = $id;
        $data['path'] = 'sites/' . $id . '/images';
        $optionJson = $this->site->find($id)->options;
        $data['options'] = resolve('OptionService')->optionEnconde($optionJson, $data);
        $site = $this->site->update($data, $id);



        if (isset($data['domain'])) {
            $this->domainAdd($data['domain'], $site->id);
        }
        if (isset($data['domains']) && is_array($data['domains'])) {
            $this->domainAdd($data['domains'], $site->id);
        }
        return $site;
    }

    private function options($site_id, $options, $r = null)
    {
        if(isset($options['file'])) {
            $data['path'] = 'sites/' . $site_id . '/images';
            $FileService = resolve('FileService')->updateOrCreate($data, false);
        }

    }

    private function domainAdd($domains, $site_id, $r = null)
    {
        if (isset($domains)) {
            $data['site_id'] = $site_id;
            $domains = (!is_array($domains)) ? explode(',', $domains) : $domains;
            foreach ($domains as $d) {
                $data['domain'] = $d;
                $r[] = resolve('DomainService')->create($data, false);
            }
        }
        return $r;
    }

}
