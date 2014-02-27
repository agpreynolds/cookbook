<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); ?>

<label for="<?php echo $facet->id; ?>"><?php echo $facet->label; ?></label>

<div class="searchFacetContainer">
	<select name="<?php echo $facet->id; ?>[]" class="searchFacet" multiple>
		<?php echo $this->outputFacetOptions($facet->options); ?>			
	</select>

	<select name="<?php echo $facet->id ?>_type" class="radio">
		<option value="all" <?php echo ( $facet->default_search_type == 'all') ? 'selected' : ''; ?> >All</option>
		<option value="one" <?php echo ( $facet->default_search_type == 'one') ? 'selected' : ''; ?> >One</option>
	</select>
</div>
