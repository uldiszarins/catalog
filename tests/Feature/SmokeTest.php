<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    public function test_home_route()
    {
        $response = $this->get('/');

        $response->assertSuccessful();
        $response->assertViewIs('home');
    }

    public function test_catalog_create_route()
    {
        $response = $this->get('/catalog/create');

        $response->assertSuccessful();
        $response->assertViewIs('createCatalog');
    }

    public function test_catalog_edit_route()
    {
        $response = $this->get('/catalog/1');

        $response->assertSuccessful();
        $response->assertViewIs('editCatalog');
    }

    public function test_category_route()
    {
        $response = $this->get('/category');

        $response->assertSuccessful();
        $response->assertViewIs('viewCategories');
    }

    public function test_edit_category_route()
    {
        $response = $this->get('/category/1');

        $response->assertSuccessful();
        $response->assertViewIs('editCategory');
    }

    public function test_language_route()
    {
        $response = $this->get('/language');

        $response->assertSuccessful();
        $response->assertViewIs('viewLanguages');
    }

    public function test_language_add_route()
    {
        $response = $this->get('/language/create');

        $response->assertSuccessful();
        $response->assertViewIs('createLanguage');
    }

    public function test_language_edit_route()
    {
        $response = $this->get('/language/1');

        $response->assertSuccessful();
        $response->assertViewIs('editLanguages');
    }
}
