<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use Laratrust\Models\LaratrustRole;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // App Core
        Setting::firstOrCreate(
            [
            "key" => "app_name",
            "value" => "zStarter",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "site_motto",
            "value" => "Empowering the power",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "app_url",
            "value" => "http://localhost/my-projects/zstarter/public_html/",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "app_language",
            "value" => "en",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "app_currency",
            "value" => "₹",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "decimal_separator",
            "value" => ".",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "currency_position",
            "value" => "before",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "date_format",
            "value" => "Y-m-d",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "app_address",
            "value" => "Near Bharat Petroleum, Ayodhya Nagar, Lugharwada Flat no. 5, Ground Floor, Lugharwara, Madhya Pradesh 480661",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "app_contact",
            "value" => "8085122017",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "app_email",
            "value" => "hq@defenzelite.com",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "app_logo",
            "value" => "",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "app_favicon",
            "value" => "",
            "group" => "app_core"
            ]
        );

        Setting::firstOrCreate(
            [
            "key" => "seo_meta_title",
            "value" => "zStarter",
            "group" => "global_seo"
            ]
        );
        // Global SEO
        Setting::firstOrCreate(
            [
            "key" => "seo_meta_description",
            "value" => "zStarter for Rapid Development",
            "group" => "global_seo"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "seo_meta_keywords",
            "value" => "zStarter",
            "group" => "global_seo"
            ]
        );
        // 
        Setting::firstOrCreate(
            [
            "key" => "copyright_text",
            "value" => "Copyright © {date} Defenzelite Private Limited | zStarter",
            "group" => "app_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "show_social_links",
            "value" => "1",
            "group" => "social_link"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "facebook_link",
            "value" => "https://facebook.com/",
            "group" => "social_link"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "twitter_link",
            "value" => "https://twitter.com/",
            "group" => "social_link"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "instagram_link",
            "value" => "https://instagram.com/",
            "group" => "social_link"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "youtube_link",
            "value" => "https://youtube.com/",
            "group" => "social_link"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "linkedin_link",
            "value" => "https://linkedin.com/",
            "group" => "social_link"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "mail_from_name",
            "value" => "zStarter",
            "group" => "mail_configuration"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "mail_from_address",
            "value" => "defenzeliteprivatelimited@gmail.com",
            "group" => "mail_configuration"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "mail_mailer",
            "value" => "smtp",
            "group" => "mail_configuration"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "mail_host",
            "value" => "smtp-relay.sendinblue.com",
            "group" => "mail_configuration"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "mail_port",
            "value" => "587",
            "group" => "mail_configuration"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "mail_username",
            "value" => "your_email@domain.com",
            "group" => "mail_configuration"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "mail_password",
            "value" => "FbwPOsdBrmJEVI5q",
            "group" => "mail_configuration"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "mail_encryption",
            "value" => "ssl",
            "group" => "mail_configuration"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "notification_api",
            "value" => "",
            "group" => "app_api_configuration"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "email_verify",
            "value" => "0",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "sms_verify",
            "value" => "0",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "no_of_decimal",
            "value" => "2",
            "group" => "currency format"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "appearance_seo_group",
            "value" => "seo_group",
            "group" => "seo_group"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "notification",
            "value" => "1",
            "group" => "app_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "admin_email",
            "value" => "hq@defenzelite.com",
            "group" => "app_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "recaptcha",
            "value" => "0",
            "group" => "app_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "voice_input",
            "value" => "0",
            "group" => "app_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "ekyc_verification_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "email_notify",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "sms_notify",
            "value" => "0",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "authentication_mode",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "pages_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "roles_and_permission_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "user_log_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "order_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "slider_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "wallet_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "ticket_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "lead_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "article_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "paragraph_content_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "website_enquiry_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "payment_gateway_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "payout_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "user_management_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "newsletter_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "faq_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "location_activation",
            "value" => "1",
            "group" => "app_core"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "group_name",
            "value" => "appearance_cookies_agreement",
            "group" => "app_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "frontend_footer_description",
            "value" => "Description",
            "group" => "app_info"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "frontend_copyright_text",
            "value" => "Copyright © 2022 DZE",
            "group" => "app_info"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "website_base_color",
            "value" => "#377dff",
            "group" => "app_info"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "website_base_hov_color",
            "value" => "#377dff",
            "group" => "app_info"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "seo_meta_image",
            "value" => "",
            "group" => "global_seo"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "facebook_client_id",
            "value" => "123",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "custom_header_script",
            "value" => "",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "custom_footer_script",
            "value" => "",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "facebook_client_secret",
            "value" => "0",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "google_client_id",
            "value" => "0",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "linkedin_client_id",
            "value" => "0",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "linkedin_client_secret",
            "value" => "0",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "twitter_client_id",
            "value" => "0",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "twitter_client_secret",
            "value" => "0",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "facebook_login_active",
            "value" => "1",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "global_meta_title",
            "value" => "0",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "maintainance_mode",
            "value" => "1",
            "group" => "app_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "key",
            "value" => "payout_activation",
            "group" => "app_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "custom_header_style",
            "value" => "",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "cookies_agreement_text",
            "value" => "",
            "group" => "app_info"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "custom_footer_style",
            "value" => "0",
            "group" => "dynamic_config"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "frontend_footer_address",
            "value" => "client address here",
            "group" => "app_info"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "frontend_footer_phone",
            "value" => "+91XXXXXXXXXX",
            "group" => "+app_info"
            ]
        );
        Setting::firstOrCreate(
            [
            "key" => "frontend_footer_email",
            "value" => "example@domain.com",
            "group" => "app_info"
            ]
        );
       
        
    }
}
