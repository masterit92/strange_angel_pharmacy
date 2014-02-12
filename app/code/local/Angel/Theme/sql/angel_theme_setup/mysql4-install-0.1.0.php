<?php
/**
 * Setup script to setup theme
 *
 * @category    Strange
 * @package     Strange_Angel
 * @copyright   Copyright (c) 2014 Strange
 * @author      KhenNT
 */
/* @var $installer Angel_Theme_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

// Configure theme
$config = Mage::app()->getConfig();
$config->saveConfig('design/theme/locale', 'angel', 'default', 0);
$config->saveConfig('design/theme/template', 'angel', 'default', 0);
$config->saveConfig('design/theme/skin', 'angel', 'default', 0);
$config->saveConfig('design/theme/layout', 'angel', 'default', 0);
$config->saveConfig('design/theme/default', 'default', 'default', 0);

// Configure telephone number
$config->saveConfig('general/store_information/phone', '01305 77 77 05', 'default', 0);

$installer->endSetup();