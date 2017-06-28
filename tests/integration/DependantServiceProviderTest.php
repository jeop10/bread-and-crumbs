<?php

namespace BreadcrumbsTests;

use Breadcrumbs;
use DaveJamesMiller\Breadcrumbs\ServiceProvider;

class DependantServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
            DependantServiceProvider::class,
        ];
    }

    protected function loadServiceProvider()
    {
        // Disabled - we want to test the automatic loading instead
    }

    public function testRender()
    {
        $html = Breadcrumbs::render('home')->toHtml();
        $this->assertXmlStringEqualsXmlFile(__DIR__ . '/../fixtures/DependantServiceProvider.html', $html);
    }
}

class DependantServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Breadcrumbs::register('home', function ($breadcrumbs) {
            $breadcrumbs->push('Home', '/');
        });
    }
}
