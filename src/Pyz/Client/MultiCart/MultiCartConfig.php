<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\MultiCart;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Client\MultiCart\MultiCartConfig as SprykerMultiCartConfig;

class MultiCartConfig extends SprykerMultiCartConfig
{
    /**
     * @return string[]
     */
    public function getQuoteFieldsAllowedForQuoteDuplicate(): array
    {
        return array_merge(parent::getQuoteFieldsAllowedForQuoteDuplicate(), [
            QuoteTransfer::BUNDLE_ITEMS,
            QuoteTransfer::CART_NOTE, #CartNoteFeature
        ]);
    }
    /**
     * @return array
     */
    public function getQuoteFieldsAllowedForCustomerQuoteCollectionInSession() : array
    {
        return [
            QuoteTransfer::CUSTOMER => [
                CustomerTransfer::CUSTOMER_REFERENCE,
            ],
            QuoteTransfer::STORE => [
                StoreTransfer::ID_STORE,
                StoreTransfer::NAME,
            ],
        ];
    }
}
