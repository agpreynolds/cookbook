<li id="<?php echo $facet->id; ?>" class="searchFacet">
	<a class="facetLink"><?php echo $facet->label; ?></a>
	<ul class="facetOptions">
		<?php echo $this->outputFacetOptions($facet->options); ?>			
	</ul>
</li>