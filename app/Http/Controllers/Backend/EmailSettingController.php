<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class EmailSettingController extends Controller
{
    public function editEmailSettings()
    {
        return view('backend.settings.smtp-mail.email-config');
    }

    public function updateEmailSettings(Request $request)
    {
        $request->validate([
            'MAIL_MAILER' => 'required|string',
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|numeric',
            'MAIL_USERNAME' => 'required|string',
            'MAIL_PASSWORD' => 'required|string',
            'MAIL_ENCRYPTION' => 'nullable|string',
            'MAIL_FROM_ADDRESS' => 'required|email',
            'MAIL_FROM_NAME' => 'required|string',
        ]);


        $data = $request->only([
            'MAIL_MAILER',
            'MAIL_HOST',
            'MAIL_PORT',
            'MAIL_USERNAME',
            'MAIL_PASSWORD',
            'MAIL_ENCRYPTION',
            'MAIL_FROM_ADDRESS',
            'MAIL_FROM_NAME',
        ]);

        foreach ($data as $key => $value) {
            $this->setEnvValue($key, $value);
        }

        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');

        return redirect()->route('admin.setting.email.index')->with('success', 'Email settings updated successfully.');
    }

    protected function setEnvValue($key, $value)
    {
        $path = base_path('.env');

        // Wrap in double quotes if needed (spaces or special characters)
        $value = strpos($value, ' ') !== false || preg_match('/[^A-Za-z0-9_\-@.]/', $value)
            ? '"' . addslashes($value) . '"'
            : $value;

        if (file_exists($path)) {
            $env = file_get_contents($path);

            // Match key even if quoted
            $pattern = "/^{$key}=.*/m";
            $line = "{$key}={$value}";

            if (preg_match($pattern, $env)) {
                $env = preg_replace($pattern, $line, $env);
            } else {
                $env .= "\n{$line}";
            }

            file_put_contents($path, $env);
        }
    }
}
