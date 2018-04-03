<?php
/*
Template Name: Головна сторінка
*/
?>
<?php echo get_header();?>
<?php echo get_template_part('navigation')?>
<?php echo get_template_part('body-intro')?>
<!-- About Section -->
<section id="about" class="section dark">
	<div class="container">
		<div class="icon-wrap"><span class="icon icon-active icon-multimedia-12"></span></div>
		<h3>Стань виконавцем</h3>
		<div class="sub-title">Заповни форму, обравши свю номінацію з наведених <span class="highlight">нижче:</span></div>
		<br />
		<br />
		<section class="nav-tabs-simple">
			<!-- Nav tabs -->
			<div class="row">
				<?php $nominations = Theme_S4J::getPosts('nomination')?>
				<?php foreach ( $nominations as $nm ):?>
				<div class="col-xs-4 col-sm-2 xol-md-1 col-nomination">
					<a target="_blank" class="text-center" href="<?php echo get_field('url', $nm->ID)?>"><i class="icon <?php echo get_field('icon_class', $nm->ID)?>"></i><br/><?php echo $nm->post_title?></a>
				</div>
				<?php endforeach?>
			</div>
		</section>
	</div>
</section>
<!-- End About Section -->
<!-- Stat Section -->
<section id="stat" class="section light">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-6">
				<div class="counter animated hiding" data-animation="fadeInDown" data-delay="0">
					<div class="stat"><span class="value" data-from="0" data-to="72">72</span></div>
					<div class="stat-info">години</div>
					<hr />
					<!--<p class="small">It is a long established fact that a reader will be.</p>-->
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<div class="counter animated hiding" data-animation="fadeInDown" data-delay="500">
					<div class="stat"><span class="value" data-from="0" data-to="40">40</span>+</div>
					<div class="stat-info">виконавців</div>
					<hr />
					<!--<p class="small">It is a long established fact that a reader will be.</p>-->
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<div class="counter animated hiding" data-animation="fadeInDown" data-delay="1000">
					<div class="stat"><span class="value" data-from="0" data-to="100">100</span>+</div>
					<div class="stat-info">гостей</div>
					<hr />
					<!--<p class="small">It is a long established fact that a reader will be.</p>-->
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<div class="counter animated hiding" data-animation="fadeInDown" data-delay="1500">
					<div class="stat"><span class="value" data-from="0" data-to="<?php echo count($nominations)?>"><?php echo count($nominations)?></span></div>
					<div class="stat-info">номінацій</div>
					<hr />
					<!--<p class="small">It is a long established fact that a reader will be.</p>-->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Stat Section -->
<!-- Schedule Section -->
<section id="schedule" class="section dark">
	<div class="container">
		<div class="icon-wrap"><span class="icon icon-active icon-text-hierarchy-07"></span></div>
		<h3>Повний розклад</h3>
		<div class="sub-title">Найкращий шлях дізнатися, що буде на фестивалі</div>
		<br />
		<br />
		<section class="nav-tabs-default">
			<!-- Parent Nav Tabs -->
			<?php $schedule = Theme_S4J::getPosts('schedule');$inc=0;?>
			<ul class="nav nav-tabs">
				<?php foreach ( $schedule as $s): $inc++?>
				<li class="<?php echo $inc == 1 ? 'active' : ''?>">
					<a href="#<?php echo get_field('date', $s->ID)?>" data-toggle="tab">
						<div class="title"><?php echo $s->post_title?></div>
						<div class="subtitle"><?php echo date('d/m/Y', strtotime(get_field('date', $s->ID))) ?></div>
					</a>
				</li>
				<?php endforeach?>
			</ul>

			<!-- Parent Tab panes -->
			<div class="tab-content">
				<?php $inc=0;foreach ( $schedule as $s): $inc++?>
				<div class="tab-pane fade in <?php echo $inc == 1 ? 'active' : ''?>" id="<?php echo get_field('date', $s->ID)?>">
					<div class="tab-pane fade in <?php echo $inc == 1 ? 'active' : ''?>" id="<?php echo get_field('date', $s->ID)?>-1">
						<div class="panel-group timeline-schedule" id="panelTimeline<?php echo get_field('date', $s->ID)?>">
							<?php $iinc=0;foreach (get_field('daily_schedule', $s->ID) as $d):$iinc++;?>
							<div class="panel panel-default">
								<div class="speaker-wrapper">
									<?php if (empty($d['image'])):?>
										<img data-src="holder.js/50x50" class="img-responsive img-circle" alt="" />
									<?php else:?>
										<img src="<?php echo $d['image']?>" class="img-responsive img-circle" alt="" />
									<?php endif?>
								</div>
								<div class="panel-heading">
									<div class="panel-title">
										<div class="time"><i class="fa fa-clock-o"></i> <?php echo $d['time'] ?></div>
										<a data-toggle="collapse" data-parent="#panelTimeline<?php echo get_field('date', $s->ID)?>" href="#item<?php echo get_field('date', $s->ID) . $iinc?>" class="<?php echo $iinc == 1? '' : ' collapsed'?>">
											<?php echo $d['event_name']?>
											<div class="pull-right fa fa-angle-up"></div>
											<div class="pull-right fa fa-angle-down"></div>
										</a>
									</div>
								</div>
								<div id="item<?php echo get_field('date', $s->ID) . $iinc?>" class="panel-collapse collapse<?php echo $iinc == 1? ' in' : ''?>">
									<div class="panel-body">
										<article>
											<?php if (!empty($d['description'])):?><p><?php echo $d['description']?>.</p><?php endif?>
											<p class="author">
												<strong>
													<?php foreach($d['team_members'] as $tm):?>
													<a><i class="fa fa-user"></i> <?php echo $tm['team_member']->post_title?></a>&nbsp;
													<?php endforeach?>
												</strong>
											</p>
										</article>
									</div>
								</div>
							</div>
							<?php endforeach?>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php endforeach?>
			</div>
		</section>

		<!--<div class="btn-wrapper">
			<a href="#" class="btn btn-xs"><span class="icon icon-filetypes-11 icon-active"></span> <span class="btn-txt">Download schedule</span></a>
		</div>-->
	</div>
