<?php
/**
 * Setup script to add featured products for category
 *
 * @category    Strange
 * @package     Strange_Angel
 * @copyright   Copyright (c) 2014 Strange
 * @author      KhenNT
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$entityTypeId = $setup->getEntityTypeId('catalog_category');
$attributeSetId = $setup->getDefaultAttributeSetId($entityTypeId);

$setup->addAttributeGroup($entityTypeId, $attributeSetId, 'Featured Products', 6);

$installer = Mage::getResourceModel('catalog/setup', 'catalog_setup');
$installer->addAttribute('catalog_category', 'featured_products', array(
    'group' => 'Featured Products',
    'input' => 'text',
    'label' => 'Featured Products',
    'source' => 'strange_featuredproducts/catalog_category_attribute_featuredproducts',
    'required' => 0,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'visible' => 1
));

$installer->endSetup();