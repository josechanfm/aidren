<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::create(
            ['key'=>'forum_categories','content'=>
                [
                    [
                        "value"=> "GENERAL",
                        "label"=> "General"
                    ],[
                        "value"=> "TECHNOLOGY",
                        "label"=> "Technology"
                    ],[
                        "value"=> "FINANCE",
                        "label"=> "Finance"
                    ]
                ]
            ]
        );
        Config::create(
            ['key'=>'article_categories','content'=>
                [
                    [
                        "value"=>"article",
                        "label"=>"Article"
                    ],
                    [
                        "value"=>"news",
                        "label"=>"News"
                    ],
                    [
                        "value"=>"clause",
                        "label"=>"Clause"
                    ]
                ]
            ]
        );

        
    }
}
