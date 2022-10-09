<?php

namespace Despawn\Filament\Pages;

use Livewire\Component;

class Login extends Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('despawn::admin.login')
            ->layout('filament::components.layouts.card', [
                'title' => __('filament::login.title'),
            ]);
    }
}
