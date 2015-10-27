<?php

/*
 * Copyright (C) 2015 schurix
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace XelaxTwbUnmask\Form\View\Helper;

use TwbBundle\Form\View\Helper\TwbBundleForm;
use TwbBundle\Form\View\Helper\TwbBundleFormCollection;
use Zend\Form\FormInterface;
use Zend\Form\FieldsetInterface;

/**
 * Description of Form
 *
 * @author schurix
 */
class Form extends TwbBundleForm{
	// print values only without inputs
    const LAYOUT_VALUES = 'values';
    const LAYOUT_VALUES_HIDDEN = 'values_hidden';
	
	protected $collectionHelper;
	
	protected $rowHelper;
	
	public function getCollectionHelper(){
        if ($this->collectionHelper) {
            return $this->collectionHelper;
        }
		$oRenderer = $this->getView();

        if (method_exists($oRenderer, 'plugin')) {
            $this->collectionHelper = $this->view->plugin('twb_form_collection');
        }

        if (!$this->collectionHelper instanceof TwbBundleFormCollection) {
            $this->collectionHelper = new TwbBundleFormCollection();
        }

        return $this->collectionHelper;
	}
	
	public function getRowHelper(){
        if ($this->rowHelper) {
            return $this->rowHelper;
        }
		
		$oRenderer = $this->getView();
        if (method_exists($oRenderer, 'plugin')) {
            $this->rowHelper = $this->view->plugin('twb_form_row');
        }

        if (!$this->rowHelper instanceof FormRow) {
            $this->rowHelper = new FormRow();
        }

        return $this->rowHelper;
	}
	
    /**
     * Render a form from the provided $oForm. Needed to be overwritten completely due to missing getter calls
     * @see TwbBundleForm::render()
     * @param FormInterface $oForm
     * @param string $sFormLayout
     * @return string
     */
    public function render(FormInterface $oForm, $sFormLayout = parent::LAYOUT_HORIZONTAL)
    {
        //Prepare form if needed
        if (method_exists($oForm, 'prepare')) {
            $oForm->prepare();
        }
		
		$sFormClass = $sFormLayout;
		if($sFormLayout === self::LAYOUT_VALUES || $sFormLayout === self::LAYOUT_VALUES_HIDDEN){
			$sFormLayout = parent::LAYOUT_HORIZONTAL;
		}
        $this->setFormClass($oForm, $sFormLayout);

        //Set form role
        if (!$oForm->getAttribute('role')) {
            $oForm->setAttribute('role', 'form');
        }

        $bHasColumnSizes = false;
        $sFormContent = '';
		//----- EDIT
        //$oRenderer = $this->getView();
		$collectionHelper = $this->getCollectionHelper();
		$rowHelper = $this->getRowHelper();
		//----- END
        foreach ($oForm as $oElement) {
            $aOptions = $oElement->getOptions();
            if (!$bHasColumnSizes && !empty($aOptions['column-size'])) {
                $bHasColumnSizes = true;
            }
            //Define layout option to form elements if not already defined
            if ($sFormLayout && empty($aOptions['twb-layout'])) {
                $aOptions['twb-layout'] = $sFormLayout;
                $oElement->setOptions($aOptions);
            }
			if($sFormClass === self::LAYOUT_VALUES || $sFormClass === self::LAYOUT_VALUES_HIDDEN){
				if($sFormClass === self::LAYOUT_VALUES || !($oElement instanceof \Zend\Form\Element\Button || $oElement instanceof \Zend\Form\Element\Submit)){
					// render buttons in LAYOUT_VALUES_HIDDEN, but not in LAYOUT_VALUES
					$oElement->setOption('value_only', true);
					if($sFormClass === self::LAYOUT_VALUES_HIDDEN){
						$oElement->setOption('add_hidden', true);
					}
					if($oElement instanceof \Zend\Form\Element\Checkbox){
						$oElement->setAttribute('type', 'text');
					}
				}
			}
			//------- EDIT
            //$sFormContent .= $oElement instanceof FieldsetInterface ? $oRenderer->formCollection($oElement) : $oRenderer->formRow($oElement);
            $sFormContent .= $oElement instanceof FieldsetInterface ? $collectionHelper($oElement) : $rowHelper($oElement);
			//------- END
        }
        if ($bHasColumnSizes && $sFormLayout !== self::LAYOUT_HORIZONTAL) {
            $sFormContent = sprintf(self::$formRowFormat, $sFormContent);
        }
        return $this->openTag($oForm) . $sFormContent . $this->closeTag();
    }
	
	
}
