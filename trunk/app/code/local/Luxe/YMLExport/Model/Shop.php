<?php
/**
 * Luxe corp.
 * Yandex Market Language Export package
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   Luxe
 * @package    Luxe_YMLExport
 * @copyright  Copyright (c) 2008 Luxe Corp.
 * @license    http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 */

/**
 * Shop model
 *
 * @category   Luxe
 * @package    Luxe_YMLExport
 * @author     Luxe Team 
 */
class Luxe_YMLExport_Model_Shop extends Luxe_YMLExport_Model_Abstract
{
    /**
     * Reference to the Luxe_YMLExport_Model_Catalog class
     *
     */
    private $_ymlCatalog;

    /**
     * Collection of shop's products
     *
     */
    private $_products_collection;

    private function _getCurrencies() {
        $desc  = "<currencies>\n";
        $store = Mage::app()->getStore();
        $currencies = $store->getAvailableCurrencyCodes();
        if (is_array($currencies)) {
            foreach ($currencies as $code) {
                $currency = Mage::getModel('directory/currency')->load($code);
                $cur_rate = $store->getBaseCurrency()->getRate($currency);
                $desc .= "<currency id=\"$code\" rate=\"$cur_rate\" />\n";
            }
        }
        $desc .= "</currencies>\n";
        return $desc;
    }

    private function _getCategories() {
        $categoryIds = array();
        foreach ($this->_products_collection->getItems() as $prodObj) {
            $catIds = $prodObj->getCategoryIds();
            if (!is_array($catIds) || empty($catIds)) {
                continue;
            }
            $categoryIds[] = $catIds[0];
        }
        $categoryIds = array_unique($categoryIds);

        $desc  = "<categories>\n";
        if (!empty($categoryIds)) {

            $catCollection = Mage::getResourceModel('catalog/category_collection')
                    ->addIdFilter($categoryIds)
                    ->addAttributeToSelect('name')
                    ->load();

            foreach ($catCollection as $cat) {
                $desc .= "<category id=\"{$cat->getId()}\"";
                $desc .= " parentId=\"".$cat->getParentId();
                $desc .= "\" >".($this->_esc($cat->getName()))."</category>\n";
            }
        }
        $desc .= "</categories>\n";
        return $desc;
    }

    private function _getOffers() {
        $desc  = "<offers>\n";
        foreach ($this->_products_collection->getItems() as $prodObj) {
            $desc .= Luxe_YMLExport_Model_Offer::getOffer($prodObj)->getDescription();
        }
        $desc .= "</offers>\n";
        return $desc;
    }

    public function setYMLCatalog($catalog) {
        $this->_ymlCatalog = $catalog;
        return $this;
    }

    public function setProductsCollection($collection) {
        $this->_products_collection = $collection;
        return $this;
    }

    /**
     * Get Yandex Market Language description for shop
     *
     * @return string
     */
    public function getDescription()
    {        
        $desc  = "<shop>\n";
        $desc .= "<name>".$this->_esc($this->_ymlCatalog->getYandexStoreName())."</name>\n";
        $desc .= "<company>".$this->_esc($this->_ymlCatalog->getYandexCompany())."</company>\n";
        $desc .= "<url>".$this->_esc($this->_ymlCatalog->getYandexUrl())."</url>\n";
        $phone = $this->_ymlCatalog->getYandexPhone();
        if ($phone) {
            $desc .= "<phone>".$this->_esc($phone)."</phone>\n";
        }
        $desc .= $this->_getCurrencies();
        $desc .= $this->_getCategories();
        $desc .= $this->_getOffers();
        $desc .= "</shop>\n";

        return $desc;
    }
}
