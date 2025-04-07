<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once 'templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed')); ?>
<style>
    .valid-error {
        display: none;
        padding: 10px;
        margin-top: 10px;
        border-radius: 4px;
        text-align: center;
    }

    .spinner-border {
        display: inline-block;
        width: 1rem;
        height: 1rem;
        vertical-align: text-bottom;
        border: 0.2em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
    }

    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }
</style>
    <section class="">
        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-short">
                            <h2 class="header-short__text">Contact Us</h2>
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
                                        <div class="contacts-info__item"><img
                                                    src="/assets/images/icons/con_phone_icon.png"></div>
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
                                        <div class="contacts-info__item"><img
                                                    src="/assets/images/icons/con_phone_icon.png"></div>
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
                                        <div class="contacts-info__item"><img
                                                    src="/assets/images/icons/con_mail_icon.png"></div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="contacts-info__item"><a href="mailto: INFO@SEATTLEELITETOWNCAR.COM">INFO@SEATTLEELITETOWNCAR.COM</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <form method="post" id="contact-form" role="form">
                                <div class="row">
                                    <input type="hidden" name="send_contact" value="send"/>
                                    <div class="col-sm-offset-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="name" class="sr-only"></label>
                                            <input id="name" type="text" class="form-control required"
                                                   placeholder="Your name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="comp-name" class="sr-only"></label>
                                            <input id="comp-name" type="text" class="form-control"
                                                   placeholder="Company name (optional)" name="company">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="sr-only"></label>
                                            <input id="phone" type="text" class="form-control required"
                                                   placeholder="Phone" name="phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="mail" class="sr-only"></label>
                                            <input id="mail" type="text" class="form-control required"
                                                   placeholder="E-mail" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="desc" class="sr-only"></label>
                                            <textarea rows="5" id="desc" type="text" class="form-control required"
                                                      placeholder="Brief Description of Information Request"
                                                      name="brief"></textarea>
                                        </div>
                                    </div>
                                    <div class=" col-sm-offset-3 col-sm-6">
                                        <div class="form-group">
                                            <button type="submit" value="" class="btn-yellow contact-form__btn">submit
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
    </section>
<script>
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = form.querySelector('button[type="submit"]');
        const messageEl = document.getElementById('total-error');
        const originalBtnText = submitBtn.innerHTML;

        // Показываем индикатор загрузки
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';
        messageEl.style.display = 'none';

        // Собираем данные формы
        const formData = new FormData(form);

        // Отправляем AJAX запрос
        fetch('/core/send_contact.php', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Успешная отправка
                    messageEl.style.color = 'green';
                    messageEl.textContent = data.message;
                    messageEl.style.display = 'block';

                    // Очищаем форму
                    form.reset();
                } else {
                    // Ошибка
                    messageEl.style.color = 'red';
                    messageEl.textContent = data.message;
                    messageEl.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageEl.style.color = 'red';
                messageEl.textContent = 'An error occurred. Please try again.';
                messageEl.style.display = 'block';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            });
    });
</script>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';