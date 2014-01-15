<li id="<?php echo $recipe->uri; ?>" class="searchResult <?php echo $class; ?>">
	<article>
		<header>
			<h4><?php echo $recipe->label; ?></h4>
		</header>
		<img class="fLeft" src="<?php echo $recipe->imagePath; ?>" height="64" width="64">
		<section class="thumbnailRating">
			<img src="#" height="20" width="80" alt="Rating">
			<p>4 / 5 (200 votes)</p>
		</section>
	</article>
</li>