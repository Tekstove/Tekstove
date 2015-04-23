<?php

namespace Tekstove\Form\Decorator;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wrapper
 *
 * @author potaka
 */
class Wrapper extends \Zend\Form\Decorator\AbstractDecorator {

	public function render($content) {

		$id = $this->getElement()->getId() . '-wrapper';
		$style = $this->getOption('style');
		if ($style) {
			$style = ' style="' . $style .'" ';
		}
		
		$prepend = '<dd id ="' . $id . '" ' . $style . '><dl>';
		$append = '</dl></dd>';

		return  $prepend . $content . $append;
	}

}