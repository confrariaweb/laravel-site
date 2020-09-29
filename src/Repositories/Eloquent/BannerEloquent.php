<?PHP

namespace Confrariaweb\Site\Repositories\Eloquent;

use Confrariaweb\Site\Repositories\Contracts\BannerContract;
use Confrariaweb\Site\Models\Banner;

class BannerEloquent implements BannerContract
{

    public $banner;

    function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    public function create($data){
        return null;
    }

    public function findBy($field, $value){
        return null;
    }

    public function where($data){
        return null;
    }

    public function all()
    {
        return $this->banner->all();
    }

    public function destroy($id)
    {
        return $this->banner->destroy($id);
    }

    public function find($id)
    {
        return $this->banner->find($id);
    }

    public function store($request)
    {
        return $this->banner->create($request);
    }

    public function update($request, $id)
    {
        $update = $this->banner->find($id);
        return $update->update($request);
    }

    public function updateOrCreate($data){
        return null;
    }

}