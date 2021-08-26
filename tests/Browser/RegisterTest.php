<?php

namespace Tests\Browser;

use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Register;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    // Make sure `.env.dusk` file exists and connects to test database
    use DatabaseMigrations;

    public function testViewElements()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(new Register())
                ->assertSee(Str::title(__('messages.personal-account')))
                ->assertSee(Str::title(__('messages.personal-title')))
                ->assertSee(Str::title(__('messages.company-account')))
                ->assertSee(Str::title(__('messages.company-title')))
                ->assertSee(__('messages.already-member'))
                ->assertSeeLink(__('messages.login-here'))

                ->clickLink(__('messages.personal-account')) // check employee registration form elements
                ->waitFor('@employee-registration-form')
                ->assertVisible('@employee-name-input')
                ->assertVisible('@employee-email-input')
                ->assertVisible('@employee-password-input')
                ->assertVisible('@employee-password-confirmation-input')
                ->assertSeeIn(
                    '@employee-registration-submit-button',
                    __('messages.register')
                )
                ->assertSeeIn(
                    '@employee-registration-form',
                    __('messages.agree')
                )
                ->assertSeeIn(
                    '@employee-registration-form',
                    __('messages.term')
                )

                ->clickLink(__('messages.company-account')) // check employer registration form elements
                ->waitFor('@employer-registration-form')
                ->assertVisible('@employer-name-input')
                ->assertVisible('@employer-email-input')
                ->assertVisible('@employer-password-input')
                ->assertVisible('@employer-password-confirmation-input')
                ->assertVisible('@employer-phone-number-input')
                ->assertVisible('@employer-website-input')
                ->assertVisible('@employer-address-input')
                ->assertVisible('@employer-industry-input')
                ->assertSeeIn(
                    '@employer-registration-submit-button',
                    __('messages.register')
                )
                ->assertSeeIn(
                    '@employer-registration-form',
                    __('messages.agree')
                )
                ->assertSeeIn(
                    '@employer-registration-form',
                    __('messages.term')
                );
        });
    }

    public function testRegisterEmployeeSuccessfully()
    {
        $name = 'Vu Nguyen';
        $email = 'nvvu99@email.com';
        $password = 'password';
        $password_confirmation = 'password';

        $this->browse(function (Browser $browser) use (
            $name,
            $email,
            $password,
            $password_confirmation
        ) {
            $browser
                ->visit(new Register())
                ->registerEmployee($name, $email, $password, $password_confirmation)
                ->assertPathIs('/login');
        });
    }

    public function testRegisterEmployeeFailed()
    {
        $name = '';
        $email = 'nvvu99';
        $password = 'password';
        $password_confirmation = 'unmatched_password';

        $this->browse(function (Browser $browser) use (
            $name,
            $email,
            $password,
            $password_confirmation
        ) {
            $browser
                ->visit(new Register())
                ->registerEmployee($name, $email, $password, $password_confirmation)
                ->assertPathIs('/register')
                ->assertSeeIn(
                    '@employee-registration-form',
                    __('validation.required', ['attribute' => 'name'])
                )
                ->assertSeeIn(
                    '@employee-registration-form',
                    __('validation.email', ['attribute' => 'email'])
                )
                ->assertSeeIn(
                    '@employee-registration-form',
                    __('validation.confirmed', ['attribute' => 'password'])
                );
        });
    }

    public function testRegisterEmployerSuccessfully()
    {
        $name = 'Sun Asterisk Vietnam';
        $email = 'hr@sun-asterisk.com';
        $password = 'password';
        $password_confirmation = 'password';

        $this->browse(function (Browser $browser) use (
            $name,
            $email,
            $password,
            $password_confirmation
        ) {
            $browser
                ->visit(new Register())
                ->registerEmployer($name, $email, $password, $password_confirmation)
                ->assertPathIs('/login');
        });
    }

    public function testRegisterEmployerFailed()
    {
        $name = '';
        $email = 'sun';
        $password = 'password';
        $password_confirmation = 'unmatched_password';

        $this->browse(function (Browser $browser) use (
            $name,
            $email,
            $password,
            $password_confirmation
        ) {
            $browser
                ->visit(new Register())
                ->registerEmployer($name, $email, $password, $password_confirmation)
                ->assertPathIs('/register')
                ->clickLink(__('messages.company-account'))
                ->waitFor('@employer-registration-form')
                ->assertSeeIn(
                    '@employer-registration-form',
                    __('validation.required', ['attribute' => 'name'])
                )
                ->assertSeeIn(
                    '@employer-registration-form',
                    __('validation.email', ['attribute' => 'email'])
                )
                ->assertSeeIn(
                    '@employer-registration-form',
                    __('validation.confirmed', ['attribute' => 'password'])
                );
        });
    }
}
