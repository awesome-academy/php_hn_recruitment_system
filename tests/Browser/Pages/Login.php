<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Login extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
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
            '@email' => 'input[name=email]',
            '@password' => 'input[name=password]',
            '@remember-checkbox' => '.login_remember_box',
            '@login-button' => '#login-submit',
            '@register-button' => '.login_message a',
        ];
    }

    public function signIn(Browser $browser, $email, $password)
    {
        $browser->value('@email', $email)
            ->value('@password', $password)
            ->press('@login-button');
    }
}
