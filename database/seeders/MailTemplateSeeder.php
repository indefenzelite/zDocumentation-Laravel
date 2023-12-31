<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MailSmsTemplate;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailSmsTemplate::firstOrCreate(
            [
            "subject" => "Welcome to {app.name}.",
            "purpose" => "To be sent when user registers and verification is disabled.",
            "code" => "registration-welcome-mail",
            "type" => 1,
            "content" => "## Welcome to {app.name}
                You are successfully registered with us,
                please login to start using our platform.
                ### Registered account details
                Name: {name} {br}
                Username: {username} {br}
                Email: **{email}** {br}
                Password: `your selected password` {br}",
            ]
        );

        /**
         * Create registration email verification template
         */
        MailSmsTemplate::firstOrCreate(
            [
            "subject" => "Welcome to {app.name}.",
            "purpose" => "To be sent when user registers and verification is enabled.",
            "code" => "registration-email-verification-mail",
            "type" => 1,
            "content" => "## Welcome to {app.name} Please verify your email: {email}
                You are successfully registered with us please verify your email
                to continue using our platform.
                ### Registered account details
                Name: {name} {br}
                Username: {username} {br}
                Email: **{email}** {br}
                Password: `your selected password` {br}
                Verification Link: [Verify now]({verify_link}) {br}
                Or
                You can click below link to verify your account.
                <{verify_link}>",
            ]
        );

        /**
         * Create registration email verification by OTP template
         */
        MailSmsTemplate::firstOrCreate(
            [
            "subject" => "Welcome to {app.name}.",
            "purpose" => "To be sent when user registers and verification is enabled with OTP method typically it will be for api auth.",
            "code" => "registration-email-verification-with-otp-mail",
            "type" => 1,
            "content" => "## Welcome to {app.name} Please verify your email: {email}
                You are successfully registered with us please verify your email
                to continue using our platform.
                ### Registered account details
                Name: {name} {br}
                Username: {username} {br}
                Email: **{email}** {br}
                Password: `your selected password` {br}
                Verification Code: **{otp}**
                Enter above **OTP** in the verification screen and verify your account.
                ",
            ]
        );


        /**
         * Create email verification template
         */
        MailSmsTemplate::firstOrCreate(
            [
            "subject" => "Verify your email.",
            "purpose" => "To be sent when user request for email verification manually.",
            "code" => "email-verification-mail",
            "type" => 1,
            "content" => "## Verify your email: {email}
                We received a verification request for the account associated with
                email- **{email}** please click the link below to verify your account.
                Verification Link: [Verify now]({verify_link}) {br}
                Or
                You can click below link to verify your account.
                <{verify_link}>
                ### If this was not you who requested the verification please ignore this mail.
                ",
            ]
        );


        /**
         * Create email verification OTP template
         */
        MailSmsTemplate::firstOrCreate(
            [
            "subject" => "Verify your email.",
            "purpose" => "To be sent when user request for email verification manually with OTP method.",
            "code" => "email-verification-otp-mail",
            "type" => 1,
            "content" => "## Verify your email: {email}
                We received a verification request for the account associated with
                email- **{email}** please use verification given below to verify your account.
                Verification Code: **{otp}**
                ### If this was not you who requested the verification please ignore this mail.
                ",
            ]
        );

        /**
         * Create email verification success template
         */
        MailSmsTemplate::firstOrCreate(
            [
            "subject" => "Email verified successfully.",
            "purpose" => "To be sent when email verification completed successfully.",
            "code" => "email-verification-success-mail",
            "type" => 1,
            "content" => "## Email verified successfully
                Congratulations your account verified successfully
                now you can login and use our platform.
                [Login Now]({login_link})",
            ]
        );

        /**
         * Password updated email template
         */
        MailSmsTemplate::firstOrCreate(
            [
            "subject" => "Your password updated successfully for {email}!",
            "purpose" => "To be sent when password updated.",
            "code" => "password-updated-mail",
            "type" => 1,
            "content" => "## Password updated successfully
                Congratulations! Your password has been reset successfully for your account
                associated with email **{email}** now you can login to your account.
                [Login Now]({login_link})",
            ]
        );
    }
}
