<?php
class Mage_Mainpay_Block_Mainpaymodel_Form extends Mage_Payment_Block_Form {

		protected function _construct() {
				$this->setTemplate('mainpay/mainpaymodel/form.phtml');
				parent::_construct();
		}

}
