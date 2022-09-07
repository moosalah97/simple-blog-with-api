<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
use RefreshDatabase;
    public function test_login_redirect_to_dashboard_successful()
    {
     User::factory()->create([
         'name'=>'FuckU',
         'email'=>'test1@test.test',
         'password'=>bcrypt('123456789')
     ]);
     $response = $this->post('/login',[
         'name'=>'FuckU',
         'email'=>'test1@test.test',
         'password'=>'123456789'
     ]);
     $response ->assertStatus(302)
         ->assertRedirect('/home');
    }
    public function test_auth_user_can_access_to_dashboard_successful()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response ->assertStatus(200);
    }
    public function test_unauth_user_can_not_access_to_dashboard_successful()
    {
        $response = $this->get('/');
        $response ->assertStatus(302)
            ->assertRedirect('/login');
    }
    public function test_user_has_name_attribute_successful()
    {
        $user = User::factory()->create([
            'name' => 'sdafsadf',
            'email'=>'test1@test.test',
            'password'=>bcrypt('123456789')
        ]);
        $this->assertEquals('sdafsadf',$user->name);

    }
}
