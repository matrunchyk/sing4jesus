<?php
/*
Template Name: Загальний
*/
?>
<?php echo get_header();?>
	<header id="mobileheader" class="navigation-bar-header light visible-xs"></header>
	<!-- Hero Section -->
	<section id="hero" class="light">
		<div class="container">
			<div class="home-bg">
				<div class="hero-content text-center">
					<div class="container">
						<div class="row">
							<div class="col-sm-12">
								<div itemscope itemtype="http://schema.org/Article">
									<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
										<h1 itemprop="name"><?php the_title(); ?></h1>
										<div itemprop="articleBody"><?php echo isset($_GET['amount']) ? str_replace('[amount]', intval($_GET['amount']), get_the_content()) : get_the_content(); ?></div>
									<?php endwhile; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php echo get_footer();?>