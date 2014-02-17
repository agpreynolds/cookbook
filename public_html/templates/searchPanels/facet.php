<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); ?>

<label for="<?php echo $facet->id; ?>"><?php echo $facet->label; ?></label>

<input type="radio" name="<?php echo $facet->id ?>_type" value="all" 
	<?php echo ( $facet->default_search_type == 'all') ? 'checked' : ''; ?>
/>All of

<input type="radio" name="<?php echo $facet->id ?>_type" value="one"
	<?php echo ( $facet->default_search_type == 'one') ? 'checked' : ''; ?>
/>One of

<select name="<?php echo $facet->id; ?>[]" class="searchFacet" multiple>
<?php echo $this->outputFacetOptions($facet->options); ?>			
</select>