<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryType;
use Laratrust\Models\LaratrustRole;

class CategoryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryType::firstOrCreate(
            [
            "name" => "Blog Category",
            "allowed_level" => 1,
            "code" => 'BlogCategories',
            "is_system" => 1,
            "remark" => null,
            ]
        );
        CategoryType::firstOrCreate(
            [
            "name" => "Lead Category",
            "allowed_level" => 1,
            "code" => 'LeadCategories',
            "is_system" => 1,
            "remark" => null,
            ]
        );
        CategoryType::firstOrCreate(
            [
            "name" => "Lead Status",
            "allowed_level" => 1,
            "code" => 'LeadStatus',
            "is_system" => 1,
            "remark" => null,
            ]
        );
        CategoryType::firstOrCreate(
            [
            "name" => "Faq Category",
            "allowed_level" => 1,
            "code" => 'FaqCategories',
            "is_system" => 1,
            "remark" => null,
            ]
        );
        CategoryType::firstOrCreate(
            [
            "name" => "Lead Categories",
            "allowed_level" => 1,
            "code" => 'LeadCategories',
            "is_system" => 1,
            "remark" => null,
            ]
        );
        CategoryType::firstOrCreate(
            [
            "name" => "Lead Source",
            "allowed_level" => 1,
            "code" => 'LeadSource',
            "is_system" => 1,
            "remark" => null,
            ]
        );
        CategoryType::firstOrCreate(
            [
            "name" => "Item Category",
            "allowed_level" => 1,
            "code" => 'ItemCategories',
            "is_system" => 1,
            "remark" => null,
            ]
        );
        CategoryType::firstOrCreate(
            [
            "name" => "Support Ticket Category",
            "allowed_level" => 1,
            "code" => 'SupportTicketCategories',
            "is_system" => 1,
            "remark" => null,
            ]
        );
        CategoryType::firstOrCreate(
            [
            "name" => "Job Title Category",
            "allowed_level" => 1,
            "code" => 'JobTitleCategories',
            "is_system" => 1,
            "remark" => null,
            ]
        );
        
    }
}
