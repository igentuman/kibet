<?php

class Mage_Mainpay_MainpaymodelController extends Mage_Core_Controller_Front_Action {

    protected $_order;

    public function getSession() {
        return Mage::getSingleton('checkout/session');
    }

    public function getMainpay() {
        return Mage::getSingleton('mainpay/mainpaymodel');
    }
    
    protected function _expireAjax()
    {
        if (!Mage::getSingleton('checkout/session')->getQuote()->hasItems()) {
            $this->getResponse()->setHeader('HTTP/1.1','403 Session Expired');
            exit;
        }
    }

    public function getOrder() {
        if ($this->_order == null) {
            $session = $this->getSession();
            $this->_order = Mage::getModel('sales/order');
            $this->_order->loadByIncrementId($session->getLastRealOrderId());
        }
        return $this->_order;
    }

    /**
     * Redirect customer to Mainpay payment interface
     */
    public function redirectAction() {
        $this->getResponse()->setHeader('Content-type', 'text/html; charset=utf8')
        ->setBody($this->getLayout()->createBlock('mainpay/mainpaymodel_redirect')->toHtml());
    }

    /**
     * Validate data from Mainpay server and update the database
     */
    public function notificationAction() {
        if (!$this->getRequest()->isPost()) {
            $this->norouteAction();
            return;
        }
        $this->getMainpay()->processNotification($this->getRequest()->getPost());
    }
    
    /**
     * What to do when customer succesfully returns (order is payed)
     */
/*
    public function successAction()
    {
        $session = $this->getSession();
        $session->setQuoteId($_GET['comment']);
        $session->getQuote()->setIsActive(false)->save();
        $session->setLastRealOrderId($order_id);

        $this->_redirect('checkout/onepage/success', array('_secure'=>true));
    }

    public function cancelAction()
    {
        $session = $this->getSession();
        $session->setLastRealOrderId($_GET['comment']);

        // cancel order
        if ($session->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($session->getLastRealOrderId());
            if ($order->getId()) {
                $order->cancel()->save();
            }
        }

        $this->_redirect('checkout/cart');
    }
 * 
 */
}
