<?php

namespace Tekstove\Form\Decorator;

class Toggle extends \Zend\Form\Decorator\AbstractDecorator {

	public function render($content) {
		
		$selector = $this->getOption('elementCssSelector');
		
		if (empty($selector)) {
			throw new \Exception('Tekstove\Form\Decorator\Toggle element cant be empty');
		}
		
		$selector = addslashes($selector);
		$thisElementId = $this->getElement()->getId();
		
		$output = <<<JS
			<script type="text/javascript">
				$('#{$thisElementId}').click(function(){
					if (this.checked) {
						$('{$selector}').slideDown();
					} else {
						$('{$selector}').slideUp();
					}
				});
				
			$(function (){
				if ($('#{$thisElementId}').prop('checked')) {
					$('{$selector}').slideDown();
				}
			});
				
			</script>
JS;

		return $content . $output;
	}

}