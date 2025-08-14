<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\BasicSetting as BS;
use App\Models\Social;
use App\Models\Language;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        try {
            $socials = Social::orderBy('serial_number', 'ASC')->get();
        } catch (\Exception $e) {
            $socials = collect([]);
        }
        try {
            $langs = Language::all();
        } catch (\Exception $e) {
            $langs = collect([]);
        }

        view()->composer('*', function ($view)
        {
            try {
                if (session()->has('lang')) {
                    $currentLang = Language::where('code', session()->get('lang'))->first();
                } else {
                    $currentLang = Language::where('is_default', 1)->first();
                }

                // If no default language is set or language not found, get the first available language
                if (!$currentLang) {
                    $currentLang = Language::first();
                }

                // If still no language found, return early to prevent errors
                if (!$currentLang) {
                    return;
                }
            } catch (\Exception $e) {
                return;
            }

            try {
                $bs = $currentLang->basic_setting;
                $be = $currentLang->basic_extended;
                
                // Add null checks for relationships
                if (!$bs) {
                    return;
                }
                
                $activeTheme = $bs->theme;
                

                $apopups = $currentLang->popups()->where('status', 1)->orderBy('serial_number', 'ASC')->get();

                if (Menu::where('language_id', $currentLang->id)->count() > 0) {
                    $menus = Menu::where('language_id', $currentLang->id)->first()->menus;
                } else {
                    $menus = json_encode([]);
                }

                if ($currentLang->rtl == 1) {
                    $rtl = 1;
                } else {
                    $rtl = 0;
                }

                $view->with('activeTheme', $activeTheme );
                $view->with('bs', $bs );
                $view->with('be', $be );
                $view->with('currentLang', $currentLang );
                $view->with('apopups', $apopups);
                $view->with('menus', $menus );
                $view->with('rtl', $rtl );
            } catch (\Exception $e) {
                // Set default values if database operations fail
                $view->with('activeTheme', 'default');
                $view->with('bs', null);
                $view->with('be', null);
                $view->with('currentLang', null);
                $view->with('apopups', collect([]));
                $view->with('menus', json_encode([]));
                $view->with('rtl', 0);
            }
        });
        View::share('langs', $langs);
        View::share('socials', $socials);
    }
}
