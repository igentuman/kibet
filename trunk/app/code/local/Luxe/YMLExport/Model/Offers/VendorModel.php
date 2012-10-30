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
class Luxe_YMLExport_Model_Offers_VendorModel extends Luxe_YMLExport_Model_Offer
{
    function __construct($product)
    {
        parent::__construct($product);
    }

    static function getUsedAttributes()
    {
        $attributes = parent::getUsedAttributes();
        $attributes['type_prefix'] = array(
            'type'       => 'varchar',
            'input'      => 'text',
            'label'      => 'Type prefix',
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
        $attributes['model'] = array(
            'type'       => 'varchar',
            'input'      => 'text',
            'label'      => 'Model',
            'source'     => '',
            'global'     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
            'visible'    => 1,
            'required'   => 1,
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

    protected function getTypePrefixTag()
    {
        if ($this->_product->getData('type_prefix')) {
            return "<typePrefix>".$this->_esc($this->_product->getData('type_prefix'))."</typePrefix>\n";
        } else {
            return '';
        }
    }

    protected function getVendorTag()
    {
        if ($this->_product->getData('manufacturer')) {
            return "<vendor>".$this->_esc($this->_product->getAttributeText('manufacturer'))."</vendor>\n";
        } else {
            return '';
        }
    }

    protected function getVendorCodeTag()
    {
        if ($this->_product->getData('vendor_code')) {
            return "<vendorCode>".$this->_esc($this->_product->getData('vendor_code'))."</vendorCode>\n";
        } else {
            return '';
        }
    }

    protected function getModelTag()
    {
        if ($this->_product->getData('model')) {
            return "<model>".$this->_esc($this->_product->getData('model'))."</model>\n";
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
        $descr .= $this->getTypePrefixTag();
        $descr .= $this->getVendorTag();
        $descr .= $this->getVendorCodeTag();
        $descr .= $this->getModelTag();

        $descr .= $this->getDescriptionTag();
        $descr .= $this->getSalesNotesTag();
        $descr .= $this->getEndTag();
        return $descr;
    }
}
?>
