<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); ?>

<label for="<?php echo $facet->id; ?>"><?php echo $facet->label; ?></label>

<div class="searchFacetContainer">
	<select name="<?php echo $facet->id; ?>[]" class="searchFacet" multiple>
		<?php echo $this->outputFacetOptions($facet->options); ?>			
	</select>

	<input type="hidden" name="<?php echo $facet->id ?>_type" value="<?php echo $facet->default_search_type; ?>"/>
	<p class="note"></p>
</div>
