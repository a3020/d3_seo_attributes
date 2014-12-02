<?php defined('C5_EXECUTE') or die("Access Denied.");

class SeoMetaDescriptionAttributeTypeController extends TextareaAttributeTypeController  {	
	public function saveKey($data) {
		$this->setDisplayMode('text');
	}
	
	public function form($additionalClass = false) {
		$this->load();
		if (is_object($this->attributeValue)) {
			$value = $this->getAttributeValue()->getValue();
		}

		print Loader::helper('form')->textarea($this->field('value'), $value, array('class' => $additionalClass, 'rows' => 5));
	}
}
