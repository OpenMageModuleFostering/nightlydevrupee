<?php
class NightlyDev_Rupee_NightlydevrupeeController extends Mage_Adminhtml_Controller_Action
{
  public function convertrupeeAction() {
    if (!$this->getRequest()->isAjax()) {
        $this->_forward('noRoute');
        return;
    }
    $this->getResponse()->setBody(
      Mage::helper('nightlydevrupee')->convertToSymbol()
    );
  }
}