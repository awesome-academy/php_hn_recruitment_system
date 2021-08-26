<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Login;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        User::factory()->create([
            'role' => config('user.employee'),
            'password' => Hash::make('123456'),
        ]);
    }

    public function testLoginView()
    {
        $this->browse(function ($browser) {
            $browser->visit(new Login)
                ->assertRouteIs('login')
                ->assertSee(__('messages.login'))
                ->assertSee(__('messages.have-no-account'))
                ->assertSee(__('messages.register-now'))
                ->assertInputPresent('email')
                ->assertInputPresent('password')
                ->assertInputPresent('remember')
                ->assertPresent('@login-button')
                ->assertPresent('@register-button');
        });
    }

    public function testRegisterLink()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login)
                ->clickLink(__('messages.register-now'))
                ->assertPathIs('/register');
        });
    }

    public function testCheckBoxInput()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login)
                ->check('@remember-checkbox')
                ->uncheck('@remember-checkbox');
        });
    }

    public function testLoginFailed()
    {
        $email = User::find(1)->email;
        $password = 'wrong';
        $this->browse(function ($browser) use ($email, $password) {
            $browser->visit(new Login)
                ->assert()
                ->signIn($email, $password)
                ->assertRouteIs('login')
                ->assertSee(__('auth.failed'))
                ->assertGuest();
        });
    }

    public function testLoginSuccessfully()
    {
        $user = User::find(1);
        $password = '123456';
        $this->browse(function ($browser) use ($user, $password) {
            $browser->visit(new Login)
                ->assert()
                ->signIn($user->email, $password)
                ->assertRouteIs('home')
                ->assertAuthenticatedAs($user);
        });
    }
}
