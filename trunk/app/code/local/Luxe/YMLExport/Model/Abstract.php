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
 * Abstract model for YML export
 *
 * @category   Luxe
 * @package    Luxe_YMLExport
 * @author     Luxe Team
 */
abstract class Luxe_YMLExport_Model_Abstract extends Mage_Core_Model_Abstract
{
    /**
     * Get collection instance
     *
     * @param  string $name
     * @return object
     */
    protected function _esc($str)
    {
        $str = htmlspecialchars($str, ENT_COMPAT, 'UTF-8');
        $str = str_replace("'", '&apos;', $str);
        if (strlen($str) > 255) {
            $str = substr($str, 0, 252).'...';
        }
        return $str;
    }
}