<?PHP

namespace Confrariaweb\Site\Services;

use Confrariaweb\Site\Repositories\Contracts\PageContract;
use Validator;
use Illuminate\Support\Facades\Auth;

class PageService
{
    private $page;
    private $account;
    private $site;

    public function __construct(PageContract $page)
    {
        $this->account = domain_account();
        $this->site = domain_site();
        $this->page = $page;
    }

    function all(){
        return $this->page->all();
    }
    
    function find($id){
        return $this->page->find($id);
    }
    
    function findBy($field, $value){
        return $this->page->findBy($field, $value);
    }
    
    function where(array $data){
        return $this->page->where($data);
    }
    
    function pluck(){
        return $this->page->pluck('name', 'id')->map(function ($t) {
            return trans(sprintf('%s', $t));
        })->toArray();
    }
    
    function create($data, $errorsRedirect = true, $create = null){
        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'slug' => 'required|unique:pages,slug|max:255',
            'content' => 'required',
            'status' => 'required',
            'page_type_id' => 'required',
        ]);
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            $data['account_id'] = isset($data['account_id'])? $data['account_id'] : $this->account->id;
            $data['site_id'] = isset($data['site_id'])? $data['site_id'] : $this->site->id;
            $data['template_id'] = isset($data['template_id'])? $data['template_id'] : $this->site->template_id;
            $data['user_id'] = isset($data['user_id'])? $data['user_id'] : Auth::id();
            $data['options'] = json_encode(isset($data['options'])? $data['options'] : []);
            $create = $this->page->create($data);
        }
        return $create;
    }
    
    function update($data, $id, $errorsRedirect = true, $update = null){
        $validator = Validator::make($data, [
            'title' => 'required|max:255',
            'slug' => 'required|unique:pages,slug,'.$id.'|max:255',
            'content' => 'required',
            'status' => 'required',
            'page_type_id' => 'required',
        ]);
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            $data['options'] = json_encode(isset($data['options'])? $data['options'] : []);
            $update = $this->page->update($data, $id);
        }
        return $update;
    }
    
    function destroy($id){
        return $this->page->destroy($id);
    }
        
}