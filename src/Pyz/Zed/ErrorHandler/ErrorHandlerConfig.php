<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\ErrorHandler;

use Spryker\Zed\ErrorHandler\ErrorHandlerConfig as SprykerErrorHandlerConfig;

class ErrorHandlerConfig extends SprykerErrorHandlerConfig
{
    /**
     * @return array
     */
    public function getValidSubRequestExceptionStatusCodes() : array
    {
        return array_merge(parent::getValidSubRequestExceptionStatusCodes(), [
            \Symfony\Component\HttpFoundation\Response::HTTP_TOO_MANY_REQUESTS,
        ]);
    }
}