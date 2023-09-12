<?php
namespace App\Socialite;

use App\Socialite\Providers\FacebookProviderCustom;
use App\Socialite\Providers\GoogleProviderCustom;
use Laravel\Socialite\SocialiteManager;


class SocialiteManagerCustom extends SocialiteManager
{
    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createGoogleDriver()
    {
        $config = $this->config->get('services.google');

        return $this->buildProvider(
            GoogleProviderCustom::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createFacebookDriver()
    {
        $config = $this->config->get('services.facebook');

        return $this->buildProvider(
            FacebookProviderCustom::class, $config
        );
    }
}
