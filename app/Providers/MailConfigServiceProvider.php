<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt; // Import this
use App\Models\SmtpSetting;

class MailConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 1. Wrap in try-catch to prevent app crash if DB is offline or table missing
        try {
            if (Schema::hasTable('smtp_settings')) {
                $mail = SmtpSetting::find(1);

                // 2. Only run if we actually found data
                if ($mail) {
                    $config = [
                        'transport' => 'smtp',
                        'host'       => $mail->host,
                        'port'       => $mail->port,
                        'username'   => $mail->username,
                        'password'   => Crypt::decryptString($mail->password), // Manual Decrypt
                        'encryption' => $mail->encryption,
                        'timeout'    => null,
                        'auth_mode'  => null,
                    ];

                    Config::set('mail.mailers.smtp', $config);
                    Config::set('mail.from', [
                        'address' => $mail->from_address,
                        'name'    => $mail->from_name,
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Silently fail if something goes wrong so the whole app doesn't crash.
            // You can log this if you want: \Log::error($e->getMessage());
        }
    }
}
