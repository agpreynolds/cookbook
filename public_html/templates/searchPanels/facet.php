<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); ?>

<label for="<?php echo $facet->id; ?>"><?php echo $facet->label; ?></a>
<select name="<?php echo $facet->id; ?>[]" class="searchFacet" multiple>
<?php echo $this->outputFacetOptions($facet->options); ?>			
</select>