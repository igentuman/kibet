<?php
class Mage_Mainpay_Block_Mainpaymodel_Redirect extends Mage_Core_Block_Abstract {

    protected function _toHtml() {
        $mainpay = Mage::getModel('mainpay/mainpaymodel');

        $form = new Varien_Data_Form();
        $form   ->setAction($mainpay->getMainpayUrl())
                ->setId('mainpay_mainpaymodel_checkout')
                ->setName('mainpay_mainpaymodel_checkout')
                ->setMethod('POST')
                ->setUseContainer(true);

        foreach ($mainpay->getMainpayCheckoutFormFields() as $field=>$value) {
            $form->addField($field, 'hidden', array('name'=>$field, 'value'=>$value));
        }

        $html = '<html><body>';
        $html.= iconv('UTF-8', 'windows-1251', $this->__('You will be redirected to MainPay payment interface in a few seconds.'));
        $html.= $form->toHtml();
        $html.= '<script type="text/javascript">document.getElementById("mainpay_mainpaymodel_checkout").submit();</script>';
        $html.= '</body></html>';

        return $html;
    }

}