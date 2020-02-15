<?php
/*
	Template Name: Home Page
*/
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package parfemlevne
 */

get_header();
?>
		<div class="fh5co-hero">
			<div class="fh5co-cover text-center">
				<div class="desc animate-box">
					<h2>Levné pneumatiky <br> a alu kola </h2>
					<span>Výběr nejprodávanějších a nejlevnějších <br> pneumatik a alu kol na internetu</span>
					<p><a class="btn btn-primary btn-lg btn-learn" href="<?= get_home_url();  ?>/produkty?cat=1537">Všechny produkty</a></p>
				</div>
			</div>
		</div>

		<div id="fh5co-blog-section">
			<div class="container">
				<div class="text-center he-banner">
					<div class="heureka-affiliate-category" data-trixam-positionid="24845" data-trixam-categoryid="972" data-trixam-categoryfilters="" data-trixam-codetype="iframe" data-trixam-linktarget="blank"></div>
					<div class="heureka-affiliate-category" data-trixam-positionid="24849" data-trixam-categoryid="1471" data-trixam-categoryfilters="" data-trixam-codetype="iframe" data-trixam-linktarget="blank"></div>
		  	</div>
				<div class="row">
					<div class="col-md-12 text-center heading-section animate-box">
						<h3>Nejprodávanější pneumatiky a alu kola</h3>
						<p>Představujeme výběr najpredávanejžších pneumatik a alu kol z našeho sortimentu</p>
					</div>
				</div>
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active "><a href="#all" class="btn-primary" aria-controls="all" role="tab" data-toggle="tab">Top produkty</a></li>
					<li role="presentation"><a href="#woman" class="btn-primary" aria-controls="woman" role="tab" data-toggle="tab">Top pneumatiky</a></li>
					<li role="presentation"><a href="#man" class="btn-primary" aria-controls="man" role="tab" data-toggle="tab">Top alu disky</a></li>
				</ul>
			</div>
			<div class="container">
				<div class="tab-content ">

					<?php
						$args = array(
								'post_type' => 'produkty',
								'post_status' => 'publish',
								'cat' => 2, // Whatever the category ID is for your aerial category
								'posts_per_page' => 12,
								'orderby' => 'ID', // Purely optional - just for some ordering
								'order' => 'ASC' // Ditto
						);
						$woman = new WP_Query( $args );
					?>

					<?php
						$args = array(
								'post_type' => 'produkty',
								'post_status' => 'publish',
								'cat' => 31, // Whatever the category ID is for your aerial category
								'posts_per_page' => 12,
								'orderby' => 'ID', // Purely optional - just for some ordering
								'order' => 'ASC' // Ditto
						);
						$man = new WP_Query( $args );
					?>

				  <div role="tabpanel" class="tab-pane fade in active" id="all">
						<div class="row row-bottom-padded-md">

							<?php for ($i=0; $i < 6; $i++): ?>

								<div class="col-lg-4 col-sm-6">
									<div class="fh5co-blog animate-box">
											<div class="blog-text" onclick="location.href='https://<?= the_field('url', $woman->posts[$i]->ID);  ?>'">
												<div class="prod-title">
														<div class="price-wrap">
															<span class="amount"><?= the_field('recenzie', $woman->posts[$i]->ID);  ?></span>
															<span class="price">od <?= the_field('cena', $woman->posts[$i]->ID);  ?> Kč </span>
														</div>
														<img class="img-responsive" src="<?php echo get_the_post_thumbnail_url($woman->posts[$i]->ID, 'full' );  ?>" alt="">
														<h3><?= get_the_title($woman->posts[$i]->ID) ?></h3>
														<a href="https://<?= the_field('url', $woman->posts[$i]->ID);  ?>" class="btn btn-primary">Více detailů</a>
													</div>
											</div>
									</div>
								</div>
								<div class="col-lg-4 col-sm-6">
									<div class="fh5co-blog animate-box">
											<div class="blog-text" onclick="location.href='https://<?= the_field('url', $man->posts[$i]->ID);  ?>'">
												<div class="prod-title">
														<div class="price-wrap">
															<span class="amount"><?= the_field('recenzie', $man->posts[$i]->ID);  ?></span>
															<span class="price">od <?= the_field('cena', $man->posts[$i]->ID);  ?> Kč </span>
														</div>
														<img class="img-responsive" src="<?php echo get_the_post_thumbnail_url($man->posts[$i]->ID, 'full' );  ?>" alt="">
														<h3><?= get_the_title($man->posts[$i]->ID)  ?></h3>
														<a href="https://<?= the_field('url', $man->posts[$i]->ID);  ?>" class="btn btn-primary">Více detailů</a>
													</div>
											</div>
									</div>
								</div>

							<?php endfor; ?>
						</div>
					</div>
				  <div role="tabpanel" class="tab-pane fade" id="man">
						<div class="row row-bottom-padded-md ">

							<?php while ( $man->have_posts() ):  ?>
								<?php
									$man-> the_post();
									$cat = get_the_category($value->ID);
									$parent = get_category_parents($cat[0]->term_id);
									$parent = explode('/', $parent);
									$parent = $parent[0];
								?>
								<div class="col-lg-4 col-sm-6">
									<div class="fh5co-blog animate-box">
											<div class="blog-text" onclick="location.href='https://<?= the_field('url');  ?>'">
												<div class="prod-title">
														<div class="price-wrap">
															<span class="amount"><?= the_field('recenzie');  ?> </span>
															<span class="price">od <?= the_field('cena');  ?> Kč </span>
														</div>
														<img class="img-responsive" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );  ?>" alt="">
														<h3><?= the_title();  ?></h3>
														<a href="https://<?= the_field('url');  ?>" class="btn btn-primary">Více detailů</a>
													</div>
											</div>
									</div>
								</div>
							<?php endwhile; ?>

							<?php
								wp_reset_query();
							?>

						</div>
					</div>
				  <div role="tabpanel" class="tab-pane fade" id="woman">
						<div class="row row-bottom-padded-md">
							<?php while ( $woman->have_posts() ):  ?>
								<?php
									$woman-> the_post();
									$cat = get_the_category($value->ID);
									$parent = get_category_parents($cat[0]->term_id);
									$parent = explode('/', $parent);
									$parent = $parent[0];
								?>
								<div class="col-lg-4 col-sm-6">
									<div class="fh5co-blog animate-box">
											<div class="blog-text" onclick="location.href='https://<?= the_field('url');  ?>'">
												<div class="prod-title">
														<div class="price-wrap">
															<span class="amount"><?= the_field('recenzie');  ?> </span>
															<span class="price">od <?= the_field('cena');  ?> Kč </span>
														</div>
														<img class="img-responsive" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );  ?>" alt="">
														<h3><?= the_title();  ?></h3>
														<a href="https://<?= the_field('url');  ?>" class="btn btn-primary">Více detailů</a>
													</div>
											</div>
									</div>
								</div>
							<?php endwhile; ?>

							<?php
								wp_reset_query();
							?>
						</div>
					</div>
				</div>

			</div>
		</div>


		<div id="fh5co-content-section" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Nejnovější články</h3>
						<p>V našem blogu o pneumatikách Vám přinášíme novinky ze světa, zajímavé statistiky, ale i akciové hity.</p>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<?php
						$args = array(
						  'numberposts' => 2
						);
						$latest_posts = new WP_Query( $args );
					?>

					<?php
						$counter=1;
						while ( $latest_posts->have_posts() ) {
							$latest_posts->the_post();
					    set_query_var( 'counter', $counter );
							get_template_part( 'template-parts/content', get_post_type() );
							$counter++;
						}
					?>

				</div>
			</div>
		</div>

<?php
// get_sidebar();
get_footer();
