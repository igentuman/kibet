<?php

class Mage_Mainpay_Model_Mainpaymodel extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'mainpay_mainpaymodel';
    protected $_formBlockType = 'mainpay/mainpaymodel_form';

    public function getCheckout() {
                    return Mage::getSingleton('checkout/session');
    }

    public function getQuote() {
                    return $this->getCheckout()->getQuote();
    }

    public function getOrder()
    {
        $order_id = $this->getCheckout()->getLastRealOrderId();
        if (!$order_id){
            echo 'Session expired';
            exit;
        } else {
            return Mage::getModel('sales/order')->loadByIncrementId($order_id);
        }
    }

    public function getOrderPlaceRedirectUrl() {
        return Mage::getUrl('mainpay/mainpaymodel/redirect', array('_secure' => true));
    }

    public function getMainpayUrl() {
        $url = 'https://partner.mainpay.ru/a1lite/input';
        return $url;
    }

    public function createFormBlock($name) {
        $block = $this->getLayout()->createBlock('mainpay/mainpaymodel_form', $name)
            ->setMethod('mainpay_mainpaymodel')
            ->setPayment($this->getPayment())
            ->setTemplate('mainpay/mainpaymodel/form.phtml');

        return $block;
    }

    public function getMainpayCheckoutFormFields(){
        $order_id = $this->getCheckout()->getLastOrderId();
        /** Amount retriving */
        $currency_code = $this->getOrder()->getOrderCurrencyCode();
        $amount = $this->getOrder()->getGrandTotal();
        if ($currency_code != 'RUB'){
            $amount = Mage::helper('directory')->currencyConvert($amount, $currency_code, 'RUB');
        }

        $name = Mage::helper('mainpay')->__('Payment for order ').$order_id.Mage::helper('mainpay')->__(' at online store ').$_SERVER["SERVER_NAME"];

        $fields = array (
            'key'           => Mage::getStoreConfig('payment/mainpay_mainpaymodel/key'),
            'cost'          => sprintf('%.2f', $amount),
            'name'          => $name,
            'default_email' => '',
            'order_id'      => 0,
            'comment'       => $order_id,
        );
        
        return $fields;
    }

    protected function _getEncriptedConfig($path)
    {
        return Mage::helper('core')->decrypt(Mage::getStoreConfig($path));
    }

    public function processNotification(){
        $parameters = array (
            $_POST["tid"],
            urldecode($_POST["name"]),
            $_POST["comment"],
            $_POST["partner_id"],
            $_POST["service_id"],
            $_POST["order_id"],
            $_POST["type"],
            $_POST["partner_income"],
            $_POST["system_income"],
            $_POST["test"],
            $this->_getEncriptedConfig('payment/mainpay_mainpaymodel/secret_key'),
//            Mage::getStoreConfig('payment/mainpay_mainpaymodel/secret_key'),
        );

        $given_check = $_POST["check"];
        $generated_check = md5(join('',$parameters));
        $order_id = $parameters[2];
        $order = Mage::getModel('sales/order')->loadByIncrementId($order_id);
        $amount = sprintf('%.2f', $order->getGrandTotal());
        /** Check verification */
        if ($given_check != $generated_check){
            $order->addStatusToHistory(
                $order->getStatus(),
                Mage::helper('mainpay')->__('Security check failed!')
            )->save();
        /** Verify amount */
        } elseif ($amount != $parameters[8]){
            $order->addStatusToHistory(
                $order->getStatus(),
                Mage::helper('mainpay')->__('Order total amount does not match mainpay gross total amount')
            );
            $order->save();
        /** Payment succesful*/
        } else {
            $newOrderStatus = $this->getConfigData('order_status', $order->getStoreId());
            if (empty($newOrderStatus)) {
                $newOrderStatus = $order->getStatus();
            }
            if (!$order->canInvoice()) {
                $order->addStatusToHistory(
                     $order->getStatus(),
                     Mage::helper('mainpay')->__('Error in creating an invoice', true),
                     $notified = true
                );
            } else {
                $order->getPayment()->setTransactionId($parameters[0]);
                $invoice = $order->prepareInvoice();
                $invoice->register()->pay();
                Mage::getModel('core/resource_transaction')
                    ->addObject($invoice)
                    ->addObject($invoice->getOrder())
                    ->save();
                $order->setState(
                    Mage_Sales_Model_Order::STATE_COMPLETE, $newOrderStatus,
                    Mage::helper('mainpay')->__('Invoice #%s created', $invoice->getIncrementId()),
                    $notified = true
                );
            }
            $order->save();
            $order->sendNewOrderEmail();
        }
    }
    
    public function isInitializeNeeded() {
        return true;
    }

    public function initialize($paymentAction, $stateObject) {
        $state = Mage_Sales_Model_Order::STATE_PENDING_PAYMENT;
        $stateObject->setState($state);
        $stateObject->setStatus(Mage::getSingleton('sales/order_config')->getStateDefaultStatus($state));
        $stateObject->setIsNotified(false);
        return $this;
    }
}