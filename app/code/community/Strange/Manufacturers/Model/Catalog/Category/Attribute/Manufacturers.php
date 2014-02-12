<?php
/**
 * Strange_Manufacturers_Model_Catalog_Category_Attribute_Manufacturers
 *
 * @category    Strange
 * @package     Strange_Angel
 * @copyright   Copyright (c) 2014 Strange
 * @author      KhenNT
 */
class Strange_Manufacturers_Model_Catalog_Category_Attribute_Manufacturers extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
{
    /**
     * Before save method
     *
     * @param Varien_Object $object
     * @return Strange_Manufacturers_Model_Catalog_Category_Attribute_Manufacturers
     */
    public function beforeSave($object)
    {
        if ($object->getId()) {
            $object->setData('cat_manufacturers', serialize($object->getData('cat_manufacturers')));
        }
        return $this;
    }

    /**
     * After load method
     *
     * @param Varien_Object $object
     * @return Strange_Manufacturers_Model_Catalog_Category_Attribute_Manufacturers
     */
    public function afterLoad($object)
    {
        if ($object->getId()) {
            $object->setData('cat_manufacturers', unserialize($object->getData('cat_manufacturers')));
        }
        return $this;
    }
}