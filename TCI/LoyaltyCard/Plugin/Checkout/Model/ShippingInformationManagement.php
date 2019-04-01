<?php

namespace TCI\LoyaltyCard\Plugin\Checkout\Model;

use Magento\Quote\Model\QuoteRepository;

/**
 * Class ShippingInformationManagement
 * @package TCI\LoyaltyCard\Plugin\Checkout\Model
 */
class ShippingInformationManagement
{
    private $_attributes = 'loyalty_card_number';

    /**
     * @var QuoteRepository
     */
    protected $quoteRepository;

    /**
     * ShippingInformationManagement constructor.
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        QuoteRepository $quoteRepository
    )
    {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
        $quote = $this->quoteRepository->getActive($cartId);
        $extAttributes = $addressInformation->getShippingAddress()->getExtensionAttributes();

        if (method_exists($extAttributes, 'getLoyaltyCardNumber') &&
            $loyaltyCardNumber = $extAttributes->getLoyaltyCardNumber()) {

            $quote->setData($this->_attributes, $loyaltyCardNumber);

        }
    }
}