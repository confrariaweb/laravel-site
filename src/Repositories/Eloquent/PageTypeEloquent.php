<?PHP
namespace Confrariaweb\Site\Repositories\Eloquent;

use Confrariaweb\Site\Repositories\Contracts\PageTypeContract;
use Confrariaweb\Site\Models\PageType;

class PageTypeEloquent implements PageTypeContract{

    public $pageType;

    function __construct(PageType $pageType) {
	$this->pageType = $pageType;
    }

    public function all()
    {
        return $this->pageType->all();
    }
    
    public function pluck($text, $id)
    {
        return $this->pageType->pluck($text, $id);
    }

    public function create(array $data) {
        $create = $this->pageType->create($data);
        $this->syncs($create, $data);
        return $create;
    }

    public function destroy($id) {
        return $this->pageType->destroy($id);
    }

    public function find($id) {
        return $this->pageType->find($id);
    }

    public function findBy($field, $value) {
        return $this->pageType->where($field, $value)->first();
    }

    public function paginate($perPageType = 15) {
        return $this->pageType->paginate($perPageType);
    }

    public function update(array $data, $id) {
        $update = $this->pageType->find($id);
        $update->update($data);
        $this->syncs($update, $data);
        return $update;
    }

    public function where(array $data) {
        return $this->pageType->where($data)->get();
    }
    
    private function syncs($obj, array $data) {
        $obj->accounts()->sync(isset($data['accounts'])? $data['accounts'] : []);
        $obj->plans()->sync(isset($data['plans'])? $data['plans'] : []);
        $obj->sites()->sync(isset($data['sites'])? $data['sites'] : []);
        $obj->options()->sync(isset($data['options'])? $data['options'] : []);
        $obj->templates()->sync(isset($data['templates'])? $data['templates'] : []);
    }

}