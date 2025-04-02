<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed'));
?>
<?php
$faq_settings = array(
    'page_title' => 'FAQ',
    'reservation_link' => 'reservation.php.html',
    'phone_number' => '(206) 453-9128',
    'email' => 'info@seattleelitetowncar.com',
    'faq_items' => array(
        array(
            'id' => 'faq-0',
            'question' => 'How do I make a town car or limousine reservation?',
            'answer' => 'You can make a reservation on-line under our town car & limo reservations page or by calling us at (206) 453-9128. You can make your reservations at any time. If you are making your reservations online, it must be 24 hours before the scheduled pick up time.'
        ),
        array(
            'id' => 'faq-1',
            'question' => 'Will I receive a confirmation of my reservation?',
            'answer' => 'If you use our online reservation to book your town car or limousine rental, you will receive an e-mail confirmation shortly after your reservation. In the event you do not receive it, please call us at (206) 453-9128.'
        ),
        array(
            'id' => 'faq-2',
            'question' => 'How can I change my reservation?',
            'answer' => 'Please call us at least 3 hours prior to your scheduled pick up to make changes to your trip.'
        ),
        array(
            'id' => 'faq-3',
            'question' => 'What is your cancellation policy?',
            'answer' => 'We require 24 hours advance notice for canceling a town car and 72 hours for limousine reservation. To avoid being charged you must cancel your reservation within cancellation time frame. Phone Cancellation 24 hours prior (Only Mon-Fri 10am-8pm) E-mail your cancellation 24 hours prior'
        ),
        array(
            'id' => 'faq-4',
            'question' => 'Is it safe to give my credit card details online?',
            'answer' => 'All transactions on our web site take place on a secure server using SSL encryption technology to ensure a high level of security when you enter your personal and payment details. To verify that you are shopping in a secure environment, a padlock will appear in your browser.'
        ),
        array(
            'id' => 'faq-5',
            'question' => 'When and how will you charge my credit card?',
            'answer' => 'Your credit card will be charged on the day of the reservation was confirmed. Prepayments can be arranged online for relatives or friends of the traveler. All Airport Town Car and Seattle Limousine Services are satisfaction guaranteed!'
        ),
        array(
            'id' => 'faq-6',
            'question' => 'What if I am unable to arrive in time for a reservation \'No Show\'?',
            'answer' => 'ALL no shows are due to a full charge. To avoid being charged you must call 206.453.9128 24 hours in advance to cancel your reservation.'
        ),
        array(
            'id' => 'faq-7',
            'question' => 'Will I be charged for waiting time?',
            'answer' => 'Our customers are privileged to free waiting time for all the pick ups from the airport. We always monitor flights for the reservations from the ariport to be aware of the arrival time. All non airport pick ups are subjest to a waiting charge after 15 minutes of a free waiting time, it is either additional one hour charge or full amount of the original charge. (all extra waiting charges will be estimated by our operators and explained in the email confirmation).'
        ),
        array(
            'id' => 'faq-8',
            'question' => 'How do I find my driver?',
            'answer' => 'Your uniformed driver will be holding a sign containing your name, which will make it easier for you to find him. Our \'meet and greet\' service will ease your airport travel. In the event that you can not see your driver, please call us and one of our dispatchers can get in touch with the driver and help you to locate each other 425.372.6570. Areas served include: Seattle, Redmond, Kirkland, Issaquah, Sammamish, Bellevue, and all great Seattle area. If you have any further questions, please call us at (206) 453-9128, and one of our operators will provide you will the information that you need. You may also e-mail us at info@seattleelitetowncar.com'
        )
    ),
    'accessibility' => array(
        'skip_link_text' => 'Skip to FAQ content',
        'reserve_btn_text' => 'Reservation',
        'expand_text' => 'Expand question',
        'collapse_text' => 'Collapse question'
    )
);
?>

    <section id="faq" class="faq-section" aria-labelledby="faq-heading">
        <a href="#faq-content" class="skip-link"><?php echo $faq_settings['accessibility']['skip_link_text']; ?></a>

        <div class="content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="header-short">
                            <h2 id="faq-heading" class="header-short__text"><?php echo $faq_settings['page_title']; ?></h2>
                            <div class="header-short__line" aria-hidden="true"></div>
                            <div class="header-short__line" aria-hidden="true"></div>
                            <a href="<?php echo $faq_settings['reservation_link']; ?>" class="btn-yellow header-short__btn">
                                <?php echo $faq_settings['accessibility']['reserve_btn_text']; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap bg-light">
            <div id="faq-content" class="content-wrap">
                <div class="panel-group faq-wrap" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php foreach ($faq_settings['faq_items'] as $index => $faq_item): ?>
                        <div class="panel panel-default faq-block">
                            <div class="panel-heading faq-block__heading<?php echo $index === 0 ? '' : ' collapsed'; ?>"
                                 role="tab"
                                 id="heading-<?php echo $index; ?>"
                                 data-toggle="collapse"
                                 data-parent="#accordion"
                                 href="#<?php echo $faq_item['id']; ?>"
                                 aria-expanded="false"
                                 aria-controls="<?php echo $faq_item['id']; ?>"
                                 class=""
                            >
                                <h4 class="panel-title faq-block__title">
                                        <?php echo $faq_item['question']; ?>
                                        <span class="sr-only"><?php echo $index === 0 ? $faq_settings['accessibility']['collapse_text'] : $faq_settings['accessibility']['expand_text']; ?></span>
                                </h4>
                            </div>
                            <div id="<?php echo $faq_item['id']; ?>"
                                 class="panel-collapse collapse <?php echo $index === 0 ? 'in' : ''; ?>"
                                 role="tabpanel"
                                 aria-labelledby="heading-<?php echo $index; ?>">
                                <div class="panel-body faq-block__body">
                                    <?php echo $faq_item['answer']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';