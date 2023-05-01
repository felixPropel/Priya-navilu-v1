@extends('webLayout.webApp')
@section('content')
    <button class="floating-button bounce-top" onclick="ScrollElement(this)"><i class="icon-arrow-down"></i></button>
    <div class="col-12 p-0 image-container">

        <div class="head-container">
            <h1 class="animate-gradient">Educate Customer First</h1>
            <span>Sales Comes Next</span>
        </div>
        <!-- One -->
        <!-- //////////////////////// -->
        <!-- catelogue one by Dhana -->
        <div class="sub-image-container">
            <?php
    $count = 0;
    for ($i = 0; $i < count($catloguePosts); $i++) {
      if ($count == 0 ) {
        $count=1;
       ?>

            <div class="inside-sub-image-container img-long" dub_id="img_{{ $catloguePosts[$i]->id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $catloguePosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $catloguePosts[$i]->medium_thumbnail }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Catlogue)</span></div>
            </div>
            <?php
        } elseif ($count == 1) {
$count=2;
        
          ?>

            <div class="inside-sub-image-container img-normal"
                dub_id="img_{{ $catloguePosts[$i]->id }} onclick="window.location.href='{{ route('serachingByPostId', ['key' => $catloguePosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $catloguePosts[$i]->medium_thumbnail }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Catlogue)</span></div>
            </div>
            <?php
        } else {

      $count=0;
          ?>
            <div class="inside-sub-image-container img-short"
                dub_id="img_{{ $catloguePosts[$i]->id }} onclick="window.location.href='{{ route('serachingByPostId', ['key' => $catloguePosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $catloguePosts[$i]->medium_thumbnail }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Catlogue)</span></div>
            </div>
            <?php
      }
    }

    ?>
        </div>
        <!-- //////////////////////// -->
        <!-- Two -->
        <!-- //////////////////////// -->
        <!-- knowledgeBase one by Dhana -->
        <div class="sub-image-container">
            <?php
    $count = 0;

    for ($i = 0; $i < count($knowledgeBasedPosts); $i++) {
      $knowledgeImage = $knowledgeBasedPosts[$i]->medium_thumbnail;
      $kdub_id = $knowledgeBasedPosts[$i]->id;
      if ($count == 0) {
        $count = 1;
        ?>
            <div class="inside-sub-image-container img-long" dub_id="{{ $kdub_id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $knowledgeBasedPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $knowledgeImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Knowledge Base)</span></div>
            </div>
            <?php
        } elseif ($count == 1) {
          $count = 0;
          ?>
            <div class="inside-sub-image-container img-normal" dub_id="{{ $kdub_id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $knowledgeBasedPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $knowledgeImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Knowledge Base)</span></div>
            </div>
            <?php
      }
    }

    ?>
        </div>
        <!-- //////////////////////// -->


        <!-- Three -->

        <div class="sub-image-container mobile mobileA">
            {{-- @foreach ($kitchenPosts as $kitchenPost)

    <div class="inside-sub-image-container img-long" onclick="window.location.href='{{ route('serachingByPostId', ['key' => $kitchenPost->id]) }}'">
      <img  loading="lazy" src="{{$kitchenPost->medium_thumbnail}}" alt="">
      <div class="black-overlay"></div>
      <div class="image-info"><span>(Kitchen)</span></div>
    </div>

    @endforeach --}}

            <?php
    $count = 0;

    for ($i = 0; $i < count($kitchenPosts); $i++) {
      $kitchenImage = $kitchenPosts[$i]->medium_thumbnail;
      $kndub_id = $kitchenPosts[$i]->id;
      if ($count == 0) {
        $count = 1;
        ?>
            <div class="inside-sub-image-container img-long" dub_id="{{ $kndub_id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $kitchenPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $kitchenImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Kitchen)</span></div>
            </div>
            <?php
        } elseif ($count == 1) {
          $count = 0;
          ?>
            <div class="inside-sub-image-container img-short"
                dub_id="{{ $kndub_id }} onclick="window.location.href='{{ route('serachingByPostId', ['key' => $kitchenPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $kitchenImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Kitchen)</span></div>
            </div>
            <?php
      }
    }

    ?>



        </div>

        <!-- Four -->

        <div class="sub-image-container mobile mobileB">
            {{-- @foreach ($tilePosts as $tilePost)

    <div class="inside-sub-image-container img-normal" onclick="window.location.href='{{ route('serachingByPostId', ['key' => $tilePost->id]) }}'">
      <img  loading="lazy" src="{{ $tilePost->medium_thumbnail}}" alt="">
      <div class="black-overlay"></div>
      <div class="image-info"><span>(Tiles)</span></div>
    </div>

    @endforeach --}}

            <?php
    $count = 0;

    for ($i = 0; $i < count($tilePosts); $i++) {
      $tileImage = $tilePosts[$i]->medium_thumbnail;
      $tdub_id = $tilePosts[$i]->id;
      if ($count == 0) {
        $count = 1;
        ?>
            <div class="inside-sub-image-container img-normal" dub_id="{{ $tdub_id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $tilePosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $tileImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Tile)</span></div>
            </div>
            <?php
        } elseif ($count == 1) {
          $count = 0;
          ?>
            <div class="inside-sub-image-container img-short" dub_id="{{ $tdub_id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $tilePosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $tileImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Tile)</span></div>
            </div>
            <?php
      }
    }

    ?>

        </div>

        <!-- Five -->

        <div class="sub-image-container mobile mobileA">
            {{-- @foreach ($fittingPosts as $fittingPost)

    <div class="inside-sub-image-container img-long" onclick="window.location.href='{{ route('serachingByPostId', ['key' => $fittingPost->id]) }}'">
      <img  loading="lazy" src="{{ $fittingPost->medium_thumbnail}}" alt="">
      <div class="black-overlay"></div>
      <div class="image-info"><span>(Fittings)</span></div>
    </div>

    @endforeach --}}

            <?php
    $count = 0;

    for ($i = 0; $i < count($fittingPosts); $i++) {
      $fittingImage = $fittingPosts[$i]->medium_thumbnail;
      $fdub_id= $fittingPosts[$i]->id;
      if ($count == 0) {
        $count = 1;
        ?>
            <div class="inside-sub-image-container img-long" dub_id="{{ $fdub_id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $fittingPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $fittingImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Fitting)</span></div>
            </div>
            <?php
        } elseif ($count == 1) {
          $count = 0;
          ?>
            <div class="inside-sub-image-container img-short" dub_id="{{ $fdub_id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $fittingPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $fittingImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Fitting)</span></div>
            </div>
            <?php
      }
    }

    ?>
        </div>

        <!-- Six -->

        <div class="sub-image-container ">
            <?php
    $count = 0;

    for ($i = 0; $i < count($showroomPosts); $i++) {
      $showroomImage = $showroomPosts[$i]->medium_thumbnail;
      $sdub_id = $showroomPosts[$i]->id;
      if ($count == 0) {
        $count = 1;
        ?>
            <div class="inside-sub-image-container img-long" dub_id="{{ $sdub_id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $showroomPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $showroomImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Showrooom)</span></div>
            </div>
            <?php
        } elseif ($count == 1) {
          $count = 0;
          ?>
            <div class="inside-sub-image-container img-normal" dub_id="{{ $sdub_id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $showroomPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $showroomImage }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Showroom)</span></div>
            </div>
            <?php
      }
    }

    ?>
        </div>

        <!-- Seven -->

        <div class="sub-image-container">
            <?php
    $count = 0;

    for ($i = 0; $i < count($awardPosts); $i++) {

      if ($count == 0) {
        $count = +2;
        ?>
            <div class="inside-sub-image-container img-long " dub_id="{{ $awardPosts[$i]->id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $awardPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $awardPosts[$i]->medium_thumbnail }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Award)</span></div>
            </div>
            <?php
          } elseif ($count == 2) {
            $count = +1;
            ?>
            <div class="inside-sub-image-container img-normal" dub_id="{{ $awardPosts[$i]->id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $awardPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $awardPosts[$i]->medium_thumbnail }}" alt="">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Award)</span></div>
            </div>
            <?php
        } else {
          $count = 0;
          ?>
            <div class="inside-sub-image-container img-short" dub_id="{{ $awardPosts[$i]->id }}"
                onclick="window.location.href='{{ route('serachingByPostId', ['key' => $awardPosts[$i]->id]) }}'">
                <img loading="lazy" src="{{ $awardPosts[$i]->medium_thumbnail }}" alt="n">
                <div class="black-overlay"></div>
                <div class="image-info"><span>(Award)</span></div>
            </div>
            <?php
      }
    }

    ?>

        </div>
    </div>
    <div class="navilu-items">

        <!-- iTEM 1 -->

        <div class="navilu-item navilu-item-1">

            <div class="navilu-below-image-container">
                <div id="carouselExampleInterval" class="carousel slide " data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $i = 2000; ?>
                        @foreach ($kitchenSamplePosts as $kitchenSamplePost)
                            <div samp="{{ $loop->iteration }}" class="carousel-item <?php echo $i == 2000 ? 'active' : ''; ?>"
                                data-interval="<?php echo $i; ?>">
                                <img loading="lazy" src="{{ $kitchenSamplePost->large_thumbnail }}"
                                    class="d-block w-100" alt="...">
                            </div>
                            <?php $i = $i - 1000; ?>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="navilu-container-info">
                <h1 class="container-h1 h1"><span class="text-dark kitchen"> Kitchen </span></h1>
                <p class="text-dark">"A kitchen without tiles is like a cake without frosting - it's just not quite
                    complete."</p>
                <div id="container">
                    <button class="learn-more">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <a href="{{ route('serachingKeyword', ['key' => 'Kitchen']) }}"> <span
                                class="button-text">Explore More</span></a>
                    </button>
                </div>
            </div>

        </div>
        <div class="navilu-item navilu-item-2">

            <div class="navilu-container-info">
                <h1 class="container-h1"><span class="text-dark tiles"> </span>Tiles<span class="text-dark"> </span>
                </h1>
                <p class="text-dark">Our tiles are known for the strength and durability.</p>
                <div id="containerA">
                    <button class="learn-more">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <a href="{{ route('serachingKeyword', ['key' => 'Tile']) }}"> <span class="button-text">Explore
                                More</span></a>
                    </button>
                </div>
            </div>

            <div class="navilu-below-image-container">

                <div id="carouselExampleIntervala" class="carousel slide " data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $i = 2000; ?>
                        @foreach ($tileSamplePosts as $tileSamplePost)
                            <div class="carousel-item <?php echo $i == 2000 ? 'active' : ''; ?>" data-interval="<?php echo $i; ?>">
                                <img loading="lazy" src="{{ $tileSamplePost->large_thumbnail }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            <?php $i = $i - 1000; ?>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIntervala" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIntervala" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="navilu-item navilu-item-3">
            <div class="navilu-below-image-container">
                <div id="carouselExampleIntervalb" class="carousel slide " data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $i = 2000; ?>
                        @foreach ($fittingSamplePosts as $fittingSamplePost)
                            <div class="carousel-item <?php echo $i == 2000 ? 'active' : ''; ?>" data-interval="<?php echo $i; ?>">
                                <img loading="lazy" src="{{ $fittingSamplePost->large_thumbnail }}"
                                    class="d-block w-100" alt="...">
                            </div>
                            <?php $i = $i - 1000; ?>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIntervalb" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIntervalb" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="navilu-container-info">
                <h1 class="container-h1"><span class="text-dark fitting"> </span>Fitting<span class="text-dark"> </span>
                </h1>
                <p class="text-dark">A house is built of logs and stone, of tiles and posts and piers; a home is built of
                    loving deeds that stand a thousand years.</p>
                <div id="containerB">
                    <button class="learn-more">
                        <span class="circle" aria-hidden="true">
                            <span class="icon arrow"></span>
                        </span>
                        <a href="{{ route('serachingKeyword', ['key' => 'Fitting']) }}"><span class="button-text">Explore
                                More</span></a>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <div class="aboutUs " id="aboutUs">
            <div>
                <h4 class="text-white text-center" style="font-weight:bold;text-decoration:underline;"> About Us</h4>
                <p class="text-white">
                    NAVILU established in the year 1987 is an exclusive outlet for superior quality Tiles, Indian and
                    Imported Marbles, Granites Sanitary ware, Tap Fittings and enchanting Elevation Stones. We at NAVILU are
                    professionals in selecting unique and high quality products.
                </p>
            </div>
            <div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="imgCarousel" class="owl-carousel">

                                @foreach ($awardPosts as $awards)
                                    <div class="about-img">
                                        <img loading="lazy" src="{{ $awards->medium_thumbnail }}" alt="Image 1">
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="aboutUs " id="contactUs">

            <div class="child">
                <iframe
                    src="https://forms.zohopublic.in/navilu/form/ContactForm/formperma/L5r0CA95_IPc23e4wW4JteoMfZebT6NoDEIDDSD3PQI"
                    frameborder="0" width="600"></iframe>
            </div>
            <div class="child ">
                <h4 class="text-white text-center" style="font-weight:bold;text-decoration:underline;"> Get in Touch</h4>
                <p class="text-white text-center">Connection is why we're here; it is what gives purpose and meaning to our
                    lives.</p>
            </div>

        </div>
        <div class="address-footer " id="showroom">
            @foreach ($showroomMasterModels as $showroom)
                <div class="child-footer">
                    <h4 class="header-address text-bold " style="text-align: center">{{ $showroom['name'] }}</h4>
                    <span style="max-width:300px;">{{ $showroom['showroom_address'] }}</span>
                    <span>{{ $showroom['email_id'] }}</span>
                    <span>
                        {{ $showroom['contact_number'] }}
                    </span>
                    <div class="iframe_container"><?php echo $showroom['geo_location']; ?></span>
                    </div>
                </div>
            @endforeach

        </div>
    </footer>

    <script>
        $("body").removeAttr('style');

        var simgc = $(".sub-image-container");
        for (let y = 0; y < simgc.length; y++) {
            var isimgcl = simgc[y].querySelectorAll('.img-long');
            var isimgcn = simgc[y].querySelectorAll('.img-normal');
            var isimgcs = simgc[y].querySelectorAll('.img-short');
            // console.log(isimgc.length);
            for (let i = 0; i < isimgcl.length; i++) {
                if (i == 0) {
                    isimgcl[i].style.display = "flex";
                    isimgcl[i].classList.add("slide-top")
                } else {
                    isimgcl[i].style.display = "none";
                }
            }
            for (let i = 0; i < isimgcn.length; i++) {
                if (i == 0) {
                    isimgcn[i].style.display = "flex";
                    isimgcn[i].classList.add("slide-top")
                } else {
                    isimgcn[i].style.display = "none";
                }
            }
            for (let i = 0; i < isimgcs.length; i++) {
                if (i == 0) {
                    isimgcs[i].style.display = "flex";
                    isimgcs[i].classList.add("slide-top");
                } else {
                    isimgcs[i].style.display = "none";
                }
            }
        }
        setInterval(topSlide, 1500);
        var slide = 0;

        function topSlide() {
            // for (let y = 0; y < simgc.length; y++) {

            // }

            if (slide > simgc.length - 1) {
                slide = 0;
            }
            animationSlide(slide);
            // alert(slide);
            slide++;
        }
        var Count = 0;

        function animationSlide(y) {


            // var simgc=$(".sub-image-container");



            var isimgcl = simgc[y].querySelectorAll('.img-long');
            var isimgcn = simgc[y].querySelectorAll('.img-normal');
            var isimgcs = simgc[y].querySelectorAll('.img-short');
            Count++;

            for (let i = 0; i < isimgcl.length; i++) {
                let AdaptiveCount = Count;
                if (Count >= isimgcl.length) {
                    AdaptiveCount = Count % isimgcl.length;
                }

                if (i == AdaptiveCount) {
                    isimgcl[i].style.display = "flex";
                    isimgcl[i].classList.add("slide-top")
                } else {
                    isimgcl[i].style.display = "none";
                }
            }

            for (let i = 0; i < isimgcn.length; i++) {
                let AdaptiveCount = Count;
                if (Count >= isimgcn.length) {
                    AdaptiveCount = Count % isimgcn.length;
                }
                if (i == AdaptiveCount) {
                    isimgcn[i].style.display = "flex";
                    isimgcn[i].classList.add("slide-top")
                } else {
                    isimgcn[i].style.display = "none";
                }
            }

            for (let i = 0; i < isimgcs.length; i++) {
                let AdaptiveCount = Count;
                if (Count >= isimgcs.length) {
                    AdaptiveCount = Count % isimgcs.length;
                }
                if (i == AdaptiveCount) {
                    isimgcs[i].style.display = "flex";
                    isimgcs[i].classList.add("slide-top");
                } else {
                    isimgcs[i].style.display = "none";
                }
            }


        }
    </script>

    <script>
        $(".cus").show();
        var seenIds = {};
        $("[dub_id]").each(function() {
            var id = $(this).attr("dub_id");
            if (seenIds[id]) {
                $(this).remove();
            } else {
                seenIds[id] = true;
            }
        });
        $(".iframe_container iframe").removeAttr("width").removeAttr("height");
        $(".iframe_container").css("width", "300").css("height", "300");
        // updateFloatingButton();
        // function updateFloatingButton() {
        var lastSpan = $(".head-container span").last(); // Get the last selected span element
        var lastSpanPosition = lastSpan.offset(); // Get the position of the last selected span element
        lastSpanPosition = lastSpanPosition['top'];
        var floatingButton = $(".floating-button"); // Get the element with class "floating-button"
        $(".floating-button").css({
            position: "absolute",

            right: 0,
            left: 0,
            top: lastSpanPosition + 'px',
            margin: "auto",

        });
        // }

        //     var topOffset = lastSpanPosition.top + lastSpan.outerHeight() - lastSpan.parent(".image-container").position().top;
        //    $(".floating-button").click(function(){
        //     $('html, body').animate({
        //           scrollTop: $(".navilu-item-1").offset().top
        //       }, 100, function() {
        //       });
        //    });


        var Elements = ['.image-container', '.navilu-item-1', '.navilu-item-2', '.navilu-item-3','#aboutUs', '#contactUs','#showroom'];

        function updateViewportScrollbar() {
            var windowHeight = $(window).height();
            var windowTop = $(window).scrollTop();
            var windowBottom = windowTop + windowHeight;

            var maxVisibleArea = 0;
            var maxVisibleElement = null;

            Elements.forEach(function(element) {
                var $element = $(element);
                var elementTop = $element.offset().top;
                var elementHeight = $element.outerHeight();
                var elementBottom = elementTop + elementHeight;
                var visibleTop = Math.max(elementTop, windowTop);
                var visibleBottom = Math.min(elementBottom, windowBottom);
                var visibleHeight = visibleBottom - visibleTop;
                var visibleArea = visibleHeight * $element.width();

                if (visibleArea > maxVisibleArea) {
                    maxVisibleArea = visibleArea;
                    maxVisibleElement = $element;
                }
            });

            Elements.forEach(function(element) {
                var $element = $(element);
                if ($element[0] === maxVisibleElement[0]) {
                    $element.addClass('viewport-scrollbar');
                    if (!$element.hasClass("image-container")) {
                        
                        $(".floating-button").css({
                            position: "fixed",
                            right: "10px",
                            bottom:"10px",
                            top:"unset",
                            left:"unset",
                            margin: "unset",
                            
                        });

                    } else {
                       
                        $(".floating-button").css({
            position: "absolute",
           bottom:"unset",
            right: 0,
            left: 0,
            top: lastSpanPosition + 'px',
            margin: "auto",

        });
                    }
                } else {
                    $element.removeClass('viewport-scrollbar');
                }
            });
        }

        $(document).ready(function() {
            $(".image-container").addClass("viewport-scrollbar");
            $(window).scroll(updateViewportScrollbar);
            $(window).scroll(function() {
  // Get the distance from the top of the document to the bottom of the viewport
  var bottomOffset = $(document).height() - $(window).height() - $(window).scrollTop();

  // If the bottom offset is greater than or equal to 40
  if (bottomOffset <= 40) {
    $(".floating-button").addClass("up");
    $(".floating-button").css("rotate","180deg");
  } else {
    $(".floating-button").removeClass("up");
    $(".floating-button").css("rotate","0deg");
  }
});

        });
        function ScrollElement(Scrl) {
// alert("ok");
  if( $(Scrl).hasClass("up")){
    $("html, body").animate({scrollTop: 0}, "100");
   }
   else{
    // Find the index of the element with the viewport-scrollbar class
var index = Elements.findIndex(function(element) {
  return $(element).hasClass('viewport-scrollbar');
});

// If an element with the viewport-scrollbar class was found
if (index >= 0) {
  // Get the next element in the array
  var nextElement = Elements[index + 1];

  // Get the offset of the next element from the top of the document
  var offset = $(nextElement).offset().top - 60;

  // Scroll the page to the next element
  $('html, body').animate({scrollTop: offset}, '100');
}

   }
}

    </script>
    <style>
        .iframe_container {
            width: 300px;
            height: 300px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
@endsection
