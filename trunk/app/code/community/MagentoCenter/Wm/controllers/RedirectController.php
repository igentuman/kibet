<?php


class MagentoCenter_Wm_RedirectController extends Mage_Core_Controller_Front_Action {

    protected $_order;

    protected function _expireAjax() {
        if (!Mage::getSingleton('checkout/session')->getQuote()->hasItems()) {
            $this->getResponse()->setHeader('HTTP/1.1','403 Session Expired');
            exit;
        }
    }

    public function indexAction() {
        $this->getResponse()
                ->setHeader('Content-type', 'text/html; charset=utf8')
                ->setBody($this->getLayout()
                ->createBlock('wm/redirect')
                ->toHtml());
    }

    public function successAction() {
        if($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            $session = Mage::getSingleton('checkout/session');
            $session->setQuoteId($post['LMI_PAYMENT_NO']);
            Mage::getSingleton('checkout/session')->getQuote()->setIsActive(false)->save();
            $this->_redirect('checkout/onepage/success', array('_secure'=>true));
        }
        
    }

}

?>
