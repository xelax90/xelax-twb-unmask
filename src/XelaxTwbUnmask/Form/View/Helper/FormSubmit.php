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

use Zend\Form\View\Helper\FormSubmit as ZendFormSubmit;
use Zend\Form\ElementInterface;

/**
 * Description of FormSubmit
 *
 * @author schurix
 */
class FormSubmit extends ZendFormSubmit {
	public function render(ElementInterface $element)
    {
		$element->setAttribute('class', $element->getAttribute('class')." btn");
        $input = parent::render($element);
		$options = $element->getOptions();
		if(!empty($options['as-group'])){
			$col_left_width = 'sm-6';
			$col_right_width = 'sm-6';
			$button_column = 'left';
			
			if (!empty($options['col-left-width'])) {
				$col_left_width = $options['col-left-width'];
			}
			if (!empty($options['col-right-width'])) {
				$col_right_width = $options['col-right-width'];
			}
			if (!empty($options['button-column'])) {
				$button_column = $options['button-column'];
			}

			$colFormat = '<div class="col-%s">%s</div><div class="col-%s">%s</div>';
			$buttonFormat = '<div class="btn-group btn-group-justified"><div class="btn-group">%s</div></div>';
			$inputContainer = sprintf($buttonFormat, $input);
			$leftColumn = $inputContainer;
			$rightColumn = '';
			if($button_column != 'left'){
				$leftColumn = '';
				$rightColumn = $inputContainer;
			}
			$input = sprintf($colFormat, $col_left_width, $leftColumn, $col_right_width, $rightColumn);
		}
		return $input;
    }
}
