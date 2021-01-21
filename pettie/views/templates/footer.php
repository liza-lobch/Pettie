</div>
<footer class="main-footer">
    <div class="main-footer__waves"></div>
    <div class="main-footer__content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="adv-item">
                        <div href="" class="main-footer__logo"><img src="<?= IMG . "logo.png";?>" alt="Логотип" class="main-footer-logo__img"></div>
                        <div>&copy; Pettie 2020. Все права защищены.</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="adv-item">
                        <h3 class="main-footer__heading">Разделы</h3>
                        <ul class="footer-list menu list-unstyled">
                            <li class="footer-list__item"><a href="" class="footer-list__link">Кошки</a></li>
                            <li class="footer-list__item"><a href="" class="footer-list__link">Собаки</a></li>
                            <li class="footer-list__item"><a href="" class="footer-list__link">Птицы</a></li>
                            <li class="footer-list__item"><a href="" class="footer-list__link">Хорьки и грызуны</a></li>
                            <li class="footer-list__item"><a href="" class="footer-list__link">Рыбки</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="adv-item">
                        <h3 class="main-footer__heading">Контакты</h3>
                        <ul class="footer-contacts menu list-unstyled">
                            <li class="footer-contacts__item">
                                <i class="fa fa-envelope footer-contacts__icon"></i>
                                <a href="mailto:aperture@gmail.com" class="footer-contacts__link">pettie@gmail.com</a>
                            </li>
                            <li class="footer-contacts__item">
                                <i class="fa fa-phone footer-contacts__icon"></i>
                                <a href="tel:+78127030202" class="footer-contacts__link">(812)&nbsp;555-35-35</a>
                            </li>
                            <li class="footer-contacts__item">
                                <a href="" class="footer-contacts__link">Санкт-Петербург, пр.&nbsp;Невский, д.&nbsp;25/3</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="adv-item">
                        <h3 class="main-footer__heading">Мы в соц. сетях</h3>
                        <div class="sprite">
                            <a href="#" class="block block01">
                            </a>
                            <a href="#" class="block block02">
                            </a>
                            <a href="#" class="block block03">
                            </a>
                            <a href="#" class="block block04">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<script src="<?= LIBS; ?>jquery/jquery.js"> </script>
<script src="<?= LIBS; ?>bootstrap/js/popper.min.js" defer></script>
<script src="<?= LIBS; ?>bootstrap/js/bootstrap.js"> </script>
<script src="<?= JS; ?>cookie.js"> </script>
<script src="<?= JS; ?>index.js"> </script>
<?php if (($title == 'Регистрация') || ($title == 'Авторизация')) : ?>
<script src="<?= JS; ?>validation.js"> </script>
<?php endif; ?>
</body>

</html>