</section>
<!-- End Schedule Section -->
<!-- Speakers Section -->
<section id="speakers" class="section light">
	<div class="overlay"></div>
	<div class="container">
		<div class="icon-wrap"><span class="icon icon-active icon-multimedia-12"></span></div>
		<h3>Журі</h3>
		<div class="sub-title">Найкреативніші та найцікавіші люди Західної України</div>
		<br />
		<br />
		<section class="row">
			<?php $team = Theme_S4J::getJudges();$inc=-500;?>
			<?php foreach ( $team as $tm ):?>
			<div class="col-md-3 col-sm-3 col-xs-12 col-judge">
				<div class="speaker-item animated hiding" data-animation="fadeInUp" data-delay="<?php echo $inc=$inc+500?>">
					<div class="img-wrapper">
						<?php if (get_post_thumbnail_id($tm->ID)):?>
							<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($tm->ID)) ?>" class="img-responsive img-circle" alt="" />
						<?php else:?>
							<img data-src="holder.js/140x140" class="img-responsive img-circle" alt="" />
						<?php endif?>
					</div>
					<div class="name"><?php echo $tm->post_title?></div>
					<div class="sub"><?php echo get_field('position', $tm->ID)?></div>
					<p class="small"><?php echo get_field('description', $tm->ID)?></p>
					<div class="social-link">
						<?php if (get_field('facebook', $tm->ID)):?>
						<a href="<?php echo get_field('facebook', $tm->ID)?>"><span class="fa fa-facebook"></span></a>
						<?php endif?>
						<?php if (get_field('twitter', $tm->ID)):?>
							<a href="<?php echo get_field('twitter', $tm->ID)?>"><span class="fa fa-twitter"></span></a>
						<?php endif?>
						<?php if (get_field('vkontakte', $tm->ID)):?>
							<a href="<?php echo get_field('vkontakte', $tm->ID)?>"><span class="fa fa-vk"></span></a>
						<?php endif?>
					</div>
				</div>
			</div>
			<?php endforeach?>
		</section>
		<!--<div class="btn-wrapper">
			<a href="#" class="btn btn-sm btn-default">See all speakers</a>
		</div>-->
	</div>
</section>
<!-- End Speakers Section -->
<!-- Price Section -->
<section id="price" class="section dark">
	<div class="container">
		<div class="icon-wrap"><span class="icon icon-active icon-shopping-02"></span></div>
		<h3>Ціни</h3>
		<div class="sub-title">Реєстрація починається з 3 травня, гостей — з 1 червня. Ціни вказано в гривнях.</div>
		<br/>
		<br/>
		<?php $prices = Theme_S4J::getPosts('price')?>
		<div class="pricing-cols pricing-3-cols">
			<?php foreach ( $prices as $pr ):?>
			<div class="pricing-col <?php echo get_field('best_value', $pr->ID) ? 'pricing-col-featured"' : 'animated hiding" data-animation="fadeInLeft" data-delay="0"'?>>
				<?php if (get_field('best_value', $pr->ID) && get_field('discount', $pr->ID)):?>
				<div class="pricing-ribbon"><?php echo get_field('discount', $pr->ID)?></div>
				<?php endif?>
				<div class="pricing-col-header">
					<h3 class="pricing-col-header-title"><?php echo $pr->post_title?></h3>
					<h4 class="pricing-col-header-amount">
						<span class="pricing-col-amount"><?php echo get_field('amount', $pr->ID)?></span></h4>
				</div>
				<div class="pricing-col-content">
					<ul>
						<?php foreach ( get_field('features', $pr->ID) as $f ):?>
						<li><?php echo $f['feature']?></li>
						<?php endforeach?>
					</ul>
					<!-- <a class="pricing-col-button" href="/зареєструватися/">Зареєструватися</a> -->
				</div>
			</div>
			<?php endforeach?>
		</div>
	</div>
