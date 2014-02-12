<?php
/**
 * Setup script to add more fields
 *
 * @category    Bc
 * @package     Bc_Manaufacturer
 * @author      KhenNT
 */
$installer = $this;

$installer->startSetup();

$this->_conn->addColumn($this->getTable('manufacturer'), 'show_on_homepage', 'smallint(6) default 2');
$this->_conn->addColumn($this->getTable('manufacturer'), 'position', 'text default ""');

$installer->endSetup(); 