<?PHP

namespace Confrariaweb\Site\Repositories\Eloquent;

use Confrariaweb\Site\Repositories\Contracts\PostContract;
use Confrariaweb\Site\Models\Post;

class PostEloquent implements PostContract
{

    public $post;

    function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function all()
    {
        return $this->post->all();
    }

    public function pluck($text, $id)
    {
        return $this->post->pluck($text, $id);
    }

    public function create(array $data)
    {
        $account = domain_account();
        $create = $this->post->create($data);
        $create->accounts()->sync($account->id);
        return $create;
    }

    public function delete($id)
    {
        return $this->post->destroy($id);
    }

    public function find($id)
    {
        return $this->post->find($id);
    }

    public function findBy($field, $value)
    {
        return $this->post->where($field, $value)->firstOrFail();
    }

    public function paginate($perPage = 15)
    {
        return $this->post->paginate($perPage);
    }

    public function update(array $data, $id)
    {
        $account = domain_account();
        $update = $this->post->find($id);
        $update->update($data);
        $update->accounts()->sync($account->id);
        return $update;
    }

    public function destroy($id)
    {

    }

    public function where(array $data)
    {

    }

}