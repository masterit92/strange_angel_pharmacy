<?php
/**
 * Strange_Manufacturers_Block_Manufacturers
 *
 * @category    Strange
 * @package     Strange_Angel
 * @copyright   Copyright (c) 2014 Strange
 * @author      KhenNT
 */
class Strange_Manufacturers_Block_Manufacturers extends Mage_Core_Block_Template
{
    public function getManufacturers()
    {
        $categoryId = $this->getCategoryId();
        $category = Mage::registry('current_category');
        if ($category) {
            $categoryId = $category->getId();
        }
        $manufacturers = Mage::helper('strange_manufacturers')->getCatManufacturers($categoryId);
        return $manufacturers;
    }
}