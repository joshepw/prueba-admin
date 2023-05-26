<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Pixel\Admin\Constants\Level;
use Pixel\Admin\Constants\UserType;
use Pixel\Admin\Entities\MenuItem;
use Pixel\Admin\Entities\PermissionItem;
use Pixel\Admin\Entities\SettingItem;
use Pixel\Admin\Entities\WidgetItem;
use Pixel\Admin\Fields\InputSetting;
use Pixel\Support\Contracts\ProviderWithNavigation;
use Pixel\Support\Contracts\ProviderWithPermissions;
use Pixel\Support\Contracts\ProviderWithSettings;
use Pixel\Support\Contracts\ProviderWithWidgets;

class AppServiceProvider extends ServiceProvider implements ProviderWithNavigation, ProviderWithSettings, ProviderWithPermissions, ProviderWithWidgets
{

    public function registerWidgets(): array {
        return [
            WidgetItem::build('custom', 'Soy un Widget', 34)
                ->componentType('percent-widget')
                ->addProperty('icon', 'hand')
                ->addProperty('title', setting('platform.welcome_message'))
                ->setWidth(4, 12)
				->setHeight(1, 1)
        ];
    }

    public function registerPermissions(): array {
        return [
            PermissionItem::build('view_widget', 'Ver Widget peronslizado', 'Widget')
                ->setLevel(Level::ADMIN, Level::GUEST)
                ->defaultTo(UserType::USER, UserType::ADMIN, UserType::SUPERUSER)
        ];
    }

    public function registerSettings(): array {
        return [
            InputSetting::build('welcome_message', 'test.welcome.label')
                ->inTab('platform')
                ->setPlaceholder('test.welcome.placeholder')
                ->setRules('min:3|max:80')
        ];
    }

    public function registerNavigation(): array {
        return [
            MenuItem::separator()->setOrder(2000),

            MenuItem::build('home', 'Home', 'merchant')
                ->setOrder(0)
                ->setRoute('admin.home'),

            MenuItem::build('ionic', 'Ir a Ionic.com', 'lang-ionic')
                ->setOrder(2001)
                ->setAction('https://ionicframework.com/'),
        ];
    }

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
        //
    }
}
