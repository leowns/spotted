<?php

namespace Spotted\FBLoginBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SpottedFBLoginBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
