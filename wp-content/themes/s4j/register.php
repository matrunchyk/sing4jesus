<?php
/*
Template Name: Зареєструватися
*/
?>
<?php echo get_header();?>
	<header id="mobileheader" class="navigation-bar-header light visible-xs"></header>
	<!-- Hero Section -->
	<section id="hero" class="light">
		<div class="container">
			<div class="home-bg">
				<div class="hero-content text-center ">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h2>Зареєструйся на <span class="highlight">фестиваль</span> зараз!</h2>
								<div class="sub-title">та оплати квиток протягом 24 годин.</div>
								<br/>
								<br/>
							</div>
							<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
								<form class="form form-register" method="post">
									<input type="hidden" name="action" value="register">
									<?php $nonceField = WPSimpleNonce::createNonceField( 'register' ); echo $nonceField['value'];?>
									<input type="hidden" name="nonce_field" value="<?php echo $nonceField['name'];?>" />
									<div class="form-group">
<!--										<div class="text-info">Увага! Гості зможуть реєструватися лише <b>з 1 червня</b>.<br/><br/></div>-->
										<label for="type" class="col-sm-3 col-xs-12 control-label">Участь</label>
										<div class="col-sm-9 col-xs-12">
											<select class="form-control required" name="guest_type" id="guest_type" placeholder="Участь">
												<option value="1">Я виконавець</option>
												<option value="2">Я гість</option>
											</select>
										</div>
									</div>
									<div class="form-group text-left nominations-chooser">
										<div class="col-sm-9 col-xs-12 col-sm-offset-3">Приймаю участь у номінаціях:</div>
										<?php $nomination = Theme_S4J::getPosts('nomination')?>
										<div class="row">
											<?php foreach ( $nomination as $nm ):?>
											<div class="col-sm-9 col-xs-12 col-sm-offset-3">
												<div class="radio">
													<label><input type="checkbox" class="required" name="guest_nominations[]" value="<?php echo $nm->ID?>"><?php echo $nm->post_title?></label>
												</div>
											</div>
											<?php endforeach?>
										</div>
									</div>
									<div class="form-group">
										<label for="ticket" class="col-sm-3 col-xs-12 control-label">Тип квитка</label>
										<div class="col-sm-9 col-xs-12">
											<select class="form-control required" name="guest_ticket" id="ticket" placeholder="Оберіть тип квитка">
												<?php $tickets = Theme_S4J::getPosts('price')?>
												<?php foreach ( $tickets as $tk):?>
													<option id="price<?php echo $tk->ID?>" value="<?php echo $tk->ID?>"><?php echo $tk->post_title?> - <?php echo get_field('amount', $tk->ID)?> грн. <?php echo get_field('best_value', $tk->ID) ? '<span class="highlight">(найкраща ціна)</span>' : '' ?></option>
												<?php endforeach?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="fullname" class="col-sm-3 col-xs-12 control-label" style="line-height: 25px;">Ім'я та прізвище</label>
										<div class="col-sm-9 col-xs-12">
											<input type="text" class="form-control required" name="guest_fullname" id="fullname" placeholder="Ім'я прізвище" required="">
										</div>
									</div>
									<div class="form-group">
										<label for="phone" class="col-sm-3 col-xs-12 control-label" style="line-height: 25px;">Номер телефону</label>
										<div class="col-sm-9 col-xs-12">
											<input type="text" class="form-control" name="guest_phone" id="phone" placeholder="Ваш номер телефону" required="">
										</div>
									</div>
									<div class="form-group">
										<label for="church" class="col-sm-3 col-xs-12 control-label" style="line-height: 25px;">Церква/громада</label>
										<div class="col-sm-9 col-xs-12">
											<input type="text" class="form-control" name="guest_church" id="church" placeholder="Адреса Вашої цекркви/громади" required="">
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="col-sm-3 col-xs-12 control-label">Email</label>
										<div class="col-sm-9 col-xs-12">
											<input type="email" class="form-control required email" name="guest_email" id="email" placeholder="Email" required="">
										</div>
									</div>
									<div class="form-group">
										<label for="birthday" class="col-sm-3 col-xs-12 control-label" style="line-height: 25px;">Дата народження</label>
										<div class="col-sm-9 col-xs-12">
											<input type="date" class="form-control required" name="guest_birthday" id="birthday" placeholder="Дата народження" required="">
										</div>
									</div>

									<div class="form-group">
										<label for="ticket" class="col-sm-3 col-xs-12 control-label" style="line-height: 25px;">Час приїзду</label>
										<div class="col-sm-9 col-xs-12">
											<select class="form-control required" name="guest_arrival" id="arrival" placeholder="Вкажіть час приїзду">
													<option value="1">П'ятниця 9:00-12:00</option>
													<option value="2">П'ятниця 12:00-15:00</option>
													<option value="3">П'ятниця 15:00-17:00</option>
													<option value="4">Субота</option>
											</select>
										</div>
									</div>
									<p class="label-warning">Увага! Ви повинні здійснити оплату не пізніше, ніж за 24 години. Інакше Вашу заявку може бути анульовано.</p>
									<p></p>
									<button type="submit" class="btn btn-primary btn-sm btn-block">Розпочати</button>
								</form>

								<p class="agree-text center">Клацнувши, Ви погоджуєтесь із умовами та політкою приватності.<br>
									"Я співаю для Ісуса" © 2015-<?php echo date('y')?> Всі права збережено.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php echo get_footer();?>