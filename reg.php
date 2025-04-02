<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once 'templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed')); ?>
    <section class="">
        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-short">
                            <h2 class="header-short__text">Registration</h2>
                            <div class="header-short__line"></div>
                            <div class="header-short__line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap bg-light">
            <div class="content-wrap content-wrap--top">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-xs-12">
                            <form method="post" id="reg-form" role="form" onsubmit="return submitForm(this);">
                                <div class="row">
                                    <input type="hidden" name="send_reg" value="send"/>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="full-name" class="sr-only"></label>
                                            <input id="full-name" type="text" class="form-control required"
                                                   placeholder="Full name" name="name">
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="sr-only"></label>
                                            <input id="address" type="text" class="form-control required"
                                                   placeholder="Address" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label for="mail" class="sr-only"></label>
                                            <input id="mail" type="text" class="form-control required"
                                                   placeholder="E-mail" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass" class="sr-only"></label>
                                            <input id="pass" type="password" class="form-control required"
                                                   placeholder="Password" name="password">
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="company" class="sr-only"></label>
                                            <input id="company" type="text" class="form-control" placeholder="Company"
                                                   name="company">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <label for="city" class="sr-only"></label>
                                                    <input id="city" type="text" class="form-control required"
                                                           placeholder="City" name="city">
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label for="state" class="sr-only"></label>
                                                    <select id="state" type="text" class="form-control required"
                                                            placeholder="" name="state">
                                                        <option value="">State</option>
                                                        <option value="AL">Alabama</option>
                                                        <option value="AK">Alaska</option>
                                                        <option value="AZ">Arizona</option>
                                                        <option value="AR">Arkansas</option>
                                                        <option value="CA">California</option>
                                                        <option value="CO">Colorado</option>
                                                        <option value="CT">Connecticut</option>
                                                        <option value="DE">Delaware</option>
                                                        <option value="DC">District Of Columbia</option>
                                                        <option value="FL">Florida</option>
                                                        <option value="GA">Georgia</option>
                                                        <option value="HI">Hawaii</option>
                                                        <option value="ID">Idaho</option>
                                                        <option value="IL">Illinois</option>
                                                        <option value="IN">Indiana</option>
                                                        <option value="IA">Iowa</option>
                                                        <option value="KS">Kansas</option>
                                                        <option value="KY">Kentucky</option>
                                                        <option value="LA">Louisiana</option>
                                                        <option value="ME">Maine</option>
                                                        <option value="MD">Maryland</option>
                                                        <option value="MA">Massachusetts</option>
                                                        <option value="MI">Michigan</option>
                                                        <option value="MN">Minnesota</option>
                                                        <option value="MS">Mississippi</option>
                                                        <option value="MO">Missouri</option>
                                                        <option value="MT">Montana</option>
                                                        <option value="NE">Nebraska</option>
                                                        <option value="NV">Nevada</option>
                                                        <option value="NH">New Hampshire</option>
                                                        <option value="NJ">New Jersey</option>
                                                        <option value="NM">New Mexico</option>
                                                        <option value="NY">New York</option>
                                                        <option value="NC">North Carolina</option>
                                                        <option value="ND">North Dakota</option>
                                                        <option value="OH">Ohio</option>
                                                        <option value="OK">Oklahoma</option>
                                                        <option value="OR">Oregon</option>
                                                        <option value="PA">Pennsylvania</option>
                                                        <option value="RI">Rhode Island</option>
                                                        <option value="SC">South Carolina</option>
                                                        <option value="SD">South Dakota</option>
                                                        <option value="TN">Tennessee</option>
                                                        <option value="TX">Texas</option>
                                                        <option value="UT">Utah</option>
                                                        <option value="VT">Vermont</option>
                                                        <option value="VA">Virginia</option>
                                                        <option value="WA">Washington</option>
                                                        <option value="WV">West Virginia</option>
                                                        <option value="WI">Wisconsin</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="form-group">
                                                    <label for="zip" class="sr-only"></label>
                                                    <input id="zip" type="text" class="form-control required"
                                                           placeholder="Zip/Postal" name="zip">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <label for="mobile" class="sr-only"></label>
                                                    <input id="mobile" type="text" class="form-control required"
                                                           placeholder="Mobile Phone" name="mobile_phone">
                                                </div>
                                            </div>

                                            <div class="col-xs-7">
                                                <div class="form-group">
                                                    <label for="day-phone" class="sr-only"></label>
                                                    <input id="day-phone" type="text" class="form-control"
                                                           placeholder="Daytime Phone" name="daytime_phone">
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <h2 class="reservation-title"><span>Payment Details</span></h2>

                                <div class="row pyment_by_card">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ccname" class="sr-only"></label>
                                            <input id="ccname" type="text" class="form-control"
                                                   placeholder="Name as appear on credit card" name="card_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row pyment_by_card">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cc" class="sr-only"></label>
                                            <input id="cc" type="text" class="form-control" placeholder="Credit Card"
                                                   name="card_number">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="exp-date" class="sr-only"></label>
                                                <input id="exp-date" type="text" class="form-control"
                                                       placeholder="Exp. date" name="exp_date">
                                            </div>
                                            <div class="col-xs-3">
                                                <label for="cvv" class="sr-only"></label>
                                                <input id="cvv" class="form-control" type="text" placeholder="CVV"
                                                       name="cvv">
                                            </div>
                                            <div class="col-xs-3">
                                                <img src="theme/images/icons/contacts_cvv.png" class="img-responsive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="submit" class="col-sm-offset-3 col-sm-6 top-margin">
                                    <div class="form-group">
                                        <button type="submit" class="btn-yellow contact-form__btn">submit</button>
                                    </div>
                                    <div id="form-messages"
                                         style="display: none; text-align: center; margin-top: 15px;"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        #form-messages {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }

        #form-messages.success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        #form-messages.error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
    </style>
    <script>
        document.getElementById('mail').addEventListener('blur', function () {
            const email = this.value.trim();
            if (!email) return;

            fetch('/core/check_email.php?email=' + encodeURIComponent(email))
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        const messageEl = document.getElementById('form-messages');
                        messageEl.style.display = 'block';
                        messageEl.style.color = 'red';
                        messageEl.textContent = 'Этот email уже зарегистрирован';
                    }
                });
        });

        function submitForm(form) {
            // Блокируем стандартную отправку формы
            event.preventDefault();

            // Показываем индикатор загрузки
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Processing...';

            // Скрываем предыдущие сообщения об ошибках
            document.getElementById('form-messages').style.display = 'none';

            // Собираем данные формы
            const formData = new FormData(form);

            // Отправляем AJAX-запрос
            fetch('/core/reg_ajax.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Успешная регистрация - перенаправляем
                        window.location.href = data.redirect || 'registration_success.php';
                    } else {
                        // Показываем ошибку
                        const messageEl = document.getElementById('form-messages');
                        messageEl.style.display = 'block';
                        messageEl.style.color = 'red';
                        messageEl.textContent = data.message;

                        // Возвращаем кнопку в исходное состояние
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'submit';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const messageEl = document.getElementById('form-messages');
                    messageEl.style.display = 'block';
                    messageEl.style.color = 'red';
                    messageEl.textContent = 'Произошла ошибка при отправке формы. Пожалуйста, попробуйте ещё раз.';

                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'submit';
                });

            return false;
        }
    </script>
<?php require_once 'templates/footer.php';