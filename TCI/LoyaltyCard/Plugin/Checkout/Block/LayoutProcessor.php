<?php

namespace TCI\LoyaltyCard\Plugin\Checkout\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessor as CoreLayoutProcessor;

/**
 * Class LayoutProcessor
 * @package TCI\LoyaltyCard\Plugin\Checkout\Block
 */
class LayoutProcessor
{
    /**
     * @param CoreLayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        CoreLayoutProcessor $subject,
        array $jsLayout
    )
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['loyalty_card_number'] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'options' => [],
                'id' => 'loyalty-card-number'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.loyalty_card_number',
            'label' => 'Loyalty card number',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 250,
            'id' => 'loyalty-card-number'
        ];

        return $jsLayout;
    }
}