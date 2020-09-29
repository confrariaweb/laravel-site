<?PHP

namespace Confrariaweb\Site\Services;

use Confrariaweb\Site\Repositories\Contracts\PostContract;
use Validator;

class PostService
{
    private $post;

    public function __construct(PostContract $post)
    {
        $this->post = $post;
    }

    function all(){
        return $this->post->all();
    }
    
    function find($id){
        return $this->post->find($id);
    }
    
    function pluck(){
        return $this->post->pluck('name', 'id')->map(function ($t) {
            return trans(sprintf('%s', $t));
        })->toArray();
    }
    
    function create($data, $errorsRedirect = true, $create = null){
        $validator = Validator::make($data, [
            'name' => 'required|unique:posts,name|max:255',
            'status' => 'required',
        ]);
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            $create = $this->post->create($data);
        }
        return $create;
    }
    
    function update($data, $id, $errorsRedirect = true, $update = null){
        $validator = Validator::make($data, [
            'name' => 'required|unique:posts,name,'.$id.'|max:255',
            'status' => 'required',
        ]);
        if($errorsRedirect){
            $validator->validate();
        }
        if (!$validator->fails()) {
            $update = $this->post->update($data, $id);
        }
        return $update;
    }
    
    function delete($id){
        return $this->post->delete($id);
    }
        
}