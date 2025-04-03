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
                                   aria-label="<?php echo htmlspecialchars($item['title']) ?>">
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
                        <div class="social-icons" role="list">
                            <?php foreach ($config['socialLinks'] as $social): ?>
                                <div class="icons" role="listitem">
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
                                   rel="noopener noreferrer">
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
                submitBtn.prop('disabled', true).html('<span class="spinner">Sending...</span>');
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
        .agreed {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin: 10px 0;
        }
        .agreed__checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #ccc;
            border-radius: 3px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .agreed__checkbox span {
            display: inline-block;
            width: 12px;
            height: 12px;
            background-color: transparent;
            transition: all 0.3s ease;
        }
        .agreed__checkbox span.agreed__checked {
            background-color: #4CAF50;
        }
        .agreed__text {
            user-select: none;
            transition: all 0.3s ease;
        }
        .hidden {
            display: none !important;
        }
    </style>
    <script>
        jQuery(function ($) {
            // date
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            $('#country').change(function () {
                var country = $(this).val();

                var usStates = '<select id="state" type="text" class="form-control required" placeholder="" name="state">' +
                    '<option value="">State</option>' +
                    '<option value="AL">Alabama</option>' +
                    '<option value="AK">Alaska</option>' +
                    '<option value="AZ">Arizona</option>' +
                    '<option value="AR">Arkansas</option>' +
                    '<option value="CA">California</option>' +
                    '<option value="CO">Colorado</option>' +
                    '<option value="CT">Connecticut</option>' +
                    '<option value="DE">Delaware</option>' +
                    '<option value="DC">District Of Columbia</option>' +
                    '<option value="FL">Florida</option>' +
                    '<option value="GA">Georgia</option>' +
                    '<option value="HI">Hawaii</option>' +
                    '<option value="ID">Idaho</option>' +
                    '<option value="IL">Illinois</option>' +
                    '<option value="IN">Indiana</option>' +
                    '<option value="IA">Iowa</option>' +
                    '<option value="KS">Kansas</option>' +
                    '<option value="KY">Kentucky</option>' +
                    '<option value="LA">Louisiana</option>' +
                    '<option value="ME">Maine</option>' +
                    '<option value="MD">Maryland</option>' +
                    '<option value="MA">Massachusetts</option>' +
                    '<option value="MI">Michigan</option>' +
                    '<option value="MN">Minnesota</option>' +
                    '<option value="MS">Mississippi</option>' +
                    '<option value="MO">Missouri</option>' +
                    '<option value="MT">Montana</option>' +
                    '<option value="NE">Nebraska</option>' +
                    '<option value="NV">Nevada</option>' +
                    '<option value="NH">New Hampshire</option>' +
                    '<option value="NJ">New Jersey</option>' +
                    '<option value="NM">New Mexico</option>' +
                    '<option value="NY">New York</option>' +
                    '<option value="NC">North Carolina</option>' +
                    '<option value="ND">North Dakota</option>' +
                    '<option value="OH">Ohio</option>' +
                    '<option value="OK">Oklahoma</option>' +
                    '<option value="OR">Oregon</option>' +
                    '<option value="PA">Pennsylvania</option>' +
                    '<option value="RI">Rhode Island</option>' +
                    '<option value="SC">South Carolina</option>' +
                    '<option value="SD">South Dakota</option>' +
                    '<option value="TN">Tennessee</option>' +
                    '<option value="TX">Texas</option>' +
                    '<option value="UT">Utah</option>' +
                    '<option value="VT">Vermont</option>' +
                    '<option value="VA">Virginia</option>' +
                    '<option value="WA">Washington</option>' +
                    '<option value="WV">West Virginia</option>' +
                    '<option value="WI">Wisconsin</option>' +
                    '<option value="WY">Wyoming</option>' +
                    '</select>';

                var canadaProvinces = '<select id="state" type="text" class="form-control required" placeholder="" name="state">' +
                    '<option value="">Province</option>' +
                    '<option value="AB">Alberta</option>' +
                    '<option value="BC">British Columbia</option>' +
                    '<option value="MB">Manitoba</option>' +
                    '<option value="NB">New Brunswick</option>' +
                    '<option value="NL">Newfoundland and Labrador</option>' +
                    '<option value="NS">Nova Scotia</option>' +
                    '<option value="ON">Ontario</option>' +
                    '<option value="PE">Prince Edward Island</option>' +
                    '<option value="QC">Quebec</option>' +
                    '<option value="SK">Saskatchewan</option>' +
                    '<option value="NT">Northwest Territories</option>' +
                    '<option value="NU">Nunavut</option>' +
                    '<option value="YT">Yukon</option>' +
                    '</select>';

                var mexicoProvinces = '<select id="state" type="text" class="form-control required" placeholder="" name="state">' +
                    '<option value="">State</option>' +
                    '<option value="DIF">Distrito Federal</option>' +
                    '<option value="AGS">Aguascalientes</option>' +
                    '<option value="BCN">Baja California</option>' +
                    '<option value="BCS">Baja California Sur</option>' +
                    '<option value="CAM">Campeche</option>' +
                    '<option value="CHP">Chiapas</option>' +
                    '<option value="CHI">Chihuahua</option>' +
                    '<option value="COA">Coahuila</option>' +
                    '<option value="COL">Colima</option>' +
                    '<option value="DUR">Durango</option>' +
                    '<option value="GTO">Guanajuato</option>' +
                    '<option value="GRO">Guerrero</option>' +
                    '<option value="HGO">Hidalgo</option>' +
                    '<option value="JAL">Jalisco</option>' +
                    '<option value="MEX">M&eacute;xico</option>' +
                    '<option value="MIC">Michoac&aacute;n</option>' +
                    '<option value="MOR">Morelos</option>' +
                    '<option value="NAY">Nayarit</option>' +
                    '<option value="NLE">Nuevo Le&oacute;n</option>' +
                    '<option value="OAX">Oaxaca</option>' +
                    '<option value="PUE">Puebla</option>' +
                    '<option value="QRO">Quer&eacute;taro</option>' +
                    '<option value="ROO">Quintana Roo</option>' +
                    '<option value="SLP">San Luis Potos&iacute;</option>' +
                    '<option value="SIN">Sinaloa</option>' +
                    '<option value="SON">Sonora</option>' +
                    '<option value="TAB">Tabasco</option>' +
                    '<option value="TAM">Tamaulipas</option>' +
                    '<option value="TLX">Tlaxcala</option>' +
                    '<option value="VER">Veracruz</option>' +
                    '<option value="YUC">Yucat&aacute;n</option>' +
                    '<option value="ZAC">Zacatecas</option>' +
                    '</select>';

                var counrtyRegion = '<input id="state" type="text" class="form-control" placeholder="Region" name="state">';


                if (country == "United States") {
                    $('#zip').attr('placeholder', 'Zip/Postal');
                    $('#state').replaceWith(usStates);
                } else if (country == "Canada") {
                    $('#zip').attr('placeholder', 'Postal Code');
                    $('#state').replaceWith(canadaProvinces);
                } else if (country == "Mexico") {
                    $('#zip').attr('placeholder', 'Zip/Postal');
                    $('#state').replaceWith(mexicoProvinces);
                } else {
                    $('#zip').attr('placeholder', 'Postal Code');
                    $('#state').replaceWith(counrtyRegion);
                }
            });

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

            // Обработчик клика по тексту "I agree"
            $('.agreed__text').click(function() {
                const $checkbox = $(this).siblings('#submit_agree');
                const $checkmark = $(this).siblings('.agreed__checkbox').find('span');

                // Переключаем состояние чекбокса
                $checkbox.prop('checked', !$checkbox.prop('checked'));

                // Анимация галочки
                if ($checkbox.is(':checked')) {
                    $checkmark.addClass('agreed__checked');
                    $(this).css('font-weight', 'bold');
                } else {
                    $checkmark.removeClass('agreed__checked');
                    $(this).css('font-weight', 'normal');
                }
            });

            // Обработчик клика по самой галочке
            $('.agreed__checkbox').click(function(e) {
                e.preventDefault();
                $(this).siblings('.agreed__text').trigger('click');
            });

            // Валидация при отправке формы
         /*   $('#reservation-form').on('submit', function(e) {
                if (!$('#submit_agree').is(':checked')) {
                    e.preventDefault();
                    $('.agreed__text').css('color', 'red').effect('shake', { distance: 5, times: 2 }, 300);
                    $('#total-error').text('You must agree to the terms').show();
                }
            });*/
        })
    </script>
<?php } ?>

</body>
</html>