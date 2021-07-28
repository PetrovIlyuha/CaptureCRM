<?php


namespace App\Modules\Admin\Sources\Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourcesSeed extends Seeder
{

    public function run() {
        DB::table('sources')->insert([
            [
                'title' => 'Facebook'
            ],
            [
                'title' => 'Internet Commercials'
            ],
            [
                'title' => 'YouTube Channel'
            ],
            [
                'title' => 'Partners Program'
            ]
        ]);
    }
}
