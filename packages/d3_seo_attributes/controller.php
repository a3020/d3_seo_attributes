<?php               
defined('C5_EXECUTE') or die("Access Denied.");

class D3SeoAttributesPackage extends Package {

	protected $pkgHandle = 'd3_seo_attributes';
	protected $appVersionRequired = '5.5';
	protected $pkgVersion = '0.9.2.2';
	
	public function getPackageDescription() {
		return t('Adds a character counter to the meta title and meta description fields');
	}
	
	public function getPackageName() {
		return t('SEO Attributes');
	}
	
	public function install(){
		$pkg = parent::install();
		
		$this->installEverything($pkg);
	}
	
	public function upgrade(){
		$pkg = parent::getByHandle($this->pkgHandle);
		
		$this->installEverything($pkg);
	}
	
	public function uninstall(){
		$db   = Loader::db();
		$ct = AttributeType::getByHandle('text');
		
		$ak = CollectionAttributeKey::getByHandle('meta_title');
		if($ak && $ct) {
			$db->query("update AttributeKeys set atID = ? WHERE akID = ?", array($ct->getAttributeTypeID(), $ak->getAttributeKeyID()));
		}
		
		$ct = AttributeType::getByHandle('textarea');
		
		$ak = CollectionAttributeKey::getByHandle('meta_description');
		if($ak && $ct) {
			$db->query("update AttributeKeys set atID = ? WHERE akID = ?", array($ct->getAttributeTypeID(), $ak->getAttributeKeyID()));
		}
		
		parent::uninstall();
	}
	
	public function installEverything($pkg){
        Loader::model('collection_attributes');
        Loader::model('attribute/categories/collection');
        
		$db   = Loader::db();
		$cakc = AttributeKeyCategory::getByHandle('collection');
		
		
		$ct = AttributeType::getByHandle('seo_meta_title');
		if(!$ct){
			$ct = AttributeType::add('seo_meta_title', t('SEO Meta Title'), $pkg);
			$cakc->associateAttributeKeyType($ct);
		}
		
		$ak = CollectionAttributeKey::getByHandle('meta_title');
		if($ak && $ct) {
			$db->query("update AttributeKeys set atID = ? WHERE akID = ?", array($ct->getAttributeTypeID(), $ak->getAttributeKeyID()));
		}
		
		
		$ct = AttributeType::getByHandle('seo_meta_description');
		if(!$ct){
			$ct = AttributeType::add('seo_meta_description', t('SEO Meta Description'), $pkg);
			$cakc->associateAttributeKeyType($ct);
		}
		
		$ak = CollectionAttributeKey::getByHandle('meta_description');
		if($ak && $ct){
			$db->query("update AttributeKeys set atID = ? WHERE akID = ?", array($ct->getAttributeTypeID(), $ak->getAttributeKeyID()));
		}
	}
}