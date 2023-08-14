<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SeoTag;
use Laratrust\Models\LaratrustRole;

class SeoTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SeoTag::firstOrCreate(
            [
            "code" => "home",
            "title" => "Home",
            "keyword" => "Developed By Defenzelite",
            "description" =>"Keyword Description",
            "remark" => null,
            ]
        );
        SeoTag::firstOrCreate(
            [
            "code" => "about",
            "title" => "About",
            "keyword" => "Developed By Defenzelite",
            "description" =>"Keyword Description",
            "remark" => null,
            ]
        );
        SeoTag::firstOrCreate(
            [
            "code" => "contact",
            "title" => "Contact",
            "keyword" => "Developed By Defenzelite",
            "description" =>"Keyword Description",
            "remark" => null,
            ]
        );
        SeoTag::firstOrCreate(
            [
            "code" => "blog",
            "title" => "Blog",
            "keyword" => "Developed By Defenzelite",
            "description" =>"Keyword Description",
            "remark" => null,
            ]
        );
        SeoTag::firstOrCreate(
            [
            "code" => "faq",
            "title" => "FAQ",
            "keyword" => "Developed By Defenzelite",
            "description" =>"Keyword Description",
            "remark" => null,
            ]
        );
    }
}
