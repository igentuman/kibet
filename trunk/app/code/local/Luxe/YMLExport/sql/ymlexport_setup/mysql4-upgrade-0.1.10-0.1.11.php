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


$installer = $this;
/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */

$sort_order = 0;
$attributs = Luxe_YMLExport_Model_Offers_Simple::getUsedAttributes();
$attributs['yml_description']['sort_order'] = count($attributs);
$installer->addAttribute('catalog_product', 'yml_name', $attributs['yml_name']);
