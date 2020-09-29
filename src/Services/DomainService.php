<?PHP

namespace Confrariaweb\Site\Services;

use Confrariaweb\Site\Repositories\Contracts\DomainContract;
use Validator;

class DomainService {

    private $domain;

    public function __construct(DomainContract $domain) {
        $this->domain = $domain;
    }

    function all() {
        return $this->domain->all();
    }

    function find($id) {
        return $this->domain->find($id);
    }

    function findDomain($domain) {
        return $this->domain->findDomain($domain);
    }

    function create($data, $errorsRedirect = true, $create = null){
        $validator = Validator::make($data, [
                    'domain' => 'required|unique:site_domains,domain|max:255',
                    'site_id' => 'required'
        ]);
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            if (!filter_var('http://' . $data['domain'], FILTER_VALIDATE_URL)) {
                return false;
            }
            $create = $this->domain->store($data);
        }
        return $create;
    }

    function update($data, $id, $errorsRedirect = true, $update = null){
        $validator = Validator::make($data, [
                    'domain' => 'required|unique:site_domains,domain,'.$id.'|max:255',
        ]);
        if (filter_var($data['domain'], FILTER_VALIDATE_URL) === false) {
            return false;
        }
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            $update = $this->domain->update($data, $id);
        }
        return $update;
    }

}
