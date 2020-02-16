<?php
/*
	Template Name: Products
*/
/**
 * The template for displaying all pages
 *
 * This is the template th
 at displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package parfemlevne
 */

	get_header();

	if(!empty(htmlspecialchars($_GET["cat"]))) {
		$catActual =  htmlspecialchars($_GET["cat"]);
		$catName = get_category($catActual);
 	  $catName->name = explode('-',$catName->name);
	  $catName->name = $catName->name[0];

		$catParent = get_category($catName->parent);
	  $catParent2 = get_category($catParent->parent);

		// echo "<pre>";
		// print_r($catParent);
		// echo "</pre>";
		if($catParent->errors['invalid_term'][0]=='Prázdny termín.') {
			$catParentID = $catName->term_id;
			$catParent = $catName->name;
		} else if($catParent2->errors['invalid_term'][0]!='Prázdny termín.') {
			$catParentID = $catParent2->term_id;
			$catParent = $catParent2->name;
		} else {
			$catParentID = $catParent->term_id;
			$catParent = $catParent->name;
		}

		if($catName->name == $catParent) {
			$catParent= '';
		}



		if(!empty(htmlspecialchars($_GET["pa"]))) {
			$pa = htmlspecialchars($_GET["pa"]);
			$page = $pa*12;
		} else {
			$page=0;
			$pa = 0;
		}

		$args = array(
				'post_type' => 'produkty',
				'post_status' => 'publish',
				'cat' => $catActual, // Whatever the category ID is for your aerial category
				'posts_per_page' => 12,
	    	'offset' => $page,
				'orderby' => 'ID', // Purely optional - just for some ordering
				'order' => 'ASC' // Ditto
		);
		$products = new WP_Query( $args );
		//
		// echo "<pre>";
		// print_r($products);
		// echo "</pre>";


	}


?>
		<div class="fh5co-hero-bg">
		</div>

		<div id="fh5co-blog-section">
			<div class="container">
				<div class="heading-section">

					<h3 class="text-center"><?php if($catParent) {echo 'Lacné ' .($catParent) . ' '. ucfirst($catName->name ); } else { echo 'Lacné '. ($catName->name)  ;}   ?></h3>
				</div>
				<div class="row">
					<div class="col-md-3 col-lg-3 sidebar">
						<!-- <h3>Kategórie</h3> -->
						<?php
							$args = array(
									'post_type' => 'produkty',
									'child_of' => $catParentID, // Whatever the category ID is for your aerial category
									'orderby' => 'parent', // Purely optional - just for some ordering
									'posts_per_page' => 0,
									'order' => 'ASC' // Ditto
							);

							$categories = get_categories($args);
							$uniqeCat = '';

						?>

							<?php foreach ($categories as $key => $value) {
									$value->name = explode('-', $value->name);
									$value->name = ucfirst($value->name[0]);


									if($value->parent != $uniqeCat) {

										$uniqeCat = $value->parent;
										$tmp = get_category($value->parent);

										if($key == $last) {
													echo '</ul>';
											echo '</ul>';
										} else {
											if(($value->parent!=31) && ($value->parent!=2)) {
												echo '</ul>';
												echo '<li>';
												echo '<a href="'. get_home_url() . '/produkty?cat='. $tmp->term_id . '">' .ucfirst($tmp->name). '</a>';
												echo '</li>';
												echo '<ul>';
												echo '<li>';
												echo '<a href="'. get_home_url() . '/produkty?cat='. $value->term_id . '">' .$value->name. '</a>';
												echo '</li>';

											}
										}

									} else {
										echo '<li>';
										echo '<a href="'. get_home_url() . '/produkty?cat='. $value->term_id . '">' .$value->name. '</a>';
										echo '</li>';
									}

								}
							?>
							<br>
						<div class="heureka-affiliate-category" data-trixam-positionid="82841" data-trixam-categoryid="972" data-trixam-categoryfilters="" data-trixam-codetype="iframe" data-trixam-linktarget="blank"></div>
						<div class="heureka-affiliate-category" data-trixam-positionid="82841" data-trixam-categoryid="1471" data-trixam-categoryfilters="" data-trixam-codetype="iframe" data-trixam-linktarget="blank"></div>
					</div>

					<div class="col-md-9  col-lg-9 tab-content">

						<div class="row row-bottom-padded-md ">
							<?php while ( $products->have_posts() ):  ?>
								<?php
								$products-> the_post();
								$cat = get_the_category($value->ID);
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
						<div class="pagination">
								<?php
									if($pa) {
										echo '<a href="' .get_home_url() .'/produkty?cat='. $catActual .'&pa='.($pa-1) . '" class="btn btn-primary">Spat</a>';
									}
								?>

								<?php
								if($pa) {
									echo '<a href="' .get_home_url() .'/produkty?cat='. $catActual .'&pa='.($pa-1) . '" class="">'.($pa-1).'</a>';
								}
								if(count($products->posts) ==12) {
									echo '<a href="' .get_home_url() .'/produkty?cat='. $catActual .'&pa='.($pa) . '" class="actual">'.($pa).'</a>';
									echo '<a href="' .get_home_url() .'/produkty?cat='. $catActual .'&pa='.($pa+1) .'" class="">'.($pa+1).'</a>' ;
								}

								?>

								<?php
									if(count($products->posts) ==12) {
										echo '<a href="' .get_home_url() .'/produkty?cat='. $catActual .'&pa='.($pa+1) .'" class="btn btn-primary">Dalsi</a>' ;
									}
								?>

						</div>
						<br>
				</div>

			</div>
		</div>



<?php
// get_sidebar();
get_footer();
