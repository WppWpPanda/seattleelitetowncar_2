<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once 'templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed')); ?>
    <div class="content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="header-short">
                        <h2 class="header-short__text">Reservation</h2>
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
                        <form method="post" id="reservation-form" role="form">
                            <h1 class="contact-form__top">Complete your reservation now.</h1>
                            <h2 class="reservation-title"><span>Passenger information</span></h2>
                            <div class="row">
                                <input type="hidden" name="send_reservation" value="send"/>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="full-name" class="sr-only"></label>
                                        <input id="full-name" type="text" class="form-control required"
                                               placeholder="Full name" name="name" required/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="company" class="sr-only"></label>
                                        <input id="company" type="text" class="form-control" placeholder="Company"
                                               name="company">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="address" class="sr-only"></label>
                                        <input id="address" type="text" class="form-control required"
                                               placeholder="Address" name="address" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="mail" class="sr-only"></label>
                                        <input id="mail" type="text" class="form-control required" placeholder="E-mail"
                                               name="email" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="mobile" class="sr-only"></label>
                                        <input id="mobile" type="text" class="form-control required"
                                               placeholder="Mobile Phone" name="mobile_phone" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="day-phone" class="sr-only"></label>
                                        <input id="day-phone" type="text" class="form-control"
                                               placeholder="Daytime Phone" name="daytime_phone">
                                    </div>
                                </div>
                            </div>
                            <h2 class="reservation-title"><span>Ride details</span></h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="vehicle" class="sr-only"></label>
                                        <select id="vehicle" type="text" class="form-control required"
                                                placeholder="Vehicle Type" name="vehicle" required>
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
                                                placeholder="Service type" name="service" required>
                                            <option value="">Service Type</option>
                                            <option value="Point to point">Point to point</option>
                                            <option value="Wedding">Wedding</option>
                                            <option value="Airport">Airport</option>
                                            <option value="Corporate">Corporate</option>
                                            <option value="Prom">Prom</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="pickup"><span class="pickup__text"> Pickup :</span>
                                            <div class="agreed">
                                                <div class="agreed__checkbox"><span class=""></span></div>
                                                <div class="agreed__text">Use the address information listed above</div>
                                            </div>
                                        </div>
                                        <div class="label-wrap label-wrap--left">
                                            <label class="btn active custom-radio-btn">
                                                <input type="radio" data-show="#pickup_street"
                                                       data-hide="#pickup_airport" name='pickup' checked value="street"><i
                                                        class="fa fa-circle-o"></i><i
                                                        class="fa fa-dot-circle-o"></i><span>Street address</span>
                                            </label>
                                            <label class="btn custom-radio-btn">
                                                <input type="radio" data-show="#pickup_airport"
                                                       data-hide="#pickup_street" name='pickup' value="airport"><i
                                                        class="fa fa-circle-o "></i><i
                                                        class="fa fa-dot-circle-o"></i><span>Airport</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div id="pickup_street">
                                        <div class="form-group">
                                            <label for="address2" class="sr-only"></label>
                                            <input id="address2" type="text" class="form-control required_s required"
                                                   placeholder="Address" name="pickup_address">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="sr-only"></label>
                                            <input id="phone" type="text" class="form-control" placeholder="Phone"
                                                   name="pickup_phone">
                                        </div>
                                    </div>
                                    <div id="pickup_airport">
                                        <div class="form-group">
                                            <label for="airport" class="sr-only"></label>
                                            <input id="airport" type="text" class="form-control required_a"
                                                   placeholder="Airport name or code" name="pickup_airport">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <div class="form-group">
                                                    <label for="airline" class="sr-only"></label>
                                                    <input id="airline" type="text" class="form-control required_a"
                                                           placeholder="Airline name" name="pickup_airline">
                                                </div>
                                            </div>
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <label for="flight" class="sr-only"></label>
                                                    <input id="flight" type="text" class="form-control required_a"
                                                           placeholder="Flight #" name="pickup_flight_number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="greet" class="sr-only"></label>
                                            <select id="greeting" type="text" class="form-control"
                                                    name="pickup_greeting">
                                                <option value="">Pickup Type</option>
                                                <option value="Meet and greet">Meet and greet</option>
                                                <option value="Curbside pickup">Curbside pickup</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <img class="date-icon calendar" src="theme/images/icons/calendar.png">
                                                <label for="date" class="sr-only"></label>
                                                <input id="date" type="text"
                                                       class="form-control datetime datepicker required"
                                                       placeholder="Date" name="date" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <img class="date-icon" src="theme/images/icons/calendar-time.png">
                                                <label for="time" class="sr-only"></label>
                                                <input id="time" type="text"
                                                       class="form-control datetime datetimer required"
                                                       placeholder="Time" name="time" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="#pass" class="sr-only"></label>
                                                <input id="#pass" type="text" class="form-control required"
                                                       placeholder="# of Pass" name="passengers" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="#bag" class="sr-only"></label>
                                                <input id="#bag" type="text" class="form-control required"
                                                       placeholder="# of Bags" name="bags" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="pickup"><span class="pickup__text"> Destination: </span>
                                        </div>
                                        <div class="label-wrap label-wrap--left">
                                            <label class="btn active custom-radio-btn">
                                                <input id="pickup_radio" data-show="#destination_street"
                                                       data-hide="#destination_airport" type="radio" name='destination'
                                                       checked value="street"><i
                                                        class="fa fa-circle-o"></i><i
                                                        class="fa fa-dot-circle-o"></i><span>Street address</span>
                                            </label>
                                            <label class="btn custom-radio-btn">
                                                <input id="dest_radio" data-show="#destination_airport"
                                                       data-hide="#destination_street" type="radio" name='destination'
                                                       value="airport"><i class="fa fa-circle-o "></i><i
                                                        class="fa fa-dot-circle-o"></i><span>Airport</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div id="destination_street">
                                        <div class="form-group">
                                            <label for="address4" class="sr-only"></label>
                                            <input id="address4" type="text" class="form-control required_s required"
                                                   placeholder="Address" name="destination_address">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="sr-only"></label>
                                            <input id="phone" type="text" class="form-control" placeholder="Phone"
                                                   name="destination_phone">
                                        </div>
                                    </div>
                                    <div id="destination_airport">
                                        <div class="form-group">
                                            <label for="airport" class="sr-only"></label>
                                            <input id="airport" type="text" class="form-control required_a"
                                                   placeholder="Airport name or code" name="destination_airport">
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <div class="form-group">
                                                    <label for="airline" class="sr-only"></label>
                                                    <input id="airline" type="text" class="form-control required_a"
                                                           placeholder="Airline name" name="destination_airline">
                                                </div>
                                            </div>
                                            <div class="col-xs-5">
                                                <div class="form-group">
                                                    <label for="flight" class="sr-only"></label>
                                                    <input id="flight" type="text" class="form-control required_a"
                                                           placeholder="Flight #" name="destination_flight_number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="reservation-title"><span>Payment Details</span></h2>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="label-wrap form-group">
                                        <label class="btn active custom-radio-btn">
                                            <input type="radio" name='payment' checked value="credit_card"><i
                                                    class="fa fa-circle-o"></i><i
                                                    class="fa fa-dot-circle-o"></i><span>Credit Card</span>
                                        </label>
                                        <label class="btn custom-radio-btn">
                                            <input type="radio" name='payment' value="direct_billing"><i
                                                    class="fa fa-circle-o "></i><i
                                                    class="fa fa-dot-circle-o"></i><span>Direct Billing</span>
                                        </label>
                                        <label class="btn custom-radio-btn">
                                            <input type="radio" name='payment' value="cash"><i
                                                    class="fa fa-circle-o "></i><i
                                                    class="fa fa-dot-circle-o"></i><span>Cash/Check(WA State Only)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row pyment_by_card">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="ccname" class="sr-only"></label>
                                        <input id="ccname" type="text" class="form-control required_c required"
                                               placeholder="Name as appear on credit card" name="card_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row pyment_by_card">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cc" class="sr-only"></label>
                                        <input id="cc" type="number" class="form-control required_c required"
                                               placeholder="Credit Card Number" name="card_number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label for="exp-date" class="sr-only"></label>
                                            <input id="exp-date" type="text" class="form-control required_c required"
                                                   placeholder="Exp. date" name="exp_date">
                                        </div>
                                        <div class="col-xs-3">
                                            <label for="cvv" class="sr-only"></label>
                                            <input id="cvv" class="form-control required_c required" type="text"
                                                   placeholder="CVV" name="cvv">
                                        </div>
                                        <div class="col-xs-3">
                                            <img src="theme/images/icons/contacts_cvv.png" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group agreed pyment_by_card" id="billing-same">
                                <div class="agreed__checkbox"><span class="agreed__checked"></span></div>
                                <div class="agreed__text">Billing same as in passenger's info</div>
                            </div>
                            <div class="row hidden pyment_by_card">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="address3" class="sr-only"></label>
                                        <input id="address3" type="text" class="form-control" placeholder="Address"
                                               name="billing_address">
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="form-group">
                                                <label for="city3" class="sr-only"></label>
                                                <input id="city3" type="text" class="form-control" placeholder="City"
                                                       name="billing_city">
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label for="state3" class="sr-only"></label>
                                                <select id="state3" type="text" class="form-control" placeholder=""
                                                        name="billing_state">
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
                                                <label for="zip3" class="sr-only"></label>
                                                <input id="zip3" type="text" class="form-control"
                                                       placeholder="Zip/Postal" name="billing_zip">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <h2 class="reservation-title"><span>Additional information</span></h2>
                            <div class="row">
                                <div class="col-xs-12">
                                <textarea name="additional_info" style="width:100%;" class="add-info" placeholder="Please list all additional stops, description of required services and any other accommodations that you
                                    may need."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="add-agree">
                                        By submiting this form you agreed that : (1) you are the credit card holder and
                                        (2) that you are
                                        requesting the services listed above and (3) that you are authorizing this card
                                        to be used for the
                                        requested services.<br>

                                        <div class="agreed">
                                            <label for="submit_agree" class="agreed__checkbox"><span
                                                        class=""></span></label>
                                            <div class="agreed__text">I agree</div>
                                            <input id="submit_agree" type="checkbox" class="hidden" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="submit" class="col-sm-offset-3 col-sm-6 top-margin">
                                <div class="form-group">
                                    <button type="submit" value="" class="btn-yellow contact-form__btn">submit</button>
                                </div>
                                <div class="col-xs-12 col-md-12" style="text-align: center"><span id="total-error"
                                                                                                  class="valid-error"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';