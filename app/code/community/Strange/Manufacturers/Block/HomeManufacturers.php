<?php
/**
 * Strange_Manufacturers_Block_HomeManufacturers
 *
 * @category    Strange
 * @package     Strange_Angel
 * @copyright   Copyright (c) 2014 Strange
 * @author      KhenNT
 */
class Strange_Manufacturers_Block_HomeManufacturers extends Mage_Core_Block_Template
{
    /**
     * Get manufacturers show on homepage
     *
     * @param int $order
     * @return array|boolean
     */
    public function getManufacturers($order = SORT_ASC)
    {
        // Get all manufacturers show on homepage and sort by position
        $manufacturersData = Mage::getModel('manufacturer/manufacturer')->getCollection()
            ->addFieldToSelect('*')
            ->addFieldToFilter('show_on_homepage', '1');
        $manufacturers = array();
        $manuValues = array();
        $manuPositions = array();
        foreach ($manufacturersData as $manufacturer) {
            $manuValue = (int)$manufacturer->getMenufecturerName();
            $manuValues[] = $manuValue;
            $manuPosition = $manufacturer->getPosition() ? (int)$manufacturer->getPosition() : 0;
            $manuPositions[] = $manuPosition;
            $manufacturers[] = array($manuValue => $manuPosition);
        }
        if (sizeof($manuValues)) {
            // Sort the data with position and value following value of $order
            array_multisort($manuPositions, $order, $manuValues, $order, $manufacturers);
            return $manufacturers;
        }
        return false;
    }
}