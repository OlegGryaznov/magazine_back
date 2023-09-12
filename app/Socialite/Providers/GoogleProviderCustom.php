<?php

namespace App\Socialite\Providers;

use Laravel\Socialite\Two\GoogleProvider;


class GoogleProviderCustom extends GoogleProvider
{
    /**
     * @return string
     */
    public function getAuthUrlCustom()
    {
        return $this->getAuthUrl(null);
    }
}
