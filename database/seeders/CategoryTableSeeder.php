<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Laratrust\Models\LaratrustRole;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // BlogCategories
        Category::firstOrCreate(
            [
            "name" => "General",
            "level" => 1,
            "category_type_id" => 1,
            "parent_id" => null,
            "icon" => null,
            ]
        );

        Category::firstOrCreate(
            [
            "name" => "News",
            "level" => 1,
            "category_type_id" => 1,
            "parent_id" => null,
            "icon" => null,
            ]
        );
       
        // LeadCategories
        Category::firstOrCreate(
            [
            "name" => "Interested In Service",
            "level" => 1,
            "category_type_id" => 2,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        
        Category::firstOrCreate(
            [
            "name" => "Interested In Products",
            "level" => 1,
            "category_type_id" => 2,
            "parent_id" => null,
            "icon" => null,
            ]
        );
      
        // LeadStatus
        Category::firstOrCreate(
            [
            "name" => "New",
            "level" => 1,
            "category_type_id" => 3,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        Category::firstOrCreate(
            [
            "name" => "Qualified",
            "level" => 1,
            "category_type_id" => 3,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        Category::firstOrCreate(
            [
            "name" => "Negotiation",
            "level" => 1,
            "category_type_id" => 3,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        Category::firstOrCreate(
            [
            "name" => "Won",
            "level" => 1,
            "category_type_id" => 3,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        Category::firstOrCreate(
            [
            "name" => "Lost",
            "level" => 1,
            "category_type_id" => 3,
            "parent_id" => null,
            "icon" => null,
            ]
        );

        // FaqCategories
        Category::firstOrCreate(
            [
            "name" => "General",
            "level" => 1,
            "category_type_id" => 4,
            "parent_id" => null,
            "icon" => null,
            ]
        );

        // LeadSource
        Category::firstOrCreate(
            [
            "name" => "Social Media",
            "level" => 1,
            "category_type_id" => 5,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        Category::firstOrCreate(
            [
            "name" => "Client Reference",
            "level" => 1,
            "category_type_id" => 5,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        Category::firstOrCreate(
            [
            "name" => "Inbound",
            "level" => 1,
            "category_type_id" => 5,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        Category::firstOrCreate(
            [
            "name" => "Outbound",
            "level" => 1,
            "category_type_id" => 5,
            "parent_id" => null,
            "icon" => null,
            ]
        );

        // ItemCategories
        Category::firstOrCreate(
            [
            "name" => "General",
            "level" => 1,
            "category_type_id" => 6,
            "parent_id" => null,
            "icon" => null,
            ]
        );

        //SupportTicketCategories
        Category::firstOrCreate(
            [
            "name" => "Service Request Tickets",
            "level" => 1,
            "category_type_id" => 7,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        Category::firstOrCreate(
            [
            "name" => "Incident Tickets",
            "level" => 1,
            "category_type_id" => 7,
            "parent_id" => null,
            "icon" => null,
            ]
        );
        
    }
}
