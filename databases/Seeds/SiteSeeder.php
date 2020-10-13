<?php

namespace ConfrariaWeb\Site\Databases\Seeds;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $data = [];
        /*$data['sites'] = [
            [
                'title' => 'Novo Site',
                'domain_id' => 1,
                'template_id' => 1,
                'user_id' => User::inRandomOrder()->first()->id,
                'status' => 1
            ]
        ];*/

        foreach ($data as $table => $inserts) {
            foreach ($inserts as $insert) {
                DB::table($table)->insert($insert);
            }
        }

    }

}