</section>
<!-- End Price Section -->
<!-- Register Section -->
<section id="register" class="section light ">
	<div class="overlay"></div>
	<div class="container">
		<article class="article-big animated hiding" data-animation="fadeInUp" data-delay="0">
			<h5>Реєстрація завершена</h5>
			<p>Чекаємо тебе на фестивалі</p>
		</article>
		<?php
			/*<h5>Зареєструйся на фестиваль прямо зараз!</h5>
			<p>Надихай себе та інших. Заряджайся духовною енергією разом з усіма. Прославляй Бога усією душою та серцем.</p>
			<br/>
			<a href="/зареєструватися/" class="btn btn-sm btn-tertiary">Зареєструватися</a>*/
		?>
		
	</div>
</section>
<!-- End Register Section -->
<!-- Sponsors Section -->
<section id="sponsors" class="section dark">
	<div class="container">
		<div class="icon-wrap"><span class="icon icon-active icon-documents-bookmarks-12"></span></div>
		<h3>Наші партнери</h3>
		<div class="sub-title">Ті, кому ми вдячні за підтримку</div>
		<br/>
		<div class="row">
			<ul class="list-inline">
				<?php $partner = Theme_S4J::getPosts('partner')?>
				<?php foreach ( $partner as $pt ):?>
				<li><a href="<?php echo get_field('website', $pt->ID) ? get_field('website', $pt->ID):'#'?>" target="_blank"><img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($pt->ID)) ?>" alt="<?php echo $pt->post_title?>" /></a></li>
				<?php endforeach?>
			</ul>

			<div class="btn-wrapper">
				<a href="mailto:tada@sing4jesus.org.ua" target="_blank" class="btn btn-sm btn-primary">Стати партнером</a>
			</div>
		</div>
	</div>
</section>
<!-- End Price Section -->
<!-- Map Section -->
<section id="map" class="dark">
	<div id="canvas-map"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-7 animated hiding location" data-animation="fadeInLeft" data-delay="0">
				<h3>Location</h3>
				<ul itemscope="" itemtype="http://schema.org/PostalAddress">
					<li itemprop="address"><i class="fa fa-map-marker highlight"></i><?php echo Theme_S4J::getOption('contact_address')?></li>
					<li itemprop="email"><i class="fa fa-envelope highlight"></i><?php echo Theme_S4J::getOption('contact_email')?></li>
					<li itemprop="telephone"><i class="fa fa-phone highlight"></i><?php echo Theme_S4J::getOption('contact_phone')?></li>
					<li itemscope="" itemtype="http://schema.org/Event">
						<meta itemprop="name" content="Християнський фестиваль Я Співаю для Ісуса">
						<i class="fa fa-clock-o highlight"></i><time itemprop="startDate" datetime="<?php echo date('Y-m-d', Theme_S4J::getScheduleDate())?>"><?php echo date('d.m.Y', Theme_S4J::getScheduleDate())?></time> - <time itemprop="endDate" datetime="<?php echo date('Y-m-d', Theme_S4J::getScheduleDate(Theme_S4J::SCHEDULE_DATES_MAX))?>"><?php echo date('d.m.Y', Theme_S4J::getScheduleDate(Theme_S4J::SCHEDULE_DATES_MAX))?></time>
						<div itemprop="location" itemscope itemtype="http://schema.org/Place" class="hidden">
							<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
								<meta itemprop="latitude" content="<?php echo floatval(Theme_S4J::getOption('contact_latitude'))?>">
								<meta itemprop="longitude" content="<?php echo floatval(Theme_S4J::getOption('contact_longitude'))?>">
							</div>
							<meta itemprop="name" content="Християнський фестиваль Я Співаю для Ісуса">
							<meta itemprop="address" content="<?php echo floatval(Theme_S4J::getOption('contact_address'))?>">
						</div>
						<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
							<meta itemprop="name" content="Участь у фестивалі">
							<meta itemprop="price" content="220">
							<meta itemprop="priceCurrency" content="UAH">
							<link itemprop="url" href="http://sing4jesus.org.ua/%D0%B7%D0%B0%D1%80%D0%B5%D1%94%D1%81%D1%82%D1%80%D1%83%D0%B2%D0%B0%D1%82%D0%B8%D1%81%D1%8F/">
							<link itemprop="availability" href="http://schema.org/InStock">
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- End Map Section -->
<?php echo get_footer();?>