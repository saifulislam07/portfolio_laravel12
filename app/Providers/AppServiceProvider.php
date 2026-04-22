<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load SMTP settings from database if they exist
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $mailSettings = \App\Models\Setting::where('key', 'like', 'mail_%')->pluck('value', 'key');
                
                if ($mailSettings->isNotEmpty()) {
                    config([
                        'mail.mailers.smtp.host' => $mailSettings->get('mail_host'),
                        'mail.mailers.smtp.port' => $mailSettings->get('mail_port'),
                        'mail.mailers.smtp.username' => $mailSettings->get('mail_username'),
                        'mail.mailers.smtp.password' => $mailSettings->get('mail_password'),
                        'mail.mailers.smtp.encryption' => $mailSettings->get('mail_encryption'),
                        'mail.from.address' => $mailSettings->get('mail_from_address'),
                        'mail.from.name' => $mailSettings->get('mail_from_name'),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Silence errors during migrations or if table doesn't exist
        }
    }
}
