<?php


namespace App\Socialite\Providers;


use Laravel\Socialite\Two\FacebookProvider;

class FacebookProviderCustom extends FacebookProvider
{
    /**
     * @return string
     */
    public function getAuthUrlCustom()
    {
        return $this->getAuthUrl(null);
    }
}
