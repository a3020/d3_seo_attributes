<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php
$iLengthRecommended = 160;
$akID = $this->attributeKey->getAttributeKeyID();
?>

<span class="counter-<?php echo $akID ?>" style="display: inline-block; margin-top: 5px;"></span>

<script type="text/javascript">
$('#akID\\[<?php echo $akID ?>\\]\\[value\\]').on("keyup focus", function() {
	var chars = this.value.length;
	var caption = "<?php echo t('Chars: ') ?>" + chars + "/<?php echo $iLengthRecommended ?>";
	
	$('.counter-<?php echo $akID ?>').html(caption);
}).trigger('keyup');
</script>