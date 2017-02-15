<?php

namespace IgniteYourProject\ApiAuthenticationBundle;

use IgniteYourProject\ApiAuthenticationBundle\DependencyInjection\IYPApiAuthenticationExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApiAuthenticationBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new IYPApiAuthenticationExtension();
    }
}
