<?php
/**
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2011 Lucid Dreams (http://lucid-dreams.pl)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Marcin Roszak <magento@lucid-dreams.pl>
 */
require_once "app/code/core/Mage/Checkout/controllers/CartController.php";

class LD_AjaxCart_CartController extends Mage_Checkout_CartController {

    public function baseurlAction() {
        echo Mage::getBaseUrl();
    }

    public function updateAction() {

        $layout = Mage::getSingleton('core/layout');
        $block = $layout->createBlock('Mage_Checkout_Block_Cart_Sidebar');
        $block->setTemplate('checkout/cart/sidebar.phtml');
        echo $block->renderView();
    }

    public function addAction() {
        $cart = $this->_getCart();
        $params = $this->getRequest()->getParams();
        try {
            if (isset($params['qty'])) {
                $filter = new Zend_Filter_LocalizedToNormalized(
                                array('locale' => Mage::app()->getLocale()->getLocaleCode())
                );
                $params['qty'] = $filter->filter($params['qty']);
            }

            $product = $this->_initProduct();
            $related = $this->getRequest()->getParam('related_product');

            if (!$product) {
                return;
            }

            $cart->addProduct($product, $params);
            if (!empty($related)) {
                $cart->addProductsByIds(explode(',', $related));
            }

            $cart->save();

            $this->_getSession()->setCartWasUpdated(true);

            Mage::dispatchEvent('checkout_cart_add_product_complete',
                            array('product' => $product, 'request' => $this->getRequest(), 'response' => $this->getResponse())
            );

            if (!$this->_getSession()->getNoCartRedirect(true)) {
                if (!$cart->getQuote()->getHasError()) {

                }
            }
        } catch (Mage_Core_Exception $e) {

        } catch (Exception $e) {
            Mage::logException($e);
        }
    }

}
