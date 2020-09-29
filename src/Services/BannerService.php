<?PHP

namespace Confrariaweb\Site\Services;

use Confrariaweb\Site\Repositories\Contracts\BannerContract;
use Validator;
use function GuzzleHttp\json_encode;

class BannerService {

    protected $banner;
    protected $site;

    public function __construct(BannerContract $banner) {
        $this->banner = $banner;
        $this->site = resolve('SiteService')->findThis();
    }

    function all() {
        return $this->banner->all();
    }

    function destroy($id) {
        return $this->banner->destroy($id);
    }

    function find($id) {
        return $this->banner->find($id);
    }

    function findBanner($banner) {
        return $this->banner->findBanner($banner);
    }

    function create($data, $errorsRedirect = true, $create = null){
        $validator = Validator::make($data, [
            'files' => 'required'
        ]);
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            $data['site_id'] = $this->site->id;
            $options = json_encode([]);
            $data['options'] = resolve('OptionService')->optionEnconde($options, $data);
            $data['path'] = 'banners';
            $file = resolve('FileService')->updateOrCreate($data, false);
            if(!$file['error']){
                $data['file'] = $file['content'][0]->toJson();
                $create = $this->banner->store($data);
            }
        }
        return $create;
    }

    function update($data, $id, $errorsRedirect = true, $update = null){
        $validator = Validator::make($data, [
            'files' => 'required'
        ]);
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            $data['site_id'] = $this->site->id;
            $options = json_encode([]);
            $data['options'] = resolve('OptionService')->optionEnconde($options, $data);
            if(isset($data['files'][0]) && !empty($data['files'][0])){
                $data['path'] = 'banners';
                $file = resolve('FileService')->updateOrCreate($data, false);
                if(!$file['error']){
                    $data['file'] = $file['content'][0]->toJson();
                }
            }
            $update = $this->banner->update($data, $id);
        }
        return $update;
    }

}
