<?php namespace Media;

use App;
use Backend;
use BackendMenu;
use BackendAuth;
use Media\Widgets\MediaManager;
use System\Classes\CombineAssets;
use System\Classes\MarkupManager;
use Backend\Classes\WidgetManager;
use October\Rain\Support\ModuleServiceProvider;
use Illuminate\Support\Facades\Schema;

class ServiceProvider extends ModuleServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register('media');

        $this->registerMarkupTags();
        $this->registerAssetBundles();

        /*
         * Backend specific
         */
        if (App::runningInBackend()) {
            $this->registerBackendNavigation();
            $this->registerBackendWidgets();
            $this->registerBackendPermissions();
            $this->registerGlobalInstance();
        }
    }

    /**
     * Bootstrap the module events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot('media');
        
        Schema::defaultStringLength(191);
    }

    /**
     * Register asset bundles
     */
    protected function registerAssetBundles()
    {
        CombineAssets::registerCallback(function ($combiner) {
            $combiner->registerBundle('~/modules/media/widgets/mediamanager/assets/js/mediamanager-browser.js');
            $combiner->registerBundle('~/modules/media/widgets/mediamanager/assets/less/mediamanager.less');
        });
    }

    /*
     * Register navigation
     */
    protected function registerBackendNavigation()
    {
        BackendMenu::registerCallback(function ($manager) {
            $manager->registerMenuItems('October.Media', [
                'media' => [
                    'label'       => 'backend::lang.media.menu_label',
                    'icon'        => 'icon-folder',
                    'iconSvg'     => 'modules/media/assets/images/media-icon.svg',
                    'url'         => Backend::url('media'),
                    'permissions' => ['media.*'],
                    'order'       => 200
                ]
            ]);
        });
    }

    /*
     * Register permissions
     */
    protected function registerBackendPermissions()
    {
        BackendAuth::registerCallback(function ($manager) {
            $manager->registerPermissions('October.Media', [
                'media.manage_media' => [
                    'label' => 'backend::lang.permissions.manage_media',
                    'tab' => 'system::lang.permissions.name',
                ]
            ]);
        });
    }

    /*
     * Register widgets
     */
    protected function registerBackendWidgets()
    {
        WidgetManager::instance()->registerFormWidgets(function ($manager) {
            $manager->registerFormWidget('Media\FormWidgets\MediaFinder', 'mediafinder');
        });
    }

    /*
     * Register markup tags
     */
    protected function registerMarkupTags()
    {
        MarkupManager::instance()->registerCallback(function ($manager) {
            $manager->registerFilters([
                'media' => [\Media\Classes\MediaLibrary::class, 'url'],
            ]);
        });
    }

    /**
     * Media Manager widget is available on all back-end pages
     */
    protected function registerGlobalInstance()
    {
        \Backend\Classes\Controller::extend(function($controller) {
            $user = BackendAuth::getUser();
            if (!$user || !$user->hasAccess('media.*')) {
                return;
            }

            $manager = new MediaManager($controller, 'ocmediamanager');
            $manager->bindToController();
        });
    }
}
