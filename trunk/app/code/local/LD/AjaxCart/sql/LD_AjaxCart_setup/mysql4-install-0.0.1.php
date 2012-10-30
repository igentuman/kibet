<?php
/**
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2011 Lucid Dreams (http://lucid-dreams.pl)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Marcin Roszak <magento@lucid-dreams.pl>
 */

$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$setup->addAttribute('catalog_category','ajaxcart',array(
    'backend_type'     => 'int',
    'type'     => 'int',
    'visible'  => true,
    'label'    => 'AjaxCart',
    'required' => true,
    'default'  => 1,
    'source'   => 'eav/entity_attribute_source_boolean',
    'input'    => 'select',
));
$installer->endSetup();
