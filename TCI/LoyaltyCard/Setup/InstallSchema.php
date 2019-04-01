<?php

namespace TCI\LoyaltyCard\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package TCI\LoyaltyCard\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        /* Add column to quote table */
        $installer->getConnection()->addColumn(
            $installer->getTable('quote'),
            'loyalty_card_number',
            [
                'type' => 'text',
                'length' => 255,
                'nullable' => true,
                'comment' => 'Loyalty card number',
            ]
        );


        /* Add column to order table */
        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order'),
            'loyalty_card_number',
            [
                'type' => 'text',
                'length' => 255,
                'nullable' => true,
                'comment' => 'Loyalty card number',
            ]
        );

        /* Add column to order grid table */
        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_grid'),
            'loyalty_card_number',
            [
                'type' => 'text',
                'length' => 255,
                'nullable' => true,
                'comment' => 'Loyalty card number',
            ]
        );

        $setup->endSetup();
    }
}