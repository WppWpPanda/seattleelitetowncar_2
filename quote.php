<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed')); ?>
    <div class="content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="header-short">
                        <h2 class="header-short__text">Request a Quote</h2>
                        <div class="header-short__line"></div>
                        <div class="header-short__line"></div>
                        <a href="reservation<?php echo PHP ?>" class="btn-yellow header-short__btn">Reservation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap bg-light">
        <div class="content-wrap content-wrap--top">
            <div class="container-fluid">
                <div class="row">
                    <div class="contacts-info">
                        <div class="col-sm-6 col-md-4">
                            <div class="row">
                                <div class="col-xs-1 col-xs-offset-1">
                                    <div class="contacts-info__item"><img src="theme/images/icons/con_phone_icon.png">
                                    </div>
                                </div>
                                <div class="col-xs-9">
                                    <div class="contacts-info__item"><a href="tel:4253726570">4253726570</a>
                                        <br><span class="contacts-info__desc">Eastside Division</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="row">
                                <div class="col-xs-1 col-xs-offset-1">
                                    <div class="contacts-info__item"><img src="theme/images/icons/con_phone_icon.png">
                                    </div>
                                </div>
                                <div class="col-xs-9">
                                    <div class="contacts-info__item">
                                        <a href="tel:206-453-9128">206-453-9128</a>
                                        <br><span class="contacts-info__desc">Southside Division (Airport)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="row">
                                <div class="col-xs-1 col-xs-offset-1">
                                    <div class="contacts-info__item"><img src="theme/images/icons/con_mail_icon.png">
                                    </div>
                                </div>
                                <div class="col-xs-9">
                                    <div class="contacts-info__item"><a href="mailto:INFO@SEATTLEELITETOWNCAR.COM">INFO@SEATTLEELITETOWNCAR.COM</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <form method="post" id="quote-form" role="form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="hidden" name="send_quote" value="send"/>
                                    <div class="form-group">
                                        <label for="name" class="sr-only"></label>
                                        <input id="name" type="text" class="form-control required"
                                               placeholder="Your name"
                                               name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="comp-name" class="sr-only"></label>
                                        <input id="comp-name" type="text" class="form-control"
                                               placeholder="Company name (optional)" name="company">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="sr-only"></label>
                                        <input id="phone" type="text" class="form-control required" placeholder="Phone"
                                               name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="mail" class="sr-only"></label>
                                        <input id="mail" type="text" class="form-control required" placeholder="E-mail"
                                               name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="desc" class="sr-only"></label>
                                        <textarea rows="5" id="desc" type="text" class="form-control"
                                                  placeholder="Brief Description of Information Request"
                                                  name="brief"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="vehicle" class="sr-only"></label>
                                        <select id="vehicle" type="text" class="form-control required"
                                                placeholder="Vehicle Type" name="vehicle">
                                            <option value="">Vehicle Type</option>
                                            <option value="Luxury Sedan">Luxury Sedan</option>
                                            <option value="Luxury Suv">Luxury Suv</option>
                                            <option value="Luxury Van">Luxury Van</option>
                                            <option value="Luxury Limousine">Luxury Limousine</option>
                                            <option value="Luxury Bus">Luxury Bus</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="service" class="sr-only"></label>
                                        <select id="service" type="text" class="form-control required"
                                                placeholder="Service type" name="service">
                                            <option value="">Service Type</option>
                                            <option value="Point to point">Point to point</option>
                                            <option value="Wedding">Wedding</option>
                                            <option value="Airport">Airport</option>
                                            <option value="Corporate">Corporate</option>
                                            <option value="Prom">Prom</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group datepicker-wrapper">
                                                <img class="date-icon calendar" src="theme/images/icons/calendar.png">
                                                <label for="date" class="sr-only"></label>
                                                <input id="date" type="text"
                                                       class="form-control datetime datepicker required"
                                                       placeholder="Date"
                                                       name="date">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <img class="date-icon" src="theme/images/icons/calendar-time.png">
                                                <label for="time" class="sr-only"></label>
                                                <input id="time" type="text"
                                                       class="form-control datetime datetimer required"
                                                       placeholder="Time"
                                                       name="time">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div id="submit" class="col-sm-offset-3 col-sm-6 col-xs-12 top-margin">
                                    <div class="form-group">
                                        <button type="submit" value="" class="btn-yellow contact-form__btn">Get a quote
                                        </button>
                                    </div>
                                    <div class="col-xs-12 col-md-12" style="text-align: center">
                                        <span id="total-error" class="valid-error"></span>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('quote-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');
            const messageEl = document.getElementById('total-error');
            const originalBtnText = submitBtn.innerHTML;

            // Показываем индикатор загрузки
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner">Sending...</span>';
            messageEl.style.display = 'none';

            // Собираем данные формы
            const formData = new FormData(form);

            // Добавляем CSRF-токен (если используете)
          //  formData.append('csrf_token', '<?php echo $_SESSION["csrf_token"] ?? ""; ?>');

            // Отправляем AJAX запрос
            fetch('/core/send_quote.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Успешная отправка
                        messageEl.style.color = 'green';
                        messageEl.textContent = data.message || 'Your quote request has been sent!';
                        form.reset();
                    } else {
                        // Ошибка
                        messageEl.style.color = 'red';
                        messageEl.textContent = data.message || 'Error sending request';
                    }
                    messageEl.style.display = 'block';
                })
                .catch(error => {
                    messageEl.style.color = 'red';
                    messageEl.textContent = 'Connection error. Please try again.';
                    messageEl.style.display = 'block';
                    console.error('Error:', error);
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
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
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
