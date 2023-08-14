<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ParagraphContent;
use Laratrust\Models\LaratrustRole;

class ParagraphTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Home Page
        ParagraphContent::firstOrCreate(
            [
            "code" => "home_title",
            "value" => "Get Started Quickly with zStarter - **The Ultimate Laravel Project Starter!**",
            "type" => "1"
            ]
        );
        ParagraphContent::firstOrCreate(
            [
            "code" => "home_description",
            "value" => "<p>Start building your Laravel project in no time. <strong>Our powerful toolkit includes all the essential components you need to get started,</strong> including pre-configured authentication, database migrations, and a modular structure that's easy to customize and extend. So why wait? <i>Get started with zStarter today and supercharge your Laravel development workflow!</i></p>",
            "type" => "2"
            ]
        );
        ParagraphContent::firstOrCreate(
            [
            "code" => "about_title",
            "value" => "<p>Once upon a time...</p>",
            "type" => "1"
            ]
        );
        ParagraphContent::firstOrCreate(
            [
            "code" => "about_description",
            "value" => "<p>There was a software development team that worked on creating custom web applications for their clients. They were passionate about their work and always strived to deliver high-quality solutions that exceeded their clients' expectations.</p><p>However, the team faced a major challenge - project timelines. They found that they were spending too much time setting up new projects and configuring their development environments, which left them with less time to focus on actual coding and development work. As a result, they were frequently missing project deadlines, which led to dissatisfied clients and lost business.</p><p>The team knew they needed a solution to streamline their development process and deliver projects faster. That's when they discovered zStarter - the ultimate Laravel project starter developed by defenzelite.</p><p>With zStarter, the team was able to get new projects up and running quickly, thanks to its pre-configured authentication, modular structure, and database migrations. They no longer had to spend hours configuring their development environments or building custom authentication systems from scratch - zStarter took care of all that for them.</p><p>This allowed the team to focus on the actual coding and development work, which meant they could deliver projects faster without compromising on quality. They were able to meet project deadlines with ease, which made their clients happy and helped them win new business.</p><p>Thanks to zStarter, the software development team was able to overcome their biggest challenge and take their development workflow to the next level. They continued to use zStarter on all their projects, which allowed them to deliver high-quality solutions faster and more efficiently than ever before.</p>",
            "type" => "2"
            ]
        );
        ParagraphContent::firstOrCreate(
            [
            "code" => "contact_title",
            "value" => "Get in Touch with zStarter - Your Ultimate Laravel Development Partner!",
            "type" => "1"
            ]
        );
        ParagraphContent::firstOrCreate(
            [
            "code" => "contact_description",
            "value" => "Whether you have questions about zStarter or need help with your Laravel development project, our team is here to support you every step of the way. Contact us today to learn more about how zStarter can help you supercharge your development workflow and deliver projects faster and more efficiently than ever before. Our expert developers are always happy to answer your questions and provide guidance on best practices, so don't hesitate to get in touch!",
            "type" => "1"
            ]
        );
    }
}
