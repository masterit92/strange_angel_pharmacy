<?php
/**
 * Angel_Theme_Model_Resource_Setup
 *
 * @see         Mage_Core_Model_Resource_Setup
 * @category    Smartbox
 * @package     Smartbox_Mobile
 * @copyright   Copyright (c) 2013 Smartbox
 * @author      KhenNT
 */
class Angel_Theme_Model_Resource_Setup extends Mage_Core_Model_Resource_Setup
{
    public function createCmsBlock($params)
    {
        if (!empty($params['identifier'])) {
            $block = Mage::getModel('cms/block');
            $block->setIdentifier($params['identifier'])
                ->setContent(isset($params['content']) ? $params['content'] : '')
                ->setTitle(isset($params['title']) ? $params['title'] : '')
                ->setStores(array(0))
                ->setIsActive(1)
                ->setId(null)
                ->save();
        }
    }

    public function updateCmsBlock($params)
    {
        if (!empty($params['identifier'])) {
            if (array_key_exists('store_code', $params)) {
                $store = Mage::getModel('core/store')->load($params['store_code']);
                $storeId = $store->getId();
            }else {
                $website = $this->getWebsite($params);
                $storeId = $website->getDefaultStore()->getId();
            }
            $block = Mage::getModel('cms/block')->setStoreId($storeId)->load($params['identifier']);
            if ($block->getId()) {
                $block->setContent(isset($params['content']) ? $params['content'] : $block->getContent())
                    ->setTitle(isset($params['title']) ? $params['title'] : $block->getTitle())
                    ->save();
                return;
            }

            throw new Mage_Core_Exception("Block not existed. Identifier = [{$params['identifier']}].");
        }
    }
}