<?PHP

namespace Confrariaweb\Site\Repositories\Eloquent;

use Confrariaweb\Site\Repositories\Contracts\PageContract;
use Confrariaweb\Site\Models\Page;

class PageEloquent implements PageContract
{

    public $page;

    function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function all()
    {
        return $this->page->all();
    }

    public function pluck($text, $id)
    {
        return $this->page->pluck($text, $id);
    }

    public function create(array $data)
    {
        $create = $this->page->create($data);
        $this->syncs($create, $data);
        return $create;
    }

    public function destroy($id)
    {
        return $this->page->destroy($id);
    }

    public function find($id)
    {
        return $this->page->find($id);
    }

    public function findBy($field, $value)
    {
        return $this->page->where($field, $value)->first();
    }

    public function paginate($perPage = 15)
    {
        return $this->page->paginate($perPage);
    }

    public function update(array $data, $id)
    {
        $update = $this->page->find($id);
        $update->update($data);
        $this->syncs($update, $data);
        return $update;
    }

    public function where(array $data)
    {
        $this->page->where($data)->get();
    }

    private function syncs($obj, array $data)
    {
        $obj->sites()->sync(isset($data['sites']) ? $data['sites'] : []);
    }

}
