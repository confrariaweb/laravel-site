<?php 

namespace Confrariaweb\Site\Repositories\Contracts;

interface DomainContract {
    public function all();
    public function destroy($id);
    public function find($id);
    public function findDomain($domain);
    public function findSite($siteID);
    public function store($request);
    public function update($request, $id);
}