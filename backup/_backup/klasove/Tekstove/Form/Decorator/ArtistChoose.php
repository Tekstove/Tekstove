<?php

namespace Tekstove\Form\Decorator;

/**
 * Description of ArtistChoose
 *
 * @author po_taka
 */
class ArtistChoose extends \Zend\Form\Decorator\AbstractDecorator {

	public function render($content) {

		$thisElementId = $this->getElementId();

		$output = <<<JS
			<div id="{$thisElementId}-ajax-results"></div>
			<script type="text/javascript">
				$('#{$thisElementId}').keyup(function(){
					artistAjaxChoose(this);
					
				});
				
			</script>
JS;

		return $content . $output;
	}

	public function getElementId() {
		if ($this->getOption('elementId')) {
			$elementId = $this->getOption('a');
		} else {
			$elementId = $this->getElement()->getId();
		}
		return $elementId;
	}

}