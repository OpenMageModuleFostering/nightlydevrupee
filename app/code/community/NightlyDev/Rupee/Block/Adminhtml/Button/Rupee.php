<?php
class NightlyDev_Rupee_Block_Adminhtml_Button_Rupee
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
		protected $entity;
    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        Mage::getDesign()->setTheme('template', 'nightlydev');
        $this->setTemplate('rupee/adminhtml/button/convert.phtml');
    }
    
    /**
     * Generate synchronize button html
     *
     * @return string
     */
    public function getButtonHtml()
    {
    	$button = $this->getLayout()->createBlock('adminhtml/widget_button')
    	->setData(array(
    			'id'        => 'nightlydevrupee_convert',
    			'label'     => $this->helper('adminhtml')->__('Convert Indian Rupee Symbol to: '.Mage::helper('nightlydevrupee')->getToSymbol()),
    			'onclick'   => 'javascript:convert_rupee(); return false;'
    	));
    
    	return $button->toHtml();
    }
    
    /**
     * Remove scope label
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return element html
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }

    /**
     * Return ajax url for synchronize button
     *
     * @return string
     */
    public function getConvertRupeeUrl()
    {
        return Mage::getSingleton('adminhtml/url')->getUrl('*/nightlydevrupee/convertrupee');
    }
}
