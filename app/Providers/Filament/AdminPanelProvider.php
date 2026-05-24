<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\AutorizacoesPendentesWidget;
use App\Filament\Widgets\ResumoHojeWidget;
use App\Filament\Widgets\ResumoHojeProfessorWidget;
use App\Filament\Widgets\UltimasMovimentacoesWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::hex('#1e3a5f'),
                'warning' => Color::Amber,
                'danger'  => Color::Red,
                'success' => Color::Teal,
                'info'    => Color::Sky,
            ])
            ->brandName('SAFE')
            ->darkMode(true)
            ->topNavigation(false)
            ->sidebarCollapsibleOnDesktop(true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                ResumoHojeWidget::class,
                ResumoHojeProfessorWidget::class,
                AutorizacoesPendentesWidget::class,
                UltimasMovimentacoesWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function boot(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::SIMPLE_PAGE_START,
            fn (): string => Blade::render('
                <div style="position:absolute;top:1.5rem;left:1.75rem;z-index:10;">
                    <a href="/"
                       style="display:inline-flex;align-items:center;gap:6px;
                              color:#6b7280;font-size:13px;font-weight:500;
                              text-decoration:none;
                              padding:6px 12px;border-radius:8px;
                              transition:color .15s,background .15s;"
                       onmouseover="this.style.color=\'#1d6fce\';this.style.background=\'rgba(29,111,206,.07)\'"
                       onmouseout="this.style.color=\'#6b7280\';this.style.background=\'transparent\'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5M12 5l-7 7 7 7"/>
                        </svg>
                        Voltar
                    </a>
                </div>
            '),
        );
    }
}
