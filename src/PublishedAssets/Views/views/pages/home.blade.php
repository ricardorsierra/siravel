@extends('layouts.sierratecnologia')

@section('content')

    @include('partials.status-panel')

    <!-- START ABOUT US DESIGN AREA -->
    <section id="about" class="about-us-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>{{ trans('homepage.about_title') }}</h2>
                        <p>{{ trans('homepage.about_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- START ABOUT IMAGE DESIGN AREA -->
                <div class="col-md-6 wow fadeInLeft" data-wow-delay=".2s">
                    <div class="about-image">
                        <img src="sitec/images/about.png" alt="" class="img-responsive">
                    </div>
                </div>
                <!-- / END ABOUT IMAGE DESIGN AREA -->
                <!-- START ABOUT US TEXT DESIGN AREA -->
                <div class="col-md-6">
                    <div class="about-text wow fadeInUp" data-wow-delay=".2s">
                        <h2>{{ trans('homepage.about_company_title') }}</h2>
                        <p>{{ trans('homepage.about_company_title_description') }}</p>
                    </div>
                </div>
                <!-- / END ABOUT US TEXT DESIGN AREA -->
            </div>
        </div>
    </section>
    <!-- / END ABOUT US DESIGN AREA -->

    <!-- START SERVICES DESIGN AREA -->
    <section id="service" class="service-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>{{ trans('homepage.service_title') }}</h2>
                        <p>{{ trans('homepage.service_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- START SINGLE SERVICES DESIGN AREA -->
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-service">
                        <span class="lnr lnr-rocket"></span>
                        <h4>{{ trans('homepage.service_item1_title') }}</h4>
                        <p>{{ trans('homepage.service_item1_description') }}</p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICES DESIGN AREA -->
                <!-- START SINGLE SERVICES DESIGN AREA -->
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-service">
                        <span class="lnr lnr-layers"></span>
                        <h4>{{ trans('homepage.service_item2_title') }}</h4>
                        <p>{{ trans('homepage.service_item2_description') }}</p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICES DESIGN AREA -->
                <!-- START SINGLE SERVICES DESIGN AREA -->
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="single-service">
                        <span class="lnr lnr-laptop"></span>
                        <h4>{{ trans('homepage.service_item3_title') }}</h4>
                        <p>{{ trans('homepage.service_item3_description') }}</p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICES DESIGN AREA -->
                <!-- START SINGLE SERVICES DESIGN AREA -->
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".8s">
                    <div class="single-service">
                        <span class="lnr lnr-database"></span>
                        <h4>{{ trans('homepage.service_item4_title') }}</h4>
                        <p>{{ trans('homepage.service_item4_description') }}</p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICES DESIGN AREA -->
                <!-- START SINGLE SERVICES DESIGN AREA -->
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="1s">
                    <div class="single-service">
                        <span class="lnr lnr-earth"></span>
                        <h4>{{ trans('homepage.service_item5_title') }}</h4>
                        <p>{{ trans('homepage.service_item5_description') }}</p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICES DESIGN AREA -->
                <!-- START SINGLE SERVICES DESIGN AREA -->
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="1.2s">
                    <div class="single-service">
                        <span class="lnr lnr-bug"></span>
                        <h4>{{ trans('homepage.service_item6_title') }}</h4>
                        <p>{{ trans('homepage.service_item6_description') }}</p>
                    </div>
                </div>
                <!-- / END SINGLE SERVICES DESIGN AREA -->
            </div>
        </div>
    </section>
    <!-- / END SERVICES DESIGN AREA -->

    <!-- START TEAM DESIGN AREA -->
    <section id="team" class="team-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>{{ trans('homepage.team_title')}}</h2>
                        <p>{{ trans('homepage.team_description')}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- START SINGLE TEAM DESIGN AREA -->
                <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="single-team">
                        <img src="https://www.gravatar.com/avatar/{{ md5('mariolive@sierratecnologia.com.br') }}?s=500&d=mm" alt="">
                        <div class="team-description">
                            <h4>{{ trans('homepage.team_item1_name')}}</h4>
                            <h6 class="text-muted">{{ trans('homepage.team_item1_work')}}</h6>
                            <div class="team-social">
                                <ul>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-github"></i></a>
                                    </li>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / END SINGLE TEAM DESIGN AREA -->
                <!-- START SINGLE TEAM DESIGN AREA -->
                <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="single-team">
                        <img src="https://www.gravatar.com/avatar/{{ md5('rafael.bernardo@sierratecnologia.com.br') }}?s=500&d=mm" alt="">
                        <div class="team-description">
                            <h4>{{ trans('homepage.team_item2_name')}}</h4>
                            <h6 class="text-muted">{{ trans('homepage.team_item2_work')}}</h6>
                            <div class="team-social">
                                <ul>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-github"></i></a>
                                    </li>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / END SINGLE TEAM DESIGN AREA -->
                <!-- START SINGLE TEAM DESIGN AREA -->
                <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="single-team">
                        <img src="https://www.gravatar.com/avatar/{{ md5('carol.faria@sierratecnologia.com.br') }}?s=500&d=mm" alt="">
                        <div class="team-description">
                            <h4>{{ trans('homepage.team_item3_name')}}</h4>
                            <h6 class="text-muted">{{ trans('homepage.team_item3_work')}}</h6>
                            <div class="team-social">
                                <ul>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-github"></i></a>
                                    </li>
                                    <li><a href="index.php" target="_BLANK"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / END SINGLE TEAM DESIGN AREA -->
                <!-- START SINGLE TEAM DESIGN AREA -->
                <div class="col-md-3 col-sm-6 wow fadeInUp" data-wow-delay=".8s">
                    <div class="single-team">
                        <img src="https://www.gravatar.com/avatar/{{ md5('ricardo@sierratecnologia.com.br') }}?s=500&d=mm" alt=""> <!-- 500x700 -->
                        <div class="team-description">
                            <h4>{{ trans('homepage.team_item4_name')}}</h4>
                            <h6 class="text-muted">{{ trans('homepage.team_item4_work')}}</h6>
                            <div class="team-social">
                                <ul>
                                    <li><a href="http://ricardosierra.com.br" target="_BLANK"><i class="fa fa-user"></i></a>
                                    </li>
                                    <li><a href="https://twitter.com/sierra91jb" target="_BLANK"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a href="https://github.com/ricardorsierra" target="_BLANK"><i class="fa fa-github"></i></a>
                                    </li>
                                    <li><a href="https://www.instagram.com/ricardorsierra/" target="_BLANK"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / END SINGLE TEAM DESIGN AREA -->
            </div>
        </div>
    </section>
    <!-- / END TEAM DESIGN AREA -->

    <!-- START PRICING DESIGN AREA -->
    <section id="pricing" class="pricing-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>{{ trans('homepage.pricing_title') }}</h2>
                        <p>{{ trans('homepage.pricing_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- START SINGLE PRICING DESIGN AREA -->
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".2s">
                    <div class="pricing-box">
                        <div class="pricing-header">
                            <div class="plan-title">
                                <h4>{{ trans('homepage.pricing_item1_title') }}</h4>
                            </div>
                            <div class="plan-price">
                                {{ trans('homepage.pricing_item1_price') }}
                            </div>
                            <div class="plan-month text-muted">
                                {{ trans('homepage.pricing_item1_pricedescription') }}
                            </div>
                        </div>
                        <ul class="list-unstyled plan-features">
                            <li>{{ trans('homepage.pricing_item1_description_1') }}</li>
                            <li>{{ trans('homepage.pricing_item1_description_2') }}</li>
                            <li>{{ trans('homepage.pricing_item1_description_3') }}</li>
                            <li>{{ trans('homepage.pricing_item1_description_4') }}</li>
                        </ul>
                        <a class="read-more" href="index.php#contact">{{ trans('homepage.service_budget') }}</a>
                    </div>
                </div>
                <!-- / END SINGLE PRICING DESIGN AREA -->
                <!-- START SINGLE PRICING DESIGN AREA -->
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".4s">
                    <div class="pricing-box price-active">
                        <div class="pricing-header">
                            <div class="plan-title">
                                <h4>{{ trans('homepage.pricing_item2_title') }}</h4>
                            </div>
                            <div class="plan-price">
                                {{ trans('homepage.pricing_item2_price') }}
                            </div>
                            <div class="plan-month text-muted">
                                {{ trans('homepage.pricing_item2_pricedescription') }}
                            </div>
                        </div>
                        <ul class="list-unstyled plan-features">
                            <li>{{ trans('homepage.pricing_item2_description_1') }}</li>
                            <li>{{ trans('homepage.pricing_item2_description_2') }}</li>
                            <li>{{ trans('homepage.pricing_item2_description_3') }}</li>
                            <li>{{ trans('homepage.pricing_item2_description_4') }}</li>
                        </ul>
                        <a class="read-more" href="index.php#contact">{{ trans('homepage.service_budget') }}</a>
                    </div>
                </div>
                <!-- / END SINGLE PRICING DESIGN AREA -->
                <!-- START SINGLE PRICING DESIGN AREA -->
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-delay=".6s">
                    <div class="pricing-box">
                        <div class="pricing-header">
                            <div class="plan-title">
                                <h4>{{ trans('homepage.pricing_item3_title') }}</h4>
                            </div>
                            <div class="plan-price">
                                {{ trans('homepage.pricing_item3_price') }}
                            </div>
                            <div class="plan-month text-muted">
                                {{ trans('homepage.pricing_item3_pricedescription') }}
                            </div>
                        </div>
                        <ul class="list-unstyled plan-features">
                            <li>{{ trans('homepage.pricing_item3_description_1') }}</li>
                            <li>{{ trans('homepage.pricing_item3_description_2') }}</li>
                            <li>{{ trans('homepage.pricing_item3_description_3') }}</li>
                            <li>{{ trans('homepage.pricing_item3_description_4') }}</li>
                        </ul>
                        <a class="read-more" href="index.php#contact">{{ trans('homepage.service_budget') }}</a>
                    </div>
                </div>
                <!-- / END SINGLE PRICING DESIGN AREA -->
            </div>
        </div>
    </section>
    <!-- / END PRICING DESIGN AREA -->

    <!-- START CONTACT DESIGN AREA -->
    <section id="contact" class="contact-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>{{ trans('homepage.contact_title') }}</h2>
                        <p>{{ trans('homepage.contact_description') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- START CONTACT DETAILS DESIGN AREA -->
                <div class="contact-details-area wow fadeInUp" data-wow-delay=".2s">
                    <div class="col-md-4 col-sm-6">
                        <div class="single-contact-details">
                            <span class="lnr lnr-phone-handset"></span>
                            <h4>{{ trans('homepage.contact_phone') }}</h4>
                            <p class="text-muted">+55 21 24283883</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-contact-details">
                            <span class="lnr lnr-envelope"></span>
                            <h4>{{ trans('homepage.contact_email') }}</h4>
                            <p class="text-muted">contato@sierratecnologia.com.br</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-contact-details">
                            <span class="lnr lnr-map-marker"></span>
                            <h4>{{ trans('homepage.contact_address') }}</h4>
                            <p class="text-muted">Estrada do Morgado, Vargem Grande, Rio de Janeiro, Brasil</p>
                        </div>
                    </div>
                </div>
                <!-- / END CONTACT DETAILS DESIGN AREA -->
            </div>
            <div class="row contact-form-design-area wow fadeInUp">
                <!-- START CONTACT FORM DESIGN AREA -->
                <div class="col-md-12">
                    <div class="contact-form">
                        <form id="contact-form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                                    <input type="text" name="name" class="form-control" id="first-name" placeholder="{{ trans('homepage.contact_name') }}" required="required">
                                </div>
                                <div class="form-group col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="{{ trans('homepage.contact_email') }}" required="required">
                                </div>
                                <div class="form-group col-md-12 wow fadeInUp" data-wow-delay="0.6s">
                                    <textarea rows="6" name="message" class="form-control" id="description" placeholder="{{ trans('homepage.contact_message') }}" required="required"></textarea>
                                </div>
                                <div class="col-md-12 text-center wow fadeInUp" data-wow-delay="0.8s">
                                    <div class="actions">
                                        <input type="submit" value="{{ trans('homepage.contact_submit') }}" name="submit" id="submitButton" class="btn btn-lg btn-contact-bg" title="{{ trans('homepage.contact_submit') }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /END  CONTACT DETAILS DESIGN AREA -->
            </div>
        </div>
    </section>
    <!-- / END CONTACT DESIGN AREA -->

@stop