<!-- Header -->
<header id="header" class="navigation-bar-header light hidden-xs">
    <div class="container">
        <nav class="navigation">
            <div class="navigation-txt visible-xs" data-toggle="dropdown">Головна</div>
            <button class="navigation-toggle visible-xs" type="button" data-toggle="dropdown">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="navigation-bar navigation-bar-left">
                <li><a href="#about">Стати виконавцем</a></li>
                <li><a href="#schedule">Розклад</a></li>
                <li><a href="#speakers">Журі</a></li>
                <li><a href="#price">Ціни</a></li>
                <li><a href="#sponsors">Наші партнери</a></li>
                <li><a href="#map">Контакти</a></li>
                <?php if (Theme_S4J::getOption('guest_registration')):?>
                <li class="featured"><a href="/зареєструватися/" title="Зареєструватися"><i class="fa fa-ticket fa-1x"></i>Придбати квитки</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </div>
</header>
<!-- End Header