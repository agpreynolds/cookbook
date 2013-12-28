<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); ?>
<li id="<?php echo $facet->id; ?>" class="searchFacet">
	<a class="facetLink"><?php echo $facet->label; ?></a>
	<ul class="facetOptions">
		<?php echo $this->outputFacetOptions($facet->options); ?>			
	</ul>
</li>