<?php

namespace TCI\LoyaltyCard\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\ObjectManagerInterface;

/**
 * Class SalesModelServiceQuoteSubmitBefore
 * @package TCI\LoyaltyCard\Observer
 */
class SalesModelServiceQuoteSubmitBefore implements ObserverInterface
{
    private $_attributes = 'loyalty_card_number';

    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * SalesModelServiceQuoteSubmitBefore constructor.
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->_objectManager = $objectManager;
    }

    /**
     * @param EventObserver $observer
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(EventObserver $observer)
    {
        /* @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getData('order');
        /* @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        if ($quote->hasData($this->_attributes)) {
            $order->setData($this->_attributes, $quote->getData($this->_attributes));
        }

        return $this;
    }
}