<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Router;

use Spryker\Yves\Router\RouterConfig as SprykerRouterConfig;

class RouterConfig extends SprykerRouterConfig
{
    /**
     * @return string
     */
    public function getAllowedLanguages() : string
    {
        return (new Container())->getLocator()->locale()->client()->getAllowedLanguages();
    }
}