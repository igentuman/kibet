<?php

class MagentoCenter_Wm_Model_Checkout extends Mage_Payment_Model_Method_Abstract {

    protected $_code          = 'wm';
    protected $_formBlockType = 'wm/form';
    protected $_infoBlockType = 'wm/info';


    public function getCheckout() {
        return Mage::getSingleton('checkout/session');
    }

    public function getOrderPlaceRedirectUrl() {
        return Mage::getUrl('wm/redirect', array('_secure' => true));
    }

    public function getWebmoneyUrl() {
        $url = 'https://merchant.webmoney.ru/lmi/payment.asp';
        return $url;
    }

    public function getQuote() {

        $orderIncrementId = $this->getCheckout()->getLastRealOrderId();
        $order = Mage::getModel('sales/order')->loadByIncrementId($orderIncrementId);		        
        return $order;
    }
//        $orderIncrementId = $this->getCheckout()->getLastRealOrderId();
//        $order = Mage::getModel('sales/order')->loadByIncrementId($orderIncrementId);
//        echo $order->getBaseCurrencyCode();
//        echo Mage::getUrl('okpay/redirect', array('_secure' => true));

//
//        $order_id = $order->getRealOrderId();
//        $billing  = $order->getBillingAddress();
//        echo $order_id;
////        echo $billing;
//        $order_id = $this->getCheckout()->getLastRealOrderId();
//        $order = Mage::getModel('sales/order')->loadByIncrementId($order_id);
//#
//        $currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
//        $storeCurrency = Mage::getSingleton('directory/currency')
//                ->load($this->getQuote()->getStoreCurrencyCode());
//        $bConvert = $currency_code != $this->getQuote()->getBaseCurrencyCode();
//#
//        echo $amount = $storeCurrency->convert(round($order->getGrandTotal(), 2), $currency_code);
//
//
    public function getWebmoneyCheckoutFormFields() {

//        try {
//
//
//            if ($this->getQuote()->getIsVirtual()) {
//                $a = $this->getQuote()->getBillingAddress();
//                $b = $this->getQuote()->getShippingAddress();
//            } else {
//                $a = $this->getQuote()->getShippingAddress();
//                $b = $this->getQuote()->getBillingAddress();
//            }
//
//            $currency_code = $this->getQuote()->getBaseCurrencyCode();
//
//
//            $forms_values = array(
//                    'LMI_PAYMENT_NO' => $this->getCheckout()->getLastRealOrderId(),
//                    'LMI_PAYEE_PURSE' => Mage::getStoreConfig('payment/wm/wm_wmr')
//            );
//
//            $amount = ($a->getBaseGrandTotal()+$b->getBaseGrandTotal())-($a->getBaseDiscountAmount()+$b->getBaseDiscountAmount());
//            die($currency_code);
//            if ($currency_code != 'RUB') {
//                $storeCurrency = Mage::getSingleton('directory/currency')
//                        ->load($this->getQuote()->getStoreCurrencyCode());
//
//                $amount = $storeCurrency->convert($amount, 'RUB');
//            }
//
//
//
//
//            $forms_values = array_merge($forms_values, array(
//                    'LMI_PAYMENT_AMOUNT' => sprintf('%.2f', $amount),
//            ));
//
//            $forms_values = array_merge($forms_values, array(
//                    'LMI_PAYMENT_DESC_BASE64'	=> base64_encode(Mage::helper('wm')->__('Payment for order #').$this->getCheckout()->getLastRealOrderId()),
//            ));
//
//            $sReq = '';
//            $rArr = array();
//            foreach ($forms_values as $k=>$v) {
//                $value =  str_replace("&","and",$v);
//                $rArr[$k] =  $value;
//                $sReq .= '&'.$k.'='.$value;
//            }
//
//            if ($sReq) {
//                $sReq = substr($sReq, 1);
//            }
//
//            #truncate cart
////            $cart = Mage::getSingleton('checkout/cart');
//            $cart->truncate();
//            $cart->save();
//
//            return $rArr;
//        } catch (Exception $exc) {
//
//        }


        $order_id = $this->getCheckout()->getLastRealOrderId();
        $order    = Mage::getModel('sales/order')->loadByIncrementId($order_id);
        $amount   = trim(round($order->getGrandTotal(), 2));


//        echo $order_id;
//        echo Mage::getStoreConfig('payment/wm/wm_wmr');
//        echo base64_encode(Mage::helper('wm')->__('Payment for order #').$order_id);
//        echo $amount;
//        die();
        $params = array(
            'LMI_PAYMENT_NO'            => $order_id,
            'LMI_PAYEE_PURSE'           => Mage::getStoreConfig('payment/wm/wm_wallet'),
            'LMI_PAYMENT_DESC_BASE64'	=> base64_encode(Mage::helper('wm')->__('Payment for order #').$order_id),
            'LMI_PAYMENT_AMOUNT'        => $amount
        );
        return $params;


    }
}
