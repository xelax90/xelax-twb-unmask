<?php
namespace XelaxTwbUnmask;

return array(
    'view_helpers' => array(
        'invokables' => array(
			//----------- Rename twb helpers -----------
            //Form
            'twbForm' => 'XelaxTwbUnmask\Form\View\Helper\Form', // needed to overwrite getXXXHelper functions
            //'twbForm' => 'TwbBundle\Form\View\Helper\TwbBundleForm',
            'twbFormButton' => 'TwbBundle\Form\View\Helper\TwbBundleFormButton',
            'twbFormSubmit' => 'TwbBundle\Form\View\Helper\TwbBundleFormButton',
            'twbFormCheckbox' => 'TwbBundle\Form\View\Helper\TwbBundleFormCheckbox',
            'twbFormCollection' => 'XelaxTwbUnmask\Form\View\Helper\FormCollection', // needed to overwrite getXXXHelper functions
            //'twbFormCollection' => 'TwbBundle\Form\View\Helper\TwbBundleFormCollection',
            'twbFormElementErrors' => 'TwbBundle\Form\View\Helper\TwbBundleFormElementErrors',
            'twbFormMultiCheckbox' => 'TwbBundle\Form\View\Helper\TwbBundleFormMultiCheckbox',
            'twbFormRadio' => 'TwbBundle\Form\View\Helper\TwbBundleFormRadio',
            'twbFormRow' => 'XelaxTwbUnmask\Form\View\Helper\FormRow', // needed to overwrite getXXXHelper functions
            //'twbFormRow' => 'TwbBundle\Form\View\Helper\TwbBundleFormRow',
			//----------- Restore ZF2 hepers -----------
            //Form
            'form' => 'Zend\Form\View\Helper\Form',
            'formButton' => 'Zend\Form\View\Helper\FormButton',
            'formSubmit' => 'Zend\Form\View\Helper\FormSubmit',
            'formCheckbox' => 'Zend\Form\View\Helper\FormCheckbox',
            'formCollection' => 'Zend\Form\View\Helper\FormCollection',
            'formElement' => 'Zend\Form\View\Helper\FormElement',
            'formElementErrors' => 'Zend\Form\View\Helper\FormElementErrors',
            'formMultiCheckbox' => 'Zend\Form\View\Helper\FormMultiCheckbox',
            'formRadio' => 'Zend\Form\View\Helper\FormRadio',
            'formRow' => 'Zend\Form\View\Helper\FormRow',
        ),
		'factories' => array (
			//----------- Rename twb factory -----------
			'twbFormElement' => function($sm){
				$options = $sm->getServiceLocator()->get('TwbBundle\Options\ModuleOptions');
				return new \XelaxTwbUnmask\Form\View\Helper\FormElement($options);
			},
			//'twbFormElement' => 'TwbBundle\Form\View\Helper\Factory\TwbBundleFormElementFactory',
			//----------- Create custom factory as replacement -----------
			'formElement' => function($sm){
				return new \Zend\Form\View\Helper\FormElement();
			},
		),
    ),
);