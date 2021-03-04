<?PHP

namespace ConfrariaWeb\Site\Repositories;

use ConfrariaWeb\Site\Contracts\SiteMenuContract;
use ConfrariaWeb\Site\Models\SiteMenu;
use ConfrariaWeb\Vendor\Traits\RepositoryTrait;

class SiteMenuRepository implements SiteMenuContract
{
    use RepositoryTrait;

    public $menu;

    function __construct(SiteMenu $menu)
    {
        $this->obj = $menu;
    }

}