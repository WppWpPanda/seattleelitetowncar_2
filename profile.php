<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$auth = new Auth();

if (!$auth->isLoggedIn()) {
    header("Location: login.php");
    exit;
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed')); ?>
<style>
    /* Стили для сообщений */
    .alert {
        padding: 10px 15px;
        margin: 10px 0;
        border-radius: 4px;
        text-align: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Стили для спиннера */
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
                            <h2 class="header-short__text">My Account</h2>
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
                    <?php $user = $auth->getUser_by_id($auth->getUser()['id']); ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <form method="post" id="profile-form" role="form" onsubmit="return submitForm(this);">
                                <div class="row">
                                    <input type="hidden" name="send_reg" value="send"/>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="full-name" class="sr-only"></label>
                                            <input id="full-name" type="text" class="form-control required"
                                                   placeholder="Full name" name="name"
                                                   value="<?php echo !empty($user['name']) ? $user['name'] : ''; ?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="address" class="sr-only"></label>
                                            <input id="address" type="text" class="form-control required"
                                                   placeholder="Address" name="address"
                                                   value="<?php echo !empty($user['address']) ? $user['address'] : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="mail" class="sr-only"></label>
                                            <input id="mail" type="text" class="form-control required"
                                                   placeholder="E-mail" name="email"
                                                   value="<?php echo !empty($user['email']) ? $user['email'] : ''; ?>"
                                                   readonly>
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
                                                   name="company"
                                                   value="<?php echo !empty($user['company']) ? $user['company'] : ''; ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <label for="city" class="sr-only"></label>
                                                    <input id="city" type="text" class="form-control required"
                                                           placeholder="City" name="city"
                                                           value="<?php echo !empty($user['city']) ? $user['city'] : ''; ?>">
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
                                                           placeholder="Zip/Postal" name="zip"
                                                           value="<?php echo !empty($user['zip']) ? $user['zip'] : ''; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <label for="mobile" class="sr-only"></label>
                                                    <input id="mobile" type="text" class="form-control required"
                                                           placeholder="Mobile Phone" name="mobile_phone"
                                                           value="<?php echo !empty($user['mobile_phone']) ? $user['mobile_phone'] : ''; ?>">
                                                </div>
                                            </div>

                                            <div class="col-xs-7">
                                                <div class="form-group">
                                                    <label for="day-phone" class="sr-only"></label>
                                                    <input id="day-phone" type="text" class="form-control"
                                                           placeholder="Daytime Phone" name="daytime_phone"
                                                           value="<?php echo !empty($user['daytime_phone']) ? $user['daytime_phone'] : ''; ?>">
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
                                                   placeholder="Name as appear on credit card" name="card_name"
                                                   value="<?php echo !empty($user['card_name']) ? $user['card_name'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row pyment_by_card">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="cc" class="sr-only"></label>
                                            <input id="cc" type="text" class="form-control" placeholder="Credit Card"
                                                   name="card_number"
                                                   value="<?php echo !empty($user['card_number']) ? $user['card_number'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="exp-date" class="sr-only"></label>
                                                <input id="exp-date" type="text" class="form-control"
                                                       placeholder="Exp. date" name="exp_date"
                                                       value="<?php echo !empty($user['exp_date']) ? $user['exp_date'] : ''; ?>">
                                            </div>
                                            <div class="col-xs-3">
                                                <label for="cvv" class="sr-only"></label>
                                                <input id="cvv" class="form-control" type="text" placeholder="CVV"
                                                       name="cvv"
                                                       value="<?php echo !empty($user['cvv']) ? $user['cvv'] : ''; ?>">
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
    <script>

        function validateForm(form) {
            const requiredFields = form.querySelectorAll('.required');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            // Дополнительные проверки
            const email = form.querySelector('[name="email"]');
            if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                email.classList.add('is-invalid');
                isValid = false;
            }

            return isValid;
        }

        function submitForm(form) {
            event.preventDefault();

            // Получаем кнопку отправки и сообщения
            const submitBtn = form.querySelector('button[type="submit"]');
            const messageEl = document.getElementById('form-messages');

            // Сохраняем исходный текст кнопки
            const originalBtnText = submitBtn.innerHTML;

            // Меняем состояние кнопки
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';

            // Скрываем предыдущие сообщения
            messageEl.style.display = 'none';

            // Собираем данные формы
            const formData = new FormData(form);

            // Добавляем CSRF-токен (если используете)
           // formData.append('csrf_token', '<?php echo $_SESSION["csrf_token"] ?? ""; ?>');

            // Отправляем AJAX-запрос
            fetch('/core/update_profile.php', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Успешное обновление
                        messageEl.style.display = 'block';
                        messageEl.className = 'alert alert-success';
                        messageEl.textContent = data.message || 'Profile updated successfully!';

                        // Обновляем значения полей, если сервер вернул обновленные данные
                        if (data.user) {
                            updateFormFields(data.user);
                        }
                    } else {
                        // Ошибка
                        showError(messageEl, data.message || 'Error updating profile');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError(messageEl, 'Network error. Please try again.');
                })
                .finally(() => {
                    // Восстанавливаем кнопку
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
        }

        function showError(element, message) {
            element.style.display = 'block';
            element.className = 'alert alert-danger';
            element.textContent = message;
        }

        function updateFormFields(userData) {
            // Обновляем только те поля, которые могут измениться
            if (userData.name) document.getElementById('full-name').value = userData.name;
            if (userData.address) document.getElementById('address').value = userData.address;
            if (userData.company) document.getElementById('company').value = userData.company;
            if (userData.city) document.getElementById('city').value = userData.city;
            if (userData.state) document.getElementById('state').value = userData.state;
            if (userData.zip) document.getElementById('zip').value = userData.zip;
            if (userData.mobile_phone) document.getElementById('mobile').value = userData.mobile_phone;
            if (userData.daytime_phone) document.getElementById('day-phone').value = userData.daytime_phone;
            if (userData.card_name) document.getElementById('ccname').value = userData.card_name;
            if (userData.card_number) document.getElementById('cc').value = userData.card_number;
            if (userData.exp_date) document.getElementById('exp-date').value = userData.exp_date;
            if (userData.cvv) document.getElementById('cvv').value = userData.cvv;

            // Очищаем пароль после успешного обновления
            document.getElementById('pass').value = '';
        }

        // Установка выбранного значения для штата
        document.addEventListener('DOMContentLoaded', function() {
            const stateSelect = document.getElementById('state');
            const currentState = "<?php echo !empty($user['state']) ? $user['state'] : ''; ?>";
            if (currentState && stateSelect) {
                stateSelect.value = currentState;
            }
        });
    </script>
<?php require_once 'templates/footer.php';