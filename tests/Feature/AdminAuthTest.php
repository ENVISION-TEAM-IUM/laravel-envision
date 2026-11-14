<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertSee('Masuk ke CMS');
    }

    public function test_admin_login_html_alias_redirects_to_login(): void
    {
        $response = $this->get('/admin-login.html');

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_path_redirects_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_authenticate_using_the_login_screen(): void
    {
        $admin = Admin::factory()->create([
            'email' => 'admin@bumdes.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@bumdes.id',
            'password' => 'password123',
        ]);

        $this->assertTrue(Auth::guard('admin')->check());
        $this->assertEquals($admin->id, Auth::guard('admin')->id());
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_can_authenticate_using_username(): void
    {
        $admin = Admin::factory()->create([
            'username' => 'admin_bumdes',
            'email' => 'admin@bumdes.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'login' => 'admin_bumdes',
            'password' => 'password123',
        ]);

        $this->assertTrue(Auth::guard('admin')->check());
        $this->assertEquals($admin->id, Auth::guard('admin')->id());
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_cannot_authenticate_with_invalid_password(): void
    {
        Admin::factory()->create([
            'email' => 'admin@bumdes.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@bumdes.id',
            'password' => 'wrong-password',
        ]);

        $this->assertFalse(Auth::guard('admin')->check());
        $response->assertSessionHasErrors('email');
    }

    public function test_admin_login_rate_limiting_triggers_after_max_attempts(): void
    {
        Admin::factory()->create([
            'email' => 'admin@bumdes.id',
            'password' => Hash::make('password123'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            $this->post(route('admin.login.submit'), [
                'email' => 'admin@bumdes.id',
                'password' => 'wrong-password',
            ]);
        }

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@bumdes.id',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertFalse(Auth::guard('admin')->check());
    }

    public function test_unauthenticated_admin_cannot_access_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $admin = Admin::factory()->create([
            'name' => 'Pengurus BUMDes',
            'email' => 'admin@bumdes.id',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($admin, 'admin')->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Pengurus BUMDes');
        $response->assertSee('Kelola isi website');
    }

    public function test_admin_can_logout(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admin')->post(route('admin.logout'));

        $this->assertFalse(Auth::guard('admin')->check());
        $response->assertRedirect(route('admin.login'));
    }
}
