<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'key'     => 'welcomeEmail',
                'name'    => 'Welcome mail',
                'subject' => 'Welcome mail.',
                'body'    => [
                    ['Greeting' => 'Welcome! {FULL_NAME}'],
                    ['Line' => 'We are happy to have you.'],
                ]
            ],
            [
                'key'     => 'resetPassword',
                'name'    => 'Reset password mail',
                'subject' => 'Reset Password Request.',
                'body'    => [
                    ['Greeting' => 'Hello! {FULL_NAME}'],
                    ['Line' => 'You are receiving this email because we received a password reset request for your account.'],
                    ['Action' => 'Reset Password'],
                    ['Line' => 'This password reset link will expire in {PASSWORD_EXPIRED} minutes.'],
                    ['Line' => 'If you did not request a password reset, no further action is required.']
                ]
            ],
            [
                'key'     => 'notificationMail',
                'name'    => 'Notification mail',
                'subject' => '{SUBJECT}',
                'body'    => [
                    ['greeting' => 'Hello! {FULL_NAME}'],
                    ['Line' => '{DESCRIPTION}'],
                ]
            ],
        ];

        foreach ($items as $item) {
            EmailTemplate::updateOrCreate(['key' => $item['key']], $item);
        }
    }
}
