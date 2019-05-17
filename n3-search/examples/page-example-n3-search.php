<?php
/**
 * The template for displaying page with slug "example-n3-search" using plugin N3_Search
 *
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'page' );

                /* ************************************************************************* */
global $N3_Search_Utils;
$results = $N3_Search_Utils->getModalidad();
?>
<article style="margin-top: 0;" class="entry">
	<div class="entry-content">
		<h3>Resultados para filtros:</h3>
	</div>
</article>
<article style="margin-top: 0;" class="entry">
	<div class="entry-content">
		<blockquote class="wp-block-quote">
<?php foreach ($results as $key => $description): ?>
		<p>
			<strong>ID: </strong><?= $key ?>,
        	<strong>Descripción: </strong><?= $description ?>
		</p>
<?php endforeach; ?>
		</blockquote>
		<hr>
	</div>
</article>
<?php

/* ************************************************************************* */

global $N3_Search;
$N3_Search->where([
	['id_regimen', 'PR'],
	['id_unidad_academica', 448],
]);
$N3_Search->limit(10);
$N3_Search->offset(10);
$N3_Search_Result = $N3_Search->execute();

?>
<article style="margin-top: 0;" class="entry">
	<div class="entry-content">
		<h3>Resultado de búsqueda</h3>
	</div>
</article>
<?php foreach ($N3_Search_Result as $result): ?>
	<article style="margin-top: 0;" class="entry">
		<div class="entry-content">

			<blockquote class="wp-block-quote">
				<p><strong>Titulo: </strong><?= $result['titulo'] ?></p>
            	<p><strong>Universidad: </strong><?= $result['universidad'] ?></p>
            	<p><strong>Unidad académica: </strong><?= $result['unidad_academica'] ?></p>
			</blockquote>

            <hr>
		</div>
	</article>
<?php endforeach; ?>
                <?php

                /* ************************************************************************* */

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
