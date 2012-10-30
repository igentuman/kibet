<?php
/**
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2011 Lucid Dreams (http://lucid-dreams.pl)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Marcin Roszak <magento@lucid-dreams.pl>
 */
class LD_AjaxCart_Block_List extends Mage_Catalog_Block_Product_List {

    protected function _prepareLayout() {
        $ajaxCart = Mage::registry('current_category')->getData('ajaxcart');
        if ($ajaxCart == 1) {
            $headBlock = $this->getLayout()->getBlock('head');
            $headBlock->addItem('skin_js','js/ajaxcart/jquery-1.5.1.min.js');
            $headBlock->addItem('skin_js','js/ajaxcart/jquery-ui-1.8.13.custom.min.js');
            $headBlock->addItem('skin_js','js/ajaxcart/ajaxcart.js');
        }
        parent::_prepareLayout();
    }

}