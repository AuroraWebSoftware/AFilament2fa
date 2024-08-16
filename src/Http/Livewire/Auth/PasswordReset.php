<?php

namespace Vormkracht10\TwoFactorAuth\Http\Livewire\Auth;

use Filament\Pages\Page;
use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class PasswordReset extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $layout = 'filament-two-factor-auth::layouts.login';

    public ?string $email = '';
    public ?string $password = '';
    public ?string $token = '';

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();

        if (session('status')) {
            Notification::make()
                ->title(session('status'))
                ->success()
                ->send();
        }
    }

    public function hasLogo(): bool
    {
        return false;
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label('E-mail')
                ->afterStateHydrated(function (TextInput $component) {
                    $component->state(request()->get('email'));
                })
                ->disabled(),
            TextInput::make('password')
                ->extraInputAttributes(['name' => 'password'])
                ->label('Wachtwoord')
                ->password()
                ->required()
                ->rules(['confirmed'])
                ->autocomplete('new-password'),
            TextInput::make('password_confirmation')
                ->extraInputAttributes(['name' => 'password_confirmation'])
                ->label('Bevestig wachtwoord')
                ->password()
                ->autocomplete('new-password')
                ->required(),
            Hidden::make('email')
                ->extraAttributes(['name' => 'email'])
                ->afterStateHydrated(fn ($component) => $component->state(request()->get('email'))),
            Hidden::make('token')
                ->extraAttributes(['name' => 'token'])
                ->afterStateHydrated(fn ($component) => $component->state(request()->route('token'))),
        ];
    }

    public function render(): View
    {
        return view('filament-two-factor-auth::auth.password-reset', $this->getViewData())
            ->layout($this->getLayout(), [
                'livewire' => $this,
                'maxContentWidth' => $this->getMaxContentWidth(),
                ...$this->getLayoutData(),
            ]);
    }
}
