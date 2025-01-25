<?php

namespace AuroraWebSoftware\TwoFactorAuth\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use PragmaRX\Google2FA\Exceptions\IncompatibleWithGoogleAuthenticatorException;
use PragmaRX\Google2FA\Exceptions\InvalidCharactersException;
use PragmaRX\Google2FA\Exceptions\SecretKeyTooShortException;
use AuroraWebSoftware\TwoFactorAuth\Actions\GenerateOTP;
use AuroraWebSoftware\TwoFactorAuth\Enums\TwoFactorType;
use AuroraWebSoftware\TwoFactorAuth\Mail\TwoFactorCodeMail;

class SendOTP extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(mixed $notifiable): array
    {
        if ($notifiable->two_factor_type === TwoFactorType::email) {
            return ['mail'];
        }

        if (
            $notifiable->two_factor_type === TwoFactorType::phone &&
            in_array(TwoFactorType::phone, config('filament-2fa.options'))
        ) {
            return [config('filament-2fa.sms_service')];
        }

        return [];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(mixed $notifiable): Mailable
    {
        if (! $notifiable->two_factor_secret) {
            throw new \Exception('User does not have a two factor secret.');
        }

        return (new TwoFactorCodeMail($this->getTwoFactorCode($notifiable)))
            ->to($notifiable->email)->view(config('filament-2fa.email_view','filament-2fa::emails.two-factor-code') ?? 'filament-2fa::emails.two-factor-code');
    }

    /**
     * @throws IncompatibleWithGoogleAuthenticatorException
     * @throws SecretKeyTooShortException
     * @throws InvalidCharactersException
     */
    public function getTwoFactorCode(mixed $notifiable): string
    {
        return GenerateOTP::for(
            decrypt($notifiable->two_factor_secret)
        );
    }
}
