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
                'name'    => 'Welcome email',
                'subject' => 'Account created on {SITE_NAME} ',
                'body'    => '<table>
                                <tbody>
                                  <tr>
                                    <td colspan="">{FULL_NAME},<br />Your account is created on {SITE_NAME}, you can set your password using below link.<br /> This link will be expired in 24 hours</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                  <td>Please <a href="{SITE_LOGIN_URL}">click here</a> to set your password.</td>
                                  </tr>
                                </tbody>
                              </table>'],
            [
                'key'     => 'resetPassword',
                'name'    => 'Reset password',
                'subject' => 'Password reset on {SITE_NAME} ',
                'body'    => '<table>
                                <tbody>
                                  <tr>
                                    <td colspan="">{FULL_NAME},<br />You have requested to reset the password for your&nbsp;{SITE_NAME}&nbsp;account.<br /> This link will be expired in 24 hours</td>
                                  </tr>
                                  <tr>
                                  <td>You can <a href="{SITE_LOGIN_URL}">click here</a> to reset your password.</td>
                                  </tr>
                                </tbody>
                              </table> '],
            [
                'key'     => 'notificationMail',
                'name'    => 'Notification mail',
                'subject' => '{SUBJECT} on {SITE_NAME} ',
                'body'    => '<table>
                                <tbody>
                                  <tr>
                                    <td colspan="">{FIRST_NAME},<br />{DESCRIPTION} </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        <table>
                                          <tbody> {DETAILS} </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>'
            ],
        ];

        foreach ($items as $item) {
            EmailTemplate::create($item);
        }
    }
}
