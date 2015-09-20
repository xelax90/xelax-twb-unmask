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

use TwbBundle\Form\View\Helper\TwbBundleFormElement;

/**
 * Description of FormElement
 *
 * @author schurix
 */
class FormElement extends TwbBundleFormElement{
	public function __construct(\TwbBundle\Options\ModuleOptions $options) {
		parent::__construct($options);
		$this->addClass('TwbBundle\Form\Element\StaticElement', 'formStatic');
		$this->addClass('TwbBundle\Form\Element\Button', 'twbFormButton');
		$this->addClass('Zend\Form\Element\Collection', 'twbFormCollection');
		$this->addType('checkbox', 'twbFormCheckbox');
		$this->addType('multi_checkbox', 'twbFormMultiCheckbox');
		$this->addType('radio', 'twbFormRadio');
		$this->addType('submit', 'twbFormSubmit');
	}
	
	public function render(\Zend\Form\ElementInterface $oElement) {
		if($oElement->getOption('value_only') === true){
			$sValue = $oElement->getValue();
			if($oElement instanceof \Zend\Form\Element\Select){
				if(isset($oElement->getValueOptions()[$sValue])){
					$sValue = $oElement->getValueOptions()[$sValue];
				}
			}
			if($oElement instanceof \Zend\Form\Element\Button || $oElement instanceof \Zend\Form\Element\Submit){
				return '';
			}
			return sprintf('<div class="%s">%s</div>', 'form-value-only', $sValue);
		}
		
		return parent::render($oElement);
	}
}