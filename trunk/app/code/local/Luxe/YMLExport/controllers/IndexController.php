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

class Luxe_YMLExport_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $catalog = Mage::getModel('ymlexport/catalog');
        if (!$catalog->isActive()) {
            exit();
        }
        if ($catalog->isUseAuth()) {
            if (!$catalog->getAuthLogin() || !$catalog->getAuthPassword()) {
                exit();
            } else {
                if (!isset($_SERVER['PHP_AUTH_USER'])) {
                    $this->getResponse()->setHeader('WWW-Authenticate', 'Basic realm="'.$this->__('YML description').'"');
                    $this->getResponse()->setHeader('HTTP/1.0', '401 Unauthorized');
                    $this->getResponse()->appendBody(Mage::helper('adminhtml')->__('You should be authorize in order to download YML description'));
                    $this->getResponse()->sendResponse();
                    exit;
                } else {
                    if ($_SERVER['PHP_AUTH_USER'] != $catalog->getAuthLogin() || $_SERVER['PHP_AUTH_PW'] != $catalog->getAuthPassword()) {
                        $this->getResponse()->setHeader('HTTP/1.1', '403 Forbidden');
                        $this->getResponse()->sendResponse();
                        exit;
                    }
                }
            }
        }
        if ($catalog->isUseGzip()) {
            $this->getResponse()->setHeader('Content-Type', 'application/x-gzip');
            $this->getResponse()->setHeader('Content-Disposition', 'attachment; filename="yml_description.xml.gz"');
            $this->getResponse()->appendBody(gzencode($catalog->getDescription()));
        } else {
            $this->getResponse()->setHeader('Content-Type', 'application/xml');
            $this->getResponse()->setHeader('Content-Disposition', 'attachment; filename="yml_description.xml"');
            $this->getResponse()->appendBody($catalog->getDescription());
        }
        $this->getResponse()->sendResponse();
        exit();
    }
}
