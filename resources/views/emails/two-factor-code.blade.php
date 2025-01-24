<x-mail::message>

    {{ __('Merhaba') }},

    {{ __('Hesabınıza giriş yapmak için bir talepte bulundunuz. Giriş işlemini tamamlamak için lütfen aşağıdaki iki faktörlü kimlik doğrulama (2FA) kodunu kullanın:') }}

    <div style="background-color: #f0f0f0; padding: 10px; border-radius: 5px; text-align: center; max-width: 200px; font-family: monospace; margin: 25px auto 25px;">
        <span style="font-size: 1.5em; color: #333;">
            {{ $code }}
        </span>
    </div>
    {{ __('Eğer giriş yapmaya çalışmadıysanız, hesabınızı korumak için lütfen şifrenizi hemen değiştirin.') }}

    {{ __('Saygılarımızla') }},<br>
    {{ config('app.name') }}

</x-mail::message>
