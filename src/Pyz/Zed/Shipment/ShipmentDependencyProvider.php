<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Shipment;

use Spryker\Zed\GiftCard\Communication\Plugin\Shipment\GiftCardShipmentGroupMethodFilterPlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Money\Communication\Plugin\Form\MoneyCollectionFormTypePlugin;
use Spryker\Zed\Shipment\ShipmentDependencyProvider as SprykerShipmentDependencyProvider;

class ShipmentDependencyProvider extends SprykerShipmentDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\ShipmentExtension\Dependency\Plugin\ShipmentMethodAvailabilityPluginInterface[]|\Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodAvailabilityPluginInterface[]
     */
    protected function getAvailabilityPlugins(Container $container): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\ShipmentExtension\Dependency\Plugin\ShipmentMethodPricePluginInterface[]|\Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodPricePluginInterface[]
     */
    protected function getPricePlugins(Container $container): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\ShipmentExtension\Dependency\Plugin\ShipmentMethodDeliveryTimePluginInterface[]|\Spryker\Zed\Shipment\Communication\Plugin\ShipmentMethodDeliveryTimePluginInterface[]
     */
    protected function getDeliveryTimePlugins(Container $container): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Communication\Form\FormTypeInterface
     */
    protected function createPyzMoneyCollectionFormTypePlugin(Container $container)
    {
        return new MoneyCollectionFormTypePlugin();
    }
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return array<\Spryker\Zed\ShipmentExtension\Dependency\Plugin\ShipmentMethodFilterPluginInterface>
     */
    protected function getMethodFilterPlugins(\Spryker\Zed\Kernel\Container $container)
    {
        return [
            new GiftCardShipmentGroupMethodFilterPlugin(),
        ];
    }
}
