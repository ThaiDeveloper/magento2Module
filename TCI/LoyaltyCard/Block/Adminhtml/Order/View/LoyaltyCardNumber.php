<?php

namespace TCI\LoyaltyCard\Block\Adminhtml\Order\View;

use Magento\Sales\Block\Adminhtml\Order\AbstractOrder;

/**
 * Class LoyaltyCardNumber
 * @package TCI\LoyaltyCard\Block\Adminhtml\Order\View
 */
class LoyaltyCardNumber extends AbstractOrder
{
    /**
     * @return mixed|string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getLoyaltyCardNumberFromOrder()
    {
        $targetNumber = $this->getOrder()->getData('loyalty_card_number') ? $this->getOrder()->getData('loyalty_card_number') : '';
        return $targetNumber;
    }
}