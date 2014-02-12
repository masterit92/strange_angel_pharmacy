<?php
/**
 * Setup script to move "manufacturer" to attribute set and create "cat_manufacturers" for category
 *
 * @category    Strange
 * @package     Strange_Angel
 * @copyright   Copyright (c) 2014 Strange
 * @author      KhenNT
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

// Move "manufacturer" attribute to Attribute Set
$attributeSetName = 'Default';
$groupName = 'General';
$attributeCode = 'manufacturer';

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$attributeSetId = $setup->getAttributeSetId('catalog_product', $attributeSetName);
$attributeGroupId = $setup->getAttributeGroupId('catalog_product', $attributeSetId, $groupName);
$attributeId = $setup->getAttributeId('catalog_product', $attributeCode);

$setup->addAttributeToSet($entityTypeId = 'catalog_product', $attributeSetId, $attributeGroupId, $attributeId);

// Create "cat_manufacturers" attribute for category
$installer = Mage::getResourceModel('catalog/setup', 'catalog_setup');
$installer->addAttribute('catalog_category', 'cat_manufacturers', array(
    'group' => 'Display Settings',
    'input' => 'text',
    'type' => 'text',
    'label' => 'Manufacturer',
    'backend' => 'strange_manufacturers/catalog_category_attribute_manufacturers',
    'input_renderer' => 'strange_manufacturers/adminhtml_catalog_category_renderer_manufacturers',
    'visible' => true,
    'required' => false,
    'visible_on_front' => true,
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
));

$installer->endSetup();