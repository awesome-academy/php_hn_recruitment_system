<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Register extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/register';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@employee-registration-form' => 'form#employee-register',
            '@employee-name-input' => 'form#employee-register input[name="name"]',
            '@employee-email-input' => 'form#employee-register input[name="email"]',
            '@employee-password-input' => 'form#employee-register input[name="password"]',
            '@employee-password-confirmation-input' => 'form#employee-register input[name="password_confirmation"]',
            '@employee-registration-submit-button' => 'form#employee-register button#login-submit',

            '@employer-registration-form' => 'form#employer-register',
            '@employer-name-input' => 'form#employer-register input[name="name"]',
            '@employer-email-input' => 'form#employer-register input[name="email"]',
            '@employer-password-input' => 'form#employer-register input[name="password"]',
            '@employer-password-confirmation-input' => 'form#employer-register input[name="password_confirmation"]',
            '@employer-phone-number-input' => 'form#employer-register input[name="phone_number"]',
            '@employer-website-input' => 'form#employer-register input[name="website"]',
            '@employer-address-input' => 'form#employer-register input[name="address"]',
            '@employer-industry-input' => 'form#employer-register input[name="industry"]',
            '@employer-registration-submit-button' => 'form#employer-register button#login-submit',
        ];
    }

    public function registerEmployee(
        Browser $browser,
        $name,
        $email,
        $password,
        $password_confirmation
    ) {
        $browser
            ->clickLink(__('messages.personal-account'))
            ->waitFor('@employee-registration-form')
            ->value('@employee-name-input', $name)
            ->value('@employee-email-input', $email)
            ->value('@employee-password-input', $password)
            ->value('@employee-password-confirmation-input', $password_confirmation)
            ->press('@employee-registration-submit-button');
    }

    public function registerEmployer(
        Browser $browser,
        $name,
        $email,
        $password,
        $password_confirmation
    ) {
        $browser
            ->clickLink(__('messages.company-account'))
            ->waitFor('@employer-registration-form')
            ->value('@employer-name-input', $name)
            ->value('@employer-email-input', $email)
            ->value('@employer-password-input', $password)
            ->value('@employer-password-confirmation-input', $password_confirmation)
            ->press('@employer-registration-submit-button');
    }
}
