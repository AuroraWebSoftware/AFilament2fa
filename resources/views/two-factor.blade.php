<x-filament-panels::page>

    <div class="space-y-10 divide-y divide-gray-900/10 ">
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
            <div class="pr-4 sm:px-0">
                <h2 class="text-base font-semibold leading-7">
                    {{ __('Hesabınızı Güvenceye Alın') }}
                </h2>

                @if (!$showingRecoveryCodes && $user->two_factor_confirmed_at)
                    <p class="mt-1 text-sm leading-6 mb-4">
                        {{ __('Hesabınız iki faktörlü kimlik doğrulama ile güvence altına alınmıştır.') }}
                    </p>
                @else
                    <p class="mt-1 text-sm leading-6 mb-4">
                        {{ __('İki faktörlü kimlik doğrulama kullanarak hesabınıza ek güvenlik katmanı ekleyin.') }}
                    </p>
                @endif
            </div>

            <x-filament::section class="md:col-span-2">
                <x-slot name="description">
                    {{ __('Aşağıdaki butonu kullanarak iki faktörlü kimlik doğrulamayı istediğiniz zaman devre dışı bırakabilirsiniz.') }}
                </x-slot>

                @if (!$showingRecoveryCodes && $user->two_factor_confirmed_at)
                    {{ $this->disableAction() }}
                @else
                    <x-slot name="description">
                        {{ __('Kimliğinizi doğrulamak için :amount seçeneğiniz var, devam etmek için lütfen aşağıdaki seçeneklerden birini seçin.', ['amount' => $this->twoFactorOptionsCount]) }}
                    </x-slot>
                @endif

                @if (!$user->hasEnabledTwoFactorAuthentication() || $this->showingRecoveryCodes)
                    @if (!$this->showTwoFactor())
                        {{ $this->twoFactorOptionForm }}

                        <div class="mt-4 flex items-end justify-end"> {{ $this->enableAction() }} </div>
                    @endif

                    @if ($this->showTwoFactor())
                        <div class="px-4 py-6 sm:p-8">
                            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8">
                                @if ($this->showQrCode)
                                    <div class="text-center space-y-8 mb-4">
                                        <div>
                                            @unless ($showingQrCode)
                                                <div class="font-bold">
                                                    {!! __('İki Faktörlü Kimlik Doğrulama etkinleştirildi') !!}
                                                </div>
                                            @else
                                                <div class="font-bold">
                                                    {!! __('Veya QR kodunu doğrulayıcı uygulamanızla tarayın') !!}.
                                                </div>
                                                <div class="flex items-center justify-center mt-2">
                                                    <div class="border-4 border-white">
                                                        {!! $user->twoFactorQrCodeSvg() !!}
                                                    </div>
                                                </div>
                                                <br />
                                                <p class="text-sm">
                                                    {!! __('Doğrulayıcı uygulamasını ayarlamak için gizli anahtar') !!}: <br />
                                                    <span
                                                        class="font-bold mt-4">{{ decrypt($user->two_factor_secret) }}</span>
                                                </p>
                                            @endunless
                                        </div>
                                    </div>
                                @endif

                                @if ($showingRecoveryCodes)
                                    <div class="text-center text-sm">
                                        {!! __(
                                            'Bu kurtarma kodlarını güvenli bir yerde saklayın, çünkü cihazınızı kaybettiğinizde hesabınıza erişimi kurtarmak için kullanılabilirler',
                                        ) !!}.
                                        <div class="flex items-center justify-center">
                                            <div class="mt-2 text-left text-sm">
                                                @foreach ((array) $user->recoveryCodes() as $index => $code)
                                                    <p class="mt-2">{{ $code }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($showingConfirmation)
                                    <div class="mt-4">
                                        {{ $this->otpCodeForm }}
                                    </div>
                                @endif

                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    @if (!$showingRecoveryCodes && !$user->two_factor_confirmed_at)
                                        {{ $this->disableAction() }}
                                    @endif

                                    @if ($showingRecoveryCodes)
                                        {{ $this->downloadAction() }}
                                        {{ $this->regenerateAction() }}
                                    @elseif ($showingConfirmation)
                                        {{ $this->confirmAction() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </x-filament::section>
        </div>
    </div>
</x-filament-panels::page>
