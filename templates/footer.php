<?php
defined('ABS_PATH') or exit('No direct script access allowed');
$config = $wpp_config['footer'];
?>
<footer id="footer" class="footer" aria-label="Site footer">
    <?php if (is_home_page()) { ?>
        <div class="view-list">
            <div class="container">
                <div class="row">
                    <?php foreach ($config['navItems'] as $item): ?>
                        <div class="col-xs-6 col-sm-3">
                            <div class="view-list__container">
                                <a class="view-list__link" href="<?php echo htmlspecialchars($item['href']) ?>"
                                   title="<?php echo htmlspecialchars($item['title']) ?>"
                                   <!--aria-label="--><?php /*echo htmlspecialchars($item['title']) */?>">
                                    <div class="view-list__icon">
                                        <img class="view-list__img" src="<?php echo htmlspecialchars($item['icon']) ?>"
                                             alt="<?php echo htmlspecialchars($item['alt']) ?>" loading="lazy">
                                    </div>
                                    <span class="view-list__desc"><?php echo htmlspecialchars($item['title']) ?></span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="wrap">
        <div class="contacts">
            <div class="container content-wrapper">
                <div class="row">
                    <!-- Address Block -->
                    <div class="col-sm-4">
                        <h3 class="contacts__title"><?php echo htmlspecialchars($config['addressBlock']['title']) ?></h3>
                        <hr class="contacts__line" aria-hidden="true">
                        <address><?php echo $config['addressBlock']['content'] ?></address>
                        <nav class="footer-nav">
                            <ul>
                                <li><a href="/blog">Blog</a></li>
                                <li>
                                    <a href="/privacy-policy">Privacy policy</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Contacts Block -->
                    <div class="col-sm-5">
                        <h3 class="contacts__title"><?php echo htmlspecialchars($config['contactsBlock']['title']) ?></h3>
                        <hr class="contacts__line" aria-hidden="true">
                        <address><?php echo $config['contactsBlock']['content'] ?></address>
                    </div>

                    <!-- Social Block -->
                    <div class="col-sm-3">
                        <h3 class="contacts__title">Follow Us</h3>
                        <hr class="contacts__line" aria-hidden="true">
                        <div class="social-icons">
                            <?php foreach ($config['socialLinks'] as $social): ?>
                                <div class="icons">
                                    <a href="<?php echo htmlspecialchars($social['href']) ?>" target="_blank"
                                       rel="noopener noreferrer"
                                       title="<?php echo htmlspecialchars($social['label']) ?>">
                                        <i class="<?php echo htmlspecialchars($social['class']) ?>"
                                           aria-hidden="true"></i>
                                    </a>
                                </div>
                            <?php endforeach; ?>

                            <div style="margin-top:8px;" id="<?php echo $config['yelpBadge']['id'] ?>">
                                <a href="<?php echo $config['yelpBadge']['link'] ?>" target="_blank"
                                   rel="noopener noreferrer" class="ss">
                                    <?php echo $config['yelpBadge']['text'] ?>
                                </a>
                            </div>
                        </div>

                        <a href="<?php echo $config['quoteButton']['href'] ?>"
                           class="<?php echo $config['quoteButton']['class'] ?>" role="button">
                            <?php echo $config['quoteButton']['text'] ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright">
            <div class="container content-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-center">
                            <a target="_blank" href="<?php echo $config['copyright']['link'] ?>"
                               rel="noopener noreferrer">
                                <?php echo $config['copyright']['text'] ?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<?php foreach ($config['scripts'] as $script): ?>
    <script src="<?php echo htmlspecialchars($script) ?>"></script>
<?php endforeach; ?>

<!-- Yelp Script -->
<script>
    (function (d, t) {
        var g = d.createElement(t);
        var s = d.getElementsByTagName(t)[0];
        g.id = "<?php echo $config['yelpScript']['id'] ?>";
        g.src = "<?php echo $config['yelpScript']['src'] ?>";
        g.async = true;
        s.parentNode.insertBefore(g, s);
        g.onload = function () {
            var yelpLink = document.querySelector('#<?php echo $config['yelpBadge']['id'] ?> a');
            yelpLink.setAttribute('target', '_blank');
            yelpLink.setAttribute('rel', 'noopener noreferrer');
            yelpLink.setAttribute('aria-label', 'Yelp reviews');
        }
    }(document, 'script'));

    <?php if(is_quote_page()) : ?>

    jQuery(function ($) {

        // date
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();


        $('.datepicker').periodpicker({
            likeXDSoftDateTimePicker: true,
            norange: true,
            cells: [1, 1],
            withoutBottomPanel: true,
            yearsLine: false,
            title: false,
            fullsizeButton: false,
            hideAfterSelect: true,
            hideOnBlur: true,
            clearButtonInButton: true,
            formatDate: 'MM/DD/YYYY',
            minDate:moment().format("MM/DD/YYYY")

        });

        $('.datepicker-s').datetimepicker();

        $('.datetimer').TimePickerAlone({
            inputFormat: 'hh:mm A',
            steps:[1,15],
            seconds: false,
            defaultTime: ''
        });

        $('.calendar').click(function() {
            $(this).parent().find('.datepicker').periodpicker('show');
        });
    });

    <?php endif; ?>

</script>
<?php if( is_reserv_page()) { ?>
    <script>
        $(document).ready(function() {
            // Функция для переключения видимых полей
            function toggleFields() {
                // Переключение полей Pickup
                $('input[name="pickup"]').each(function() {
                    const target = $(this).data('show');
                    if ($(this).is(':checked')) {
                        $(target).show().find('.required').attr('required', true);
                        $(this).data('hide') && $($(this).data('hide')).hide().find('.required').removeAttr('required');
                    }
                });

                // Переключение полей Destination
                $('input[name="destination"]').each(function() {
                    const target = $(this).data('show');
                    if ($(this).is(':checked')) {
                        $(target).show().find('.required').attr('required', true);
                        $(this).data('hide') && $($(this).data('hide')).hide().find('.required').removeAttr('required');
                    }
                });

                // Переключение полей Payment
                const paymentType = $('input[name="payment"]:checked').val();
                $('.pyment_by_card .required_c').removeAttr('required');
                if (paymentType === 'credit_card') {
                    $('.pyment_by_card').show();
                    $('.pyment_by_card .required_c').attr('required', true);
                } else {
                    $('.pyment_by_card').hide();
                }
            }

            // Инициализация при загрузке
            toggleFields();

            // Обработчики изменений
            $('input[name="pickup"], input[name="destination"], input[name="payment"]').change(toggleFields);

            // Автозаполнение Pickup address если выбрана соответствующая опция
            $('.agreed__checkbox').click(function() {
                if ($(this).find('span').hasClass('agreed__checked')) {
                    $(this).find('span').removeClass('agreed__checked');
                    $('#pickup_street input[name="pickup_address"]').val('');
                    $('#pickup_street input[name="pickup_phone"]').val('');
                } else {
                    $(this).find('span').addClass('agreed__checked');
                    $('#pickup_street input[name="pickup_address"]').val($('#address').val());
                    $('#pickup_street input[name="pickup_phone"]').val($('#mobile').val());
                }
            });

            // Валидация и отправка формы
            $('#reservation-form').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                const submitBtn = $(form).find('button[type="submit"]');
                const messageEl = $('#total-error');

                // Проверка согласия
                if (!$('#submit_agree').is(':checked')) {
                    messageEl.text('Please agree to the terms').show();
                    return false;
                }

                // Валидация видимых обязательных полей
                let isValid = true;
                $('.required:visible').each(function() {
                    if (!$(this).val().trim()) {
                        $(this).addClass('error-field');
                        isValid = false;
                    } else {
                        $(this).removeClass('error-field');
                    }
                });

                if (!isValid) {
                    messageEl.text('Please fill in all required fields').show();
                    return false;
                }

                // Показываем индикатор загрузки
                submitBtn.prop('disabled', true).html('<span class="spinner"></span>Sending...');
                messageEl.hide();

                // Собираем данные формы
                const formData = new FormData(form);

                // Отправка AJAX
                $.ajax({
                    url: '/core/send_reservation.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    success: function(data) {
                        if (data.success) {
                            messageEl.css('color', 'green').text(data.message).show();
                            form.reset();
                            toggleFields();
                        } else {
                            messageEl.css('color', 'red').text(data.message).show();
                        }
                    },
                    error: function(xhr) {
                        messageEl.css('color', 'red').text('Connection error. Please try again.').show();
                        console.error('Error:', xhr.responseText);
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text('Get a quote');
                    }
                });
            });

            // Стили для ошибок валидации
            const style = document.createElement('style');
            style.innerHTML = `
        .error-field { border-color: #ff0000 !important; }
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(0,0,0,.1);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
            vertical-align: middle;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    `;
            document.head.appendChild(style);
        });
    </script>

    <style>
        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(0,0,0,.1);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
            vertical-align: middle;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
    <script>
        jQuery(function ($) {
            // date
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();


            $('.datepicker').periodpicker({
                likeXDSoftDateTimePicker: true,
                norange: true,
                cells: [1, 1],
                withoutBottomPanel: true,
                yearsLine: false,
                title: false,
                fullsizeButton: false,
                hideAfterSelect: true,
                hideOnBlur: true,
                clearButtonInButton: true,
                formatDate: 'MM/DD/YYYY',
                minDate: moment().format("MM/DD/YYYY")

            });

            $('.datepicker-s').datetimepicker();

            $('.datetimer').TimePickerAlone({
                inputFormat: 'hh:mm A',
                steps: [1, 15],
                seconds: false,
                defaultTime: ''
            });

            $('.calendar').click(function () {
                $(this).parent().find('.datepicker').periodpicker('show');
            });

        })
    </script>
<?php } ?>
<script>
    // Проверяем поддержку IntersectionObserver
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('.lazy-img');

        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy-img');
                    observer.unobserve(img);
                }
            });
        });

        lazyImages.forEach(img => imageObserver.observe(img));
    } else {
        // Фолбэк для старых браузеров
        lazyLoadFallback();
    }

    function lazyLoadFallback() {
        const lazyImages = document.querySelectorAll('.lazy-img');
        let lazyLoadTimeout;

        function lazyLoad() {
            if (lazyLoadTimeout) {
                clearTimeout(lazyLoadTimeout);
            }

            lazyLoadTimeout = setTimeout(() => {
                const scrollTop = window.pageYOffset;
                lazyImages.forEach(img => {
                    if (img.offsetTop < (window.innerHeight + scrollTop)) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-img');
                    }
                });
            }, 200);
        }

        document.addEventListener('scroll', lazyLoad);
        window.addEventListener('resize', lazyLoad);
        window.addEventListener('orientationchange', lazyLoad);
        lazyLoad(); // Первоначальная загрузка видимых изображений
    }
</script>

</body>
</html>