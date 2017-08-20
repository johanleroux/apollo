<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompaniesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauthenticated_users_may_not_participate_with_companies()
    {
        create(Company::class);

        $this->withExceptionHandling()
            ->get('/company')
            ->assertRedirect('/login');

        $this->withExceptionHandling()
            ->patch('/company')
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_users_may_not_participate_with_companies()
    {
        create(Company::class);
        $this->signIn();

        $this->withExceptionHandling()
            ->get('/company')
            ->assertStatus(403);

        $this->withExceptionHandling()
            ->patch('/company')
            ->assertStatus(403);
    }

    /** @test */
    function authorized_users_may_view_a_company()
    {
        $this->signInAdmin();

        $company = create(Company::class);

        $this->get('/company')
             ->assertStatus(200)
             ->assertSee($company->name);
    }

    /** @test */
    function authorized_users_may_update_a_company()
    {
        $this->signInAdmin();

        $company = create(Company::class);

        $this->patch('/company', [
            'name'      => 'John Doe',
            'telephone' => '0112223333',
            'email'     => 'john@paradox.com',
        ]);

        $this->assertDatabaseHas('companies', [
            'name'      => 'John Doe',
            'telephone' => '0112223333',
            'email'     => 'john@paradox.com',
        ]);
    }
}
