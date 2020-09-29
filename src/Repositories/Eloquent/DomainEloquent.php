<?PHP

namespace Confrariaweb\Site\Repositories\Eloquent;

use Confrariaweb\Site\Repositories\Contracts\DomainContract;
use Confrariaweb\Site\Models\Domain;

class DomainEloquent implements DomainContract
{

    public $domain;

    function __construct(Domain $domain)
    {
        $this->domain = $domain;
    }

    public function all()
    {
        return $this->domain->all();
    }

    public function destroy($id)
    {
        return $this->domain->destroy($id);
    }

    public function find($id)
    {
        return $this->domain->find($id);
    }

    public function findDomain($domain)
    {
        return $this->domain->where('domain', $domain)->first();
    }

    public function findSite($siteID)
    {

    }

    public function store($request)
    {
        return $this->domain->create($request);
    }

    public function update($request, $id)
    {
        $update = $this->domain->find($id);
        return $update->update($request);
    }

}