@extends('layouts.app')

@section('content')
    <!-- home wrapper -->
    <div class="home-wrapper">
        <!-- Background Image -->
        <div class="bg-img" style="background-image: url('./img/bg1.png');">
            <div class="overlay"></div>
        </div>
        <!-- /Background Image -->
        <div class="container home-wrapper-content">
            <div class="row">

                <!-- home content -->
                <div class="col-md-10 col-md-offset-1">
                    <div class="home-content">
                        <h1 class="white-text">We Are Creative Agency</h1>
                        <p class="white-text">Morbi mattis felis at nunc. Duis viverra diam non justo. In nisl. Nullam sit amet magna in magna gravida vehicula. Mauris tincidunt sem sed arcu. Nunc posuere.
                        </p>
                        <button class="white-btn">Get Started!</button>
                        <button class="main-btn">Learn more</button>
                    </div>
                </div>
                <!-- /home content -->

            </div>
        </div>
    </div>
    <!-- /home wrapper -->

    <!-- About -->
    <div id="about" class="section md-padding">

        <!-- Container -->
        <div class="container">

            <!-- Row -->
            <div class="row">

                <!-- Section header -->
                <div class="section-header text-center">
                    <h2 class="title">Welcome to Website</h2>
                </div>
                <!-- /Section header -->

                <!-- about -->
                <div class="col-md-4">
                    <div class="about">
                        <i class="fa fa-cogs"></i>
                        <h3>Fully Customizible</h3>
                        <p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero sit amet.</p>
                        <a href="#">Read more</a>
                    </div>
                </div>
                <!-- /about -->

                <!-- about -->
                <div class="col-md-4">
                    <div class="about">
                        <i class="fa fa-magic"></i>
                        <h3>Awesome Features</h3>
                        <p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero sit amet.</p>
                        <a href="#">Read more</a>
                    </div>
                </div>
                <!-- /about -->

                <!-- about -->
                <div class="col-md-4">
                    <div class="about">
                        <i class="fa fa-mobile"></i>
                        <h3>Fully Responsive</h3>
                        <p>Maecenas tempus tellus eget condimentum rhoncus sem quam semper libero sit amet.</p>
                        <a href="#">Read more</a>
                    </div>
                </div>
                <!-- /about -->

            </div>
            <!-- /Row -->

        </div>
        <!-- /Container -->

    </div>
    <!-- /About -->


    <!-- Why Choose Us -->
    <div id="features" class="section md-padding bg-grey">

        <!-- Container -->
        <div class="container">

            <!-- Row -->
            <div class="row">

                <!-- why choose us content -->
                <div class="col-md-6">
                    <div class="section-header">
                        <h2 class="title">Why Choose Us</h2>
                    </div>
                    <p>Molestie at elementum eu facilisis sed odio. Scelerisque in dictum non consectetur a erat. Aliquam id diam maecenas ultricies mi eget mauris. Ultrices sagittis orci a scelerisque purus.</p>
                    <div class="feature">
                        <i class="fa fa-check"></i>
                        <p>Quis varius quam quisque id diam vel quam elementum.</p>
                    </div>
                    <div class="feature">
                        <i class="fa fa-check"></i>
                        <p>Mauris augue neque gravida in fermentum.</p>
                    </div>
                    <div class="feature">
                        <i class="fa fa-check"></i>
                        <p>Orci phasellus egestas tellus rutrum.</p>
                    </div>
                    <div class="feature">
                        <i class="fa fa-check"></i>
                        <p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
                    </div>
                </div>
                <!-- /why choose us content -->

                <!-- About slider -->
                <div class="col-md-6">
                    <div id="about-slider" class="owl-carousel owl-theme">
                        <img class="img-responsive" src="./img/about1.jpg" alt="">
                        <img class="img-responsive" src="./img/about2.jpg" alt="">
                        <img class="img-responsive" src="./img/about1.jpg" alt="">
                        <img class="img-responsive" src="./img/about2.jpg" alt="">
                    </div>
                </div>
                <!-- /About slider -->

            </div>
            <!-- /Row -->

        </div>
        <!-- /Container -->

    </div>
    <!-- /Why Choose Us -->


    <!-- Numbers -->
    <div id="numbers" class="section sm-padding">

        <!-- Background Image -->
        <div class="bg-img" style="background-image: url('./img/background2.jpg');">
            <div class="overlay"></div>
        </div>
        <!-- /Background Image -->

        <!-- Container -->
        <div class="container">

            <!-- Row -->
            <div class="row">

                <!-- number -->
                <div class="col-sm-3 col-xs-6">
                    <div class="number">
                        <i class="fa fa-users"></i>
                        <h3 class="white-text"><span class="counter">451</span></h3>
                        <span class="white-text">Happy clients</span>
                    </div>
                </div>
                <!-- /number -->

                <!-- number -->
                <div class="col-sm-3 col-xs-6">
                    <div class="number">
                        <i class="fa fa-trophy"></i>
                        <h3 class="white-text"><span class="counter">12</span></h3>
                        <span class="white-text">Awards won</span>
                    </div>
                </div>
                <!-- /number -->

                <!-- number -->
                <div class="col-sm-3 col-xs-6">
                    <div class="number">
                        <i class="fa fa-coffee"></i>
                        <h3 class="white-text"><span class="counter">154</span>K</h3>
                        <span class="white-text">Cups of Coffee</span>
                    </div>
                </div>
                <!-- /number -->

                <!-- number -->
                <div class="col-sm-3 col-xs-6">
                    <div class="number">
                        <i class="fa fa-file"></i>
                        <h3 class="white-text"><span class="counter">45</span></h3>
                        <span class="white-text">Projects completed</span>
                    </div>
                </div>
                <!-- /number -->

            </div>
            <!-- /Row -->

        </div>
        <!-- /Container -->

    </div>
    <!-- /Numbers -->

    <!-- Pricing -->
    <div id="pricing" class="section md-padding">

        <!-- Container -->
        <div class="container">

            <!-- Row -->
            <div class="row">

                <!-- Section header -->
                <div class="section-header text-center">
                    <h2 class="title">Pricing Table</h2>
                </div>
                <!-- /Section header -->

                <!-- pricing -->
                <div class="col-sm-4">
                    <div class="pricing">
                        <div class="price-head">
                            <span class="price-title">Basic plan</span>
                            <div class="price">
                                <h3>$9<span class="duration">/ month</span></h3>
                            </div>
                        </div>
                        <ul class="price-content">
                            <li>
                                <p>1GB Disk Space</p>
                            </li>
                            <li>
                                <p>100 Email Account</p>
                            </li>
                            <li>
                                <p>24/24 Support</p>
                            </li>
                        </ul>
                        <div class="price-btn">
                            <button class="outline-btn">Purchase now</button>
                        </div>
                    </div>
                </div>
                <!-- /pricing -->

                <!-- pricing -->
                <div class="col-sm-4">
                    <div class="pricing">
                        <div class="price-head">
                            <span class="price-title">Silver plan</span>
                            <div class="price">
                                <h3>$19<span class="duration">/ month</span></h3>
                            </div>
                        </div>
                        <ul class="price-content">
                            <li>
                                <p>1GB Disk Space</p>
                            </li>
                            <li>
                                <p>100 Email Account</p>
                            </li>
                            <li>
                                <p>24/24 Support</p>
                            </li>
                        </ul>
                        <div class="price-btn">
                            <button class="outline-btn">Purchase now</button>
                        </div>
                    </div>
                </div>
                <!-- /pricing -->

                <!-- pricing -->
                <div class="col-sm-4">
                    <div class="pricing">
                        <div class="price-head">
                            <span class="price-title">Gold plan</span>
                            <div class="price">
                                <h3>$39<span class="duration">/ month</span></h3>
                            </div>
                        </div>
                        <ul class="price-content">
                            <li>
                                <p>1GB Disk Space</p>
                            </li>
                            <li>
                                <p>100 Email Account</p>
                            </li>
                            <li>
                                <p>24/24 Support</p>
                            </li>
                        </ul>
                        <div class="price-btn">
                            <button class="outline-btn">Purchase now</button>
                        </div>
                    </div>
                </div>
                <!-- /pricing -->

            </div>
            <!-- Row -->

        </div>
        <!-- /Container -->

    </div>
    <!-- /Pricing -->

    <!-- Contact -->
    <div id="contact" class="section md-padding">

        <!-- Container -->
        <div class="container">

            <!-- Row -->
            <div class="row">

                <!-- Section-header -->
                <div class="section-header text-center">
                    <h2 class="title">Get in touch</h2>
                </div>
                <!-- /Section-header -->

                <!-- contact -->
                <div class="col-sm-4">
                    <div class="contact">
                        <i class="fa fa-phone"></i>
                        <h3>Phone</h3>
                        <p>512-421-3940</p>
                    </div>
                </div>
                <!-- /contact -->

                <!-- contact -->
                <div class="col-sm-4">
                    <div class="contact">
                        <i class="fa fa-envelope"></i>
                        <h3>Email</h3>
                        <p>email@support.com</p>
                    </div>
                </div>
                <!-- /contact -->

                <!-- contact -->
                <div class="col-sm-4">
                    <div class="contact">
                        <i class="fa fa-map-marker"></i>
                        <h3>Address</h3>
                        <p>1739 Bubby Drive</p>
                    </div>
                </div>
                <!-- /contact -->

                <!-- contact form -->
                <div class="col-md-8 col-md-offset-2">
                    <form class="contact-form">
                        <input type="text" class="input" placeholder="Name">
                        <input type="email" class="input" placeholder="Email">
                        <input type="text" class="input" placeholder="Subject">
                        <textarea class="input" placeholder="Message"></textarea>
                        <button class="main-btn">Send message</button>
                    </form>
                </div>
                <!-- /contact form -->

            </div>
            <!-- /Row -->

        </div>
        <!-- /Container -->

    </div>
    <!-- /Contact -->

@endsection

@section('scripts')
    <script type="text/javascript">
        $("header").addClass("header-transparent");

        ///////////////////////////
        // On Scroll
        $(window).on('scroll', function() {
            var wScroll = $(this).scrollTop();

            // Fixed nav
            wScroll > 1 ? $('#nav').addClass('fixed-nav') : $('#nav').removeClass('fixed-nav');

            // Back To Top Appear
            wScroll > 700 ? $('#back-to-top').fadeIn() : $('#back-to-top').fadeOut();
        });
    </script>
@endsection