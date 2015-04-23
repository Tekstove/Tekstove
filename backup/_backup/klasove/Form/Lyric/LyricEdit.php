<?php

namespace Form\Lyric;

use Zend\Form\Form,
	Zend\Form\Element,
	Zend\Validator

;

class LyricEdit extends \Form\Lyric\Lyric {

	public function init() {

                throw new \Exception('towa e preraboteno');
            
		parent::init();

		$censored = new Element\Checkbox('censored');
		$censored->setLabel('censored');

		$delete = new Element\Checkbox('delete');
		$deleteToggleDecorator = new \Tekstove\Form\Decorator\Toggle();
		$deleteToggleDecorator->setOption('elementCssSelector', '#lyric-code-wrapper');
		$delete->setLabel('изтрии')
				->addDecorator($deleteToggleDecorator)
				->setOrder(4000);
		;

		$code = new Element\Captcha('code', array(
					'captcha' => new \Zend\Captcha\Figlet(array(
						'Wordlen' => 4,
							)
						))
		);

		$deleteCodeDecorator = new \Tekstove\Form\Decorator\Wrapper();
		$deleteCodeDecorator->setOption('style', 'display:none;');

		$code->setLabel('въведи кода')
				->addDecorator($deleteCodeDecorator)
				->setOrder(5000);
		;

		$this->addElements(array($censored, $delete, $code));

		$this->getDisplayGroup('dgBottom')->addElements(array($censored, $delete, $code));
		
		/*
		 * GSP, fix rendering elements more than once
		 * http://framework.zend.com/issues/browse/ZF2-180
		 */
		foreach ($this->getDisplayGroup('dgBottom')->getElements() as $e) {
			if (array_key_exists($e->getName(), $this->_order)) {
				unset ($this->_order[$e->getName()]);
			}
		}
		
	}

//	public function isValid($data) {
//
//		$this->populate($data);
//
//		if ($this->getElement('delete')->getValue() == 1) {
//			
//		} else {
//			$code = $this->getElement('code');
//			$this->removeElement('code');
//			$valid = parent::isValid($data);
//			$this->addElement($code);
//			return $valid;
//		}
//
//		return parent::isValid($data);
//	}

}