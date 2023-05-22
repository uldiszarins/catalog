<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    public function test_home_route()
    {
        $this->withoutMiddleware();
        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertViewIs('home');
    }

    public function test_catalog_create_route()
    {
        $this->withoutMiddleware();
        $response = $this->get('/catalog/create');

        $response->assertSuccessful();
        $response->assertViewIs('createCatalog');
    }

    public function test_catalog_edit_route()
    {
        $this->withoutMiddleware();
        $response = $this->get('/catalog/4');

        $response->assertSuccessful();
        $response->assertViewIs('editCatalog');
    }

    public function test_category_route()
    {
        $this->withoutMiddleware();
        $response = $this->get('/category');

        $response->assertSuccessful();
        $response->assertViewIs('viewCategories');
    }

    public function test_edit_category_route()
    {
        $this->withoutMiddleware();
        $response = $this->get('/category/4');

        $response->assertSuccessful();
        $response->assertViewIs('editCategory');
    }

    public function test_language_route()
    {
        $this->withoutMiddleware();
        $response = $this->get('/language');

        $response->assertSuccessful();
        $response->assertViewIs('viewLanguages');
    }

    public function test_language_add_route()
    {
        $this->withoutMiddleware();
        $response = $this->get('/language/create');

        $response->assertSuccessful();
        $response->assertViewIs('createLanguage');
    }

    public function test_language_edit_route()
    {
        $this->withoutMiddleware();
        $response = $this->get('/language/4');

        $response->assertSuccessful();
        $response->assertViewIs('editLanguages');
    }

    public function test_images_route()
    {
        $this->withoutMiddleware();
        $response = $this->get('/images/1');

        $response->assertSuccessful();
        $response->assertViewIs('viewImages');
    }
}
