<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use App\Models\SiteConfig;
use Auth;
use Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use OwenIt\Auditing\Events\AuditCustom;
use Yajra\DataTables\Facades\DataTables;

class SiteSettingsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:' . config('permission-name.setting-site_config'), ['only' => ['siteConfig']]);
        $this->middleware('permission:' . config('permission-name.setting-mail_settings'), ['only' => ['mailConfig']]);
        $this->middleware('permission:' . config('permission-name.setting-email_template_list'), ['only' => ['emailTemplate']]);
        $this->middleware('permission:' . config('permission-name.setting-email_template_update'), ['only' => ['emailTemplateEdit', 'mailSettingsUpdate']]);
    }

    public function siteConfig()
    {
        return view('setting.site-config', ['data' => SiteConfig::pluck('value', 'key')]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function siteSettingsUpdate(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            $siteConfig = SiteConfig::where('key', $key)->first();
            if ($siteConfig && $siteConfig->value != $value) {
                SiteConfig::where('key', $key)->update(['value' => $value]);

                $siteConfig->auditEvent = 'updated';
                $siteConfig->isCustomEvent = true;
                $siteConfig->auditCustomOld = ['key' => $siteConfig->key, 'value' => $siteConfig->value];
                $siteConfig->auditCustomNew = ['key' => $key, 'value' => $value];
                Event::dispatch(AuditCustom::class, [$siteConfig]);
            }
        }
        Cache::delete('siteConfig');
        return Redirect::back()->with(['toastStatus' => 'success', 'message' => 'Site config updated successfully.']);
    }

    public function mailConfig()
    {
        return view('setting.mail-config', ['data' => SiteConfig::pluck('value', 'key')]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function mailSettingsUpdate(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            $siteConfig = SiteConfig::where('key', $key)->first();
            if ($siteConfig && $siteConfig->value != $value) {
                if($key == 'mail_password')
                    $value = Crypt::encryptString($value);
                SiteConfig::where('key', $key)->update(['value' => $value]);

                $siteConfig->auditEvent = 'updated';
                $siteConfig->isCustomEvent = true;
                $siteConfig->auditCustomOld = ['key' => $siteConfig->key, 'value' => $siteConfig->value];
                $siteConfig->auditCustomNew = ['key' => $key, 'value' => $value];
                Event::dispatch(AuditCustom::class, [$siteConfig]);
            }
        }
        Cache::delete('siteConfig');
        return Redirect::back()->with(['toastStatus' => 'success', 'message' => 'mail setting updated successfully.']);
    }

    public function emailTemplate(Request $request)
    {
        $accessToModify = auth()->user()->hasPermissionTo(config('permission-name.setting-email_template_update'));
        if ($request->ajax()) {
            $emailTemplate = EmailTemplate::where('key', '!=', 'notificationMail')->select(['name', 'subject', 'id']);
            return DataTables::eloquent($emailTemplate)
                ->addColumn('action', function ($row) use ($accessToModify) {
                    return $accessToModify ? '<a href="' . route('emailTemplate.edit', $row->id ?? 0) . '" class="btn btn-primary btn-sm mx-1 my-1">View/Update</a>' :
                        '<span class="badge bg-label-gray">No Access</span>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('setting.index-email-template');
    }

    public function emailTemplateEdit(EmailTemplate $emailTemplate)
    {
        return view('setting.update-email-template', ['emailTemplate' => $emailTemplate]);
    }

    public function emailTemplateUpdate(Request $request, EmailTemplate $emailTemplate)
    {
        $validData = $request->validate([
            'name'    => ['required', 'max:255'],
            'subject' => ['required', 'max:255'],
            'body.*'  => ['required'],
        ]);
        if ($emailTemplate->update($validData)) {
            Cache::delete('emailTemplate');
            return Redirect::back()->with(['toastStatus' => 'success', 'message' => 'Email template updated successfully. Check mail preview.']);
        }
        Cache::delete('emailTemplates');
    }

    public function emailPreview(EmailTemplate $emailTemplate)
    {
        $message = (new \App\Notifications\MailPreviewNotification(['actionUrl' => url('/reset-password-url'), 'template' => $emailTemplate, 'desc' => 'This is notification description.']))->toMail(Auth::user());
        $markdown = new \Illuminate\Mail\Markdown(view(), config('mail.markdown'));
        return $markdown->render('vendor.notifications.email', $message->data());
    }

}
