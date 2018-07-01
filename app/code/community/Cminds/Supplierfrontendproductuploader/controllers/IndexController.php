<?php

class Cminds_Supplierfrontendproductuploader_IndexController extends Cminds_Supplierfrontendproductuploader_Controller_Action
{
    public function preDispatch()
    {
        parent::preDispatch();

        $this->_getHelper()->validateModule();
        
        $hasAccess = $this->_getHelper()->hasAccess();

        if (!$hasAccess) {
            $this->getResponse()->setRedirect($this->_getHelper()->getSupplierLoginPage());
        }
    }

    public function indexAction()
    {
        $this->_renderBlocks();
    }

    public function termsAction()
    {
        $this->_renderBlocks();
    }

    public function agreeTermsAction()
    {
        $loggedUser = Mage::getSingleton(
            'customer/session',
            array('name' => 'frontend')
        );

        if ($this->getRequest()->getParam('terms')) {
            $vendor = $loggedUser->getCustomer();
            $vendor->setData('terms_conditions_agreed', 1);
            $vendor->getResource()->saveAttribute($vendor, 'terms_conditions_agreed');
            $this->getResponse()->setRedirect(
                Mage::getUrl('supplier')
            );
        }

        return $this;
    }
}
