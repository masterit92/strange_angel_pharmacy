<?php
/**
 * Strange_Manufacturers_Helper_Data
 *
 * @category    Strange
 * @package     Strange_Angel
 * @copyright   Copyright (c) 2014 Strange
 * @author      KhenNT
 */
class Strange_Manufacturers_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Get manufacturers of category
     *
     * @param int|string $categoryId
     * @param int $order
     * @return array|boolean
     */
    public function getCatManufacturers($categoryId, $order = SORT_ASC)
    {
        $category = Mage::getModel('catalog/category')->load($categoryId);
        if ($category) {
            $manufacturers = array();
            $manuValues = array();
            $manuPositions = array();
            $catManufacturers = $category->getCatManufacturers();
            foreach ($catManufacturers as $manuValue => $manuData) {
                if (array_key_exists('enabled', $manuData)) {
                    $manuValue = (int)$manuValue;
                    $manuValues[] = $manuValue;
                    $manuPosition = $manuData['position'] ? (int)$manuData['position'] : 0;
                    $manuPositions[] = $manuPosition;
                    $manufacturers[] = array($manuValue => $manuPosition);
                }
            }
            if (sizeof($manuValues)) {
                // Sort the data with position and value following value of $order
                array_multisort($manuPositions, $order, $manuValues, $order, $manufacturers);
                return $manufacturers;
            }
        }
        return false;
    }

    /**
     * Get manufacturers of category
     *
     * @param int|string $manufacturerValue
     * @return string
     */
    public function getManufacturerLogo($manufacturerValue)
    {
        $manufacturer = Mage::getModel('manufacturer/manufacturer')->getCollection()
            ->addFieldToFilter('menufecturer_name', $manufacturerValue)
            ->getFirstItem();
        if ($manufacturer && $manufacturer->getFilename()) {
            return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'Manufacturer/' . $manufacturer->getFilename();
        }
        return false;
    }

    /**
     * Get manufacturer name from value
     *
     * @param string $manufacturerValue
     * @return string
     */
    public function getManufacturerName($manufacturerValue)
    {
        $attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', 'manufacturer');
        $options = $attribute->getSource()->getAllOptions(false);
        return $options[$manufacturerValue];
    }
}