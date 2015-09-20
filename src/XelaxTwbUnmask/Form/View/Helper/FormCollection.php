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

use TwbBundle\Form\View\Helper\TwbBundleFormCollection;

/**
 * Description of FormCollection
 *
 * @author schurix
 */
class FormCollection extends TwbBundleFormCollection{
	
	public function __construct() {
		$this->setDefaultElementHelper('twbFormRow');
	}
	
	public function render(\Zend\Form\ElementInterface $oElement) {
        if ($oElement->getOption('value_only') === true && $oElement instanceof \IteratorAggregate) {
            foreach ($oElement->getIterator() as $oElementOrFieldset) {
				$oElementOrFieldset->setOption('value_only', true);
			}
		}
		
		return parent::render($oElement);
	}
}
