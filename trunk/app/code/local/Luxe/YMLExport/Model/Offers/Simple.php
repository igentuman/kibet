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
 * "vendor.model" offer type.
 *
 * @category   Luxe
 * @package    Luxe_YMLExport
 * @author     Luxe Team
 */
class Luxe_YMLExport_Model_Offers_Simple extends Luxe_YMLExport_Model_Offers_VendorModel
{
    static function getUsedAttributes()
    {
        $attributes = parent::getUsedAttributes();
        $attributes['yml_name'] = array(
            'type'       => 'varchar',
            'input'      => 'text',
            'label'      => 'YML name',
            'source'     => '',
            'global'     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
            'visible'    => 1,
            'required'   => 0,
            'user_defined' => 1,
            'default'    => '',
            'searchable' => 0,
            'filterable' => 0,
            'comparable' => 0,
            'visible_on_front' => 0,
            'visible_in_advanced_search' => 0,
            'unique'     => 0,
            'apply_to'   => '',
            'is_configurable' => 0,
            'note'       => '',
            'group'      => Luxe_YMLExport_Model_Offer::MODULE_GROUP_NAME,
        );
        $attributes['vendor_code'] = array(
            'type'       => 'varchar',
            'input'      => 'text',
            'label'      => 'Vendor code',
            'source'     => '',
            'global'     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
            'visible'    => 1,
            'required'   => 0,
            'user_defined' => 1,
            'default'    => '',
            'searchable' => 0,
            'filterable' => 0,
            'comparable' => 0,
            'visible_on_front' => 0,
            'visible_in_advanced_search' => 0,
            'unique'     => 0,
            'apply_to'   => '',
            'is_configurable' => 0,
            'note'       => '',
            'group'      => Luxe_YMLExport_Model_Offer::MODULE_GROUP_NAME,
        );
        return $attributes;
    }

    protected function getBeginTag() 
    {
        $tag = "<offer ";
        $tag .= " id=\"".$this->_product->getId()."\" ";
        $tag .= " bid=\"".$this->_product->getData('bid')."\" ";
        $tag .= " available=\"";
        if ($this->_product->isInStock()) {
            $tag .= "true";
        } else {
            $tag .= "false";
        }
        $tag .= '" ';
        if ($this->_product->getData('cbid')) {
            $tag .= " cbid=\"".$this->_product->getData('cbid')."\" ";
        }
        $tag .= ">\n";
        return $tag;
    }

    protected function getNameTag()
    {
        if ($this->_product->getData('yml_name')) {
            return "<name>".$this->_esc($this->_product->getData('yml_name'))."</name>\n";
        } else {
            return '';
        }
    }

    //
    public function getDescription()
    {
        $descr = $this->getBeginTag();
        $descr .= $this->getUrlTag();
        $descr .= $this->getPriceTag();
        $descr .= $this->getCurrencyTag();
        $descr .= $this->getCategoryTag();
        $descr .= $this->getPictureTag();
        $descr .= $this->getDeliveryTag();
        $descr .= $this->getDeliveryIncludedTag();

        // vendor.model specified fields
        $descr .= $this->getNameTag();
        if (Mage::getStoreConfig('ymlexport/ymlexport/is_export_vendor')) {
            $descr .= $this->getVendorTag();
        }
        $descr .= $this->getVendorCodeTag();

        $descr .= $this->getDescriptionTag();
        $descr .= $this->getSalesNotesTag();
        $descr .= $this->getEndTag();
        return $descr;
    }
}
?>
