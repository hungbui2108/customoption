<?php
/**
 * User: smart
 * Date: 21-12-2017
 * Time: 9:39 SA
 */

namespace Hungbd\CustomOptionImage\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $installer->getConnection()->addColumn(
            $installer->getTable('catalog_product_option_type_value'),
            'image_link',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'Image link'
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable('catalog_product_option_type_value'),
            'color',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'Color'
            ]
        );
        $installer->getConnection()->addColumn(
            $installer->getTable('catalog_product_option_type_value'),
            'display_mode',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'Display Mode'
            ]
        );
        $installer->endSetup();
    }
}