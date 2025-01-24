<x-mail::message>
    {{ __('Merhaba') }},

    {{ __('Hesabınıza giriş yapmak için yakın zamanda bir istekte bulundunuz. Girişi tamamlamak için lütfen aşağıdaki iki faktörlü kimlik doğrulama (2FA) kodunu kullanın:') }}

    <div style="background-color: #f0f0f0; padding: 10px; border-radius: 5px; text-align: center; max-width: 200px; font-family: monospace; margin: 25px auto 25px;">
    <span style="font-size: 1.5em; color: #333;">
        {{ $code }}
    </span>
    </div>

    {{ __('Eğer giriş yapmaya çalışmadıysanız, hesabınızı korumak için lütfen hemen şifrenizi değiştirin.') }}

    {{ __('Saygılarımızla') }},<br>
    {{ config('filament-2fa.emails_app_name') }}
</x-mail::message>
