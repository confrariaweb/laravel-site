<?PHP

namespace Confrariaweb\Site\Services;

use Confrariaweb\Site\Repositories\Contracts\PageTypeContract;
use Validator;

class PageTypeService
{
    private $pageType;

    public function __construct(PageTypeContract $pageType)
    {
        $this->pageType = $pageType;
    }

    function all(){
        return $this->pageType->all();
    }
    
    function find($id){
        return $this->pageType->find($id);
    }
    
    function findBy($field, $value){
        return $this->pageType->findBy($field, $value);
    }
    
    function where($data){
        return $this->pageType->where($data);
    }
    
    function pluck(){
        return $this->pageType->pluck('title', 'id')->map(function ($t) {
            return __(sprintf('%s', $t));
        })->toArray();
    }
    
    function create($data, $errorsRedirect = true, $create = null){
        
        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'slug' => 'required|unique:page_types,slug|max:255'
        ]);
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            $data['options'] = $this->options($data);
            $create = $this->pageType->create($data);
        }
        return $create;
    }
    
    function update($data, $id, $errorsRedirect = true, $update = null){
        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'slug' => 'required|unique:page_types,slug,'.$id.'|max:255',
            'status' => 'required',
        ]);
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            $data['options'] = $this->options($data);
            $update = $this->pageType->update($data, $id);
        }
        return $update;
    }
    
    function destroy($id){
        return $this->pageType->destroy($id);
    }
    
    private function options($data){
        $options = [];
        //dd($data['options']);
        if(isset($data['options'])){
            $options = $data['options'];
            foreach ($data['options'] as $o){
                if(
                    (isset($data['options_page']) && in_array($o, $data['options_page'])) ||
                    (isset($data['options_post']) && in_array($o, $data['options_post']))
                ){
                $options[$o] = [
                    'page' => (in_array($o, $data['options_page']))? 1 : 0,
                    'post' => (in_array($o, $data['options_post']))? 1 : 0
                    ];
                }
            }
        }
        return $options;
    }
        
}