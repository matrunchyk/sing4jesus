<div id="mask">
	<div id="loader"><img src="/html/assets/img/preloader.gif" alt="preloader" /></div>
</div>
<header id="mobileheader" class="navigation-bar-header light visible-xs"></header>
<!-- Hero Section -->
<section id="hero" class="light">
    <?php if (!Theme_S4J::getOption('guest_registration')):?>
    <p class="label-info text-center">Реєстрацію завершено. Незабаром зустрінемось!</p>
    <?php endif;?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 text-right">
                <audio controls autoplay>
                    <source src="/wp-content/themes/s4j/bg.mp3">
                </audio>
            </div>
        </div>
    </div>
	<div class="container">
		<div class="home-bg">
			<div class="hero-content text-center">
				<div class="hero-small">
					<hr /><span><span class="fa fa-calendar"></span>17 червня—19 червня <div class="sep"></div> <span class="fa fa-map-marker"></span>Оздоровчий центр "Барвінок"</span> <hr />
				</div>
				<div class="hero-big">Я співаю для Ісуса</div>
				<div class="hero-normal">Прославимо Бога своїм <strong>співом</strong></div>
				<div class="row">
					<div class="col-xs-12 text-right col-sm-12 text-center">
                        <?php if (Theme_S4J::getOption('guest_registration')):?>
						<a href="/зареєструватися/" class="btn btn-lg btn-3d" title="Зареєструватися"><i class="fa fa-play-circle fa-2x"></i> <span>Зареєструватися</span></a>
                        <?php endif;?>
					</div>
                </div>
                <div class="row" style="margin-top: 80px">
					<div class="col-xs-2 text-center col-xs-offset-3">
						<a href="https://instagram.com/sing4jesus.fest" class="btn btn-sm btn-default" target="_blank">
                            <span class="fa fa-instagram"></span> Instagram</a>
					</div>
                    <div class="col-xs-2 text-center">
						<a href="https://t.me/sing4jesus_fest" class="btn btn-sm btn-default" target="_blank">
                            <span class="fa fa-telegram"></span> Telegram</a>
					</div>
                    <div class="col-xs-2 text-center">
						<a href="https://fb.com/sing4jesus.fest" class="btn btn-sm btn-default" target="_blank">
                            <span class="fa fa-facebook"></span> Facebook</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Hero Section -->
