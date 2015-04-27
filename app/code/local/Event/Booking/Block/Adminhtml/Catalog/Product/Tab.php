<?php
class Event_Booking_Block_Adminhtml_Catalog_Product_Tab
extends Mage_Adminhtml_Block_Template
implements Mage_Adminhtml_Block_Widget_Tab_Interface {
 
    /**
     * Set the template for the block
     *
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('booking/catalog/product/tab.phtml');
    }
     
    /**
     * Retrieve the label used for the tab relating to this block
     *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Event Booking');
    }
     
    /**
     * Retrieve the title used by this tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Click here to view your custom tab content');
    }
     
    /**
     * Determines whether to display the tab
     * Add logic here to decide whether you want the tab to display
     *
     * @return bool
     */
    public function canShowTab()
    {
		  if(Mage::app()->getRequest()->getActionName() == 'edit'){
			$id = $this->getRequest()->getParam('id');
			$product = Mage::getModel('catalog/product')->load($id);
			$model = Mage::getModel('eav/entity_attribute_set');
			$attributeSetId = $product->getAttributeSetId();
			$prodAttributeSet = Mage::getModel('eav/entity_attribute_set')->load($attributeSetId)->getAttributeSetName();
			if($prodAttributeSet == 'Event'){
				return true;
			}
			else{
				return false;
			}
			
		}
		else{ 
			$id = $this->getRequest()->getParam('set');
			$product = Mage::getModel('catalog/product')->load($id);
			$model = Mage::getModel('eav/entity_attribute_set');
			$attributeSetId = $product->getAttributeSetId();
			$prodAttributeSet = Mage::getModel('eav/entity_attribute_set')->load($id)->getAttributeSetName();
			if($prodAttributeSet == 'Event'){
				return true;
			}
			else{
				return false;
			}
		 }  
	}
     
    /**
     * Stops the tab being hidden
     *
     * @return bool
     */
    public function isHidden()
    {
		return false;
    }
 
     
    /**
     * AJAX TAB's
     * If you want to use an AJAX tab, uncomment the following functions
     * Please note that you will need to setup a controller to recieve
     * the tab content request
     *
     */
    /**
     * Retrieve the class name of the tab
     * Return 'ajax' here if you want the tab to be loaded via Ajax
     *
     * return string
     */
#   public function getTabClass()
#   {
#       return 'my-custom-tab';
#   }
 
    /**
     * Determine whether to generate content on load or via AJAX
     * If true, the tab's content won't be loaded until the tab is clicked
     * You will need to setup a controller to handle the tab request
     *
     * @return bool
     */
#   public function getSkipGenerateContent()
#   {
#       return false;
#   }
 
    /**
     * Retrieve the URL used to load the tab content
     * Return the URL here used to load the content by Ajax
     * see self::getSkipGenerateContent & self::getTabClass
     *
     * @return string
     */
#   public function getTabUrl()
#   {
#       return null;
#   }
 
}
