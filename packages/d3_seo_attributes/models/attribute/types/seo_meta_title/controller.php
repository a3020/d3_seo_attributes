<?php  defined('C5_EXECUTE') or die("Access Denied.");
class SeoMetaTitleAttributeTypeController extends TextAttributeTypeController  {

	public function form() {
		if (is_object($this->attributeValue)) {
			$value = Loader::helper('text')->entities($this->getAttributeValue()->getValue());
		}
		print Loader::helper('form')->text($this->field('value'), $value, array('maxlength' => 80));
	}
}
