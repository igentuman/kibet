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


class Luxe_YMLExport_Model_Entity_Attribute_Source_OfferType extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
    /**
     * Retrive all attribute options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
                array(
                    'label' => Mage::helper('ymlexport')->__('vendor.model'),
                    'value' =>  0
                ),
                array(
                    'label' => Mage::helper('ymlexport')->__('artist.title'),
                    'value' =>  1
                ),
                array(
                    'label' => Mage::helper('ymlexport')->__('tour'),
                    'value' =>  2 
                ),
                array(
                    'label' => Mage::helper('ymlexport')->__('ticket'),
                    'value' =>  3
                ),
                array(
                    'label' => Mage::helper('ymlexport')->__('event-ticket'),
                    'value' =>  4
                ),
                array(
                    'label' => Mage::helper('ymlexport')->__('simple'),
                    'value' =>  5 
                ),
            );
        }
        return $this->_options;
    }
}
