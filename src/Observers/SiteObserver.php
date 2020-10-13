<?php

namespace ConfrariaWeb\Site\Observers;

use ConfrariaWeb\Site\Models\Site;
use Illuminate\Support\Facades\Auth;

class SiteObserver
{

    /**
     * Handle the confraria web acl models role "creating" event.
     *
     * @param \ConfrariaWeb\Acl\Models\Role  #role
     * @return void
     */
    public function creating(Site $site)
    {
        $site->user_id = Auth::id();
    }
    /**
     * Handle the site "created" event.
     *
     * @param  ConfrariaWeb\Site\Models\Site  $site
     * @return void
     */
    public function created(Site $site)
    {
        //
    }

    /**
     * Handle the site "updating" event.
     *
     * @param  \ConfrariaWeb\Site\Models\Site  $site
     * @return void
     */
    public function updating(Site $site)
    {
        //
    }

    /**
     * Handle the site "updated" event.
     *
     * @param  ConfrariaWeb\Site\Models\Site  $site
     * @return void
     */
    public function updated(Site $site)
    {
        //
    }

    /**
     * Handle the site "deleted" event.
     *
     * @param  ConfrariaWeb\Site\Models\Site  $site
     * @return void
     */
    public function deleted(Site $site)
    {
        //
    }

    /**
     * Handle the site "restored" event.
     *
     * @param  ConfrariaWeb\Site\Models\Site  $site
     * @return void
     */
    public function restored(Site $site)
    {
        //
    }

    /**
     * Handle the site "force deleted" event.
     *
     * @param  ConfrariaWeb\Site\Models\Site  $site
     * @return void
     */
    public function forceDeleted(Site $site)
    {
        //
    }
}
