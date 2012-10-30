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
 * Offer model
 *
 * @category   Luxe
 * @package    Luxe_YMLExport
 * @author     Luxe Team 
 */
class Luxe_YMLExport_Model_Offer extends Luxe_YMLExport_Model_Abstract
{
    protected $_product;
    const MODULE_GROUP_NAME = 'YML Export';

    function __construct($product) 
    {
        $this->_product = $product;
    }

    static function getUsedAttributes()
    {     
        $attributes = array(
            'yml_export' => array(
                'type'       => 'int',
                'input'      => 'boolean',
                'label'      => 'Export to Yandex Market',
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
            ),
            'offer_type' => array(
                'type'       => 'int',
                'input'      => 'select',
                'label'      => 'Offer type',
                'source'     => 'ymlexport/entity_attribute_source_offerType',
                'global'     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                'visible'    => 1,
                'required'   => 1,
                'user_defined' => 1,
                'default'    => 0,
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
            ),
            'cbid' => array(
                'type'       => 'int',
                'input'      => 'text',
                'label'      => 'CBid',
                'source'     => '',
                'global'     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                'visible'    => 1,
                'required'   => 0,
                'user_defined' => 1,
                'default'    => 0,
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
            ),
            'bid' => array(
                'type'       => 'int',
                'input'      => 'text',
                'label'      => 'Bid',
                'source'     => '',
                'global'     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
                'visible'    => 1,
                'required'   => 1,
                'user_defined' => 1,
                'default'    => 0,
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
            ),
            'delivery' => array(
                'type'       => 'varchar',
                'input'      => 'text',
                'label'      => 'Delivery',
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
            ),
            'delivery_included' => array(
                'type'       => 'int',
                'input'      => 'boolean',
                'label'      => 'Delivery included',
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
            ),
            'sales_notes' => array(
                'type'       => 'varchar',
                'input'      => 'text',
                'label'      => 'Sales notes',
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
            ),
            'yml_description' => array(
                'type'       => 'varchar',
                'input'      => 'textarea',
                'label'      => 'YML description',
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
            ),
        );
        return $attributes;
    }
    /**
     * $product - Mage_Catalog_Model_Product
     *
     */
    public static function getOffer($product) 
    {
        $offer_type = $product->getAttributeText('offer_type');        
        switch ($offer_type) {
            case 'simple': 
            {
                $offer = new Luxe_YMLExport_Model_Offers_Simple($product);
                break;     
            }
            case 'book': 
            {
                $offer = new Luxe_YMLExport_Model_Offers_Book($product);
                break;     
            }
            case 'artist.title': 
            {
                $offer = new Luxe_YMLExport_Model_Offers_ArtistTitle($product);
                break;     
            }
            case 'tour': 
            {
                $offer = new Luxe_YMLExport_Model_Offers_Tour($product);
                break;     
            }
            case 'ticket': 
            {
                $offer = new Luxe_YMLExport_Model_Offers_Ticket($product);
                break;     
            }
            case 'event-ticket': 
            {
                $offer = new Luxe_YMLExport_Model_Offers_EventTicket($product);
                break;     
            }
            case 'vendor.model': 
            default:
            {
                $offer = new Luxe_YMLExport_Model_Offers_VendorModel($product);
                break;     
            }
        }
        return $offer;
    }

    protected function getBeginTag() 
    {
        $tag = "<offer ";
        $tag .= " id=\"".$this->_product->getId()."\" ";
        $tag .= " bid=\"".$this->_product->getData('bid')."\" ";
        $tag .= " type=\"".$this->_product->getAttributeText('offer_type')."\"";
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

    protected function getUrlTag()
    {
        return "<url>".$this->_esc($this->_product->getProductUrl())."</url>\n"; 
    }

    protected function getCategoryTag()
    {
        $catIds = $this->_product->getCategoryIds();
        return "<categoryId>".$catIds[0]."</categoryId>\n"; 
    }

    protected function getCurrencyTag()
    {
        return "<currencyId>".$this->_esc(Mage::app()->getStore()->getBaseCurrencyCode())."</currencyId>\n"; 
    }

    protected function getPriceTag()
    {
        return "<price>".$this->_esc($this->_product->getFinalPrice())."</price>\n"; 
    }

    protected function getPictureTag()
    {
        if ($this->_product->getImageUrl()) {
            return "<picture>".$this->_esc($this->_product->getImageUrl())."</picture>\n"; 
        } else {
            return '';
        }
    }

    protected function getDescriptionTag()
    {
        if ($this->_product->getData('yml_description')) {
            return "<description>".$this->_esc($this->_product->getData('yml_description'))."</description>\n";
        } else {
            return '';
        }
    }

    protected function getDeliveryTag()
    {
        if ($this->_product->getData('delivery')) {
            return "<delivery>".$this->_esc($this->_product->getData('delivery'))."</delivery>\n"; 
        } else {
            return '';
        }
    }

    protected function getSalesNotesTag()
    {
        if ($this->_product->getData('sales_notes')) {
            return "<sales_notes>".$this->_esc($this->_product->getData('sales_notes'))."</sales_notes>\n"; 
        } else {
            return '';
        }
    }

    protected function getDeliveryIncludedTag()
    {
        if ($this->_product->getData('delivery_included')) {
            return "<deliveryIncluded/>\n"; 
        } else {
            return '';
        }
    }


    protected function getEndTag() 
    {
        return "</offer>\n";
    }
}
?>
