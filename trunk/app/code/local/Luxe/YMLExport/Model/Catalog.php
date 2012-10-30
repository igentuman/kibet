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
class Luxe_YMLExport_Model_Catalog extends Luxe_YMLExport_Model_Abstract
{
    /**
     *
     * @return bool
     */
    public function isUseGzip()
    {
        return Mage::getStoreConfig('ymlexport/ymlexport/use_gzip');
    }

    public function isActive()
    {
        return Mage::getStoreConfig('ymlexport/ymlexport/active');
    }

    public function isUseAuth()
    {
        return Mage::getStoreConfig('ymlexport/ymlexport/use_auth');
    }

    public function isDeliveryIncluded()
    {
        return Mage::getStoreConfig('ymlexport/ymlexport/is_delivery_included');
    }

    public function getAuthLogin()
    {
        return Mage::getStoreConfig('ymlexport/ymlexport/auth_login');
    }

    public function getAuthPassword()
    {
        return Mage::getStoreConfig('ymlexport/ymlexport/auth_password');
    }

    public function getYandexStoreName()
    {
        return Mage::getStoreConfig('ymlexport/ymlexport/store_name');
    }

    public function getYandexCompany()
    {
        return Mage::getStoreConfig('ymlexport/ymlexport/company_name');
    }

    public function getYandexPhone()
    {
        return Mage::getStoreConfig('ymlexport/ymlexport/phone');
    }

    public function getYandexUrl()
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
    }

    /**
     * Get Yandex Market Language description
     *
     * @return string
     */
    public function getDescription()
    {
        $collection = Mage::getResourceModel('catalog/product_collection');

        Mage::getModel('catalog/layer')->prepareProductCollection($collection);

        $collection->addAttributeToFilter('yml_export', "1")
                   ->addAttributeToSelect('*');

        Mage::getModel('cataloginventory/stock')->addInStockFilterToCollection($collection);
        $collection->load();        

        $desc  = "<?xml version=\"1.0\" encoding=\"windows-1251\"?>\n";
        $desc .= "<!DOCTYPE yml_catalog SYSTEM \"shops.dtd\">\n";
        $desc .= "<yml_catalog date=\"".strftime('%Y-%m-%d %H:%M')."\">\n";
        $desc .= Mage::getModel('ymlexport/shop')->setYMLCatalog($this)->setProductsCollection($collection)->getDescription();
        $desc .= "</yml_catalog>\n";
        $desc = iconv("UTF-8", "windows-1251", $desc);
        return $desc;
    }
}
