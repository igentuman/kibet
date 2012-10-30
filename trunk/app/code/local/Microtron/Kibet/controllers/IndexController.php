<?php

class Microtron_Kibet_IndexController extends Mage_Core_Controller_Front_Action {

  public function indexAction() {
    include('developer/class.krumo.php');
    $this->loadLayout();
    $block = $this->getLayout()->createBlock(
        'Mage_Core_Block_Template', 'kibet', array('template' => 'kibet/kibet.phtml')
    );
    $this->getLayout()->getBlock('content')->append($block);

    $this->renderLayout();
    
     krumo::dump($this);
  }

}
