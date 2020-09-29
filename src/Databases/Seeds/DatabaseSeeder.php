<?php

namespace Confrariaweb\Site\Databases\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $data['site_page_types'] = [
            ['slug' => 'about', 'title' => 'Sobre nós'],
            ['slug' => 'blog', 'title' => 'Blog'],
            ['slug' => 'broker', 'title' => 'Corretores'],
            ['slug' => 'contact', 'title' => 'Contato']
        ];

        $data['sites'] = [
            [
                'title' => 'Confraria Imob',
                'account_id' => 1,
                'user_id' => 1,
                'template_id' => 1,
                'status' => 1
            ]
        ];

        $data['site_domains'] = [
            ['domain' => 'confraria.imb.br', 'site_id' => 1],
            ['domain' => 'localhost', 'site_id' => 1]
        ];

        foreach ($data as $table => $inserts) {
            foreach ($inserts as $insert) {
                DB::table($table)->insert($insert);
            }
        }

    }

}