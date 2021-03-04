<?PHP

namespace ConfrariaWeb\Site\Services;

use ConfrariaWeb\Site\Contracts\SiteMenuContract;
use ConfrariaWeb\Vendor\Traits\ServiceTrait;

class SiteMenuService
{
    use ServiceTrait;

    private $menu;

    public function __construct(SiteMenuContract $menu)
    {
        $this->obj = $menu;
    }

}
