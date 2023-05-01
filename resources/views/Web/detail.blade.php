a@extends('webLayout.webApp')
@section('content')

    <div class="card-wrapper">
        <div class="card-mine" style="width: 100%;  ">
            <!-- card left -->
            <div class="product-imgs">
                @if ($postImages)
                    @if ($postImages[0]->social_media_url)
                        <?php echo $postImages[0]->social_media_url; ?>
                        <style>
                            .img-display,
                            .img-select {
                                display: none;
                            }
                        </style>
                    @else
                        <div class="img-display">
                            <div class="img-showcase">
                                @foreach ($postImages as $postImage)
                                    <div class="sub-image">
                                        <img src="{{ $postImage->image_url }}" alt="Navilu image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
                <div class="img-select">
                    @foreach ($postImages as $postImage)
                        <div class="img-item">
                            <a href="#" data-id="{{ $loop->iteration }}">
                                <img src="{{ $postImage->image_url }}" alt="Navilu image">
                            </a>
                        </div>
                    @endforeach


                </div>
            </div>
            <!-- card right -->
            <div class="product-content">
                {{-- <h2 class="product-title">{{$postDetailDatas->title}}</h2> --}}
                <p class="product-detail">
                    <br><br>
                    {!! $postDetailDatas->content !!}
                </p><br><br>
                @foreach ($pdfs as $pdf)
                    <div class="full-width text-center p-t-10">
                        <span> For Description </span>
                        <a href="{{ asset('pdffiles/' . $pdf->file_path) }}" target="_blank"
                            class="btn-pdf  p-2 text-white">Download</a>

                    </div>
                @endforeach
                <br>
                <p class="product-contact">
                    Visit us today or call us @+91 9894659125 to know more
                </p>
            </div>
        </div>
    </div>
    <div class="related-products-container">
        <div class="col-12 row justify-content-center position-relative">
            <p class="border-navilu "></p>
            <p class="related shake-vertical">Related Products</p>

        </div>

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="news-slider" class="owl-carousel">
                    @foreach ($relatedPosts as $relatedPost)
                        <div class="post-slide">
                            <div class="post-img">
                                @if ($relatedPost)
                                    {{-- <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/{!!$relatedPost['youtube_link']!!}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                                @else
                                    <img data-src="{{ $relatedPost['medium_thumbnail'] }}" alt="">
                                    <a href="#" class="over-layer"><i class="fa fa-link"></i></a>
                                @endif
                            </div>
                            <div class="post-content">
                                <h3 class="post-title">
                                    <a href="#">{{ $relatedPost['title'] }}</a>
                                </h3>
                                <div class="post-description" data-maxlength="100">{!! $relatedPost['content'] !!}</div>
                                <!-- <span class="post-date"><i class="fa fa-clock-o"></i>Out 27, 2019</span> -->
                                <a href="{{ route('serachingByPostId', ['key' => $relatedPost['postId']]) }}"
                                    class="read-more">Explore More</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="address-footer " id="showroom">
            @foreach ($showroomMasterModels as $showroom)
                <div class="child-footer">
                    <h4 class="header-address text-bold " style="text-align: center">{{ $showroom['name'] }}</h4>
                    <span style="max-width:300px;">{{ $showroom['showroom_address'] }}</span>
                    <span>{{ $showroom['email_id'] }}</span>
                    <span>
                        {{ $showroom['contact_number'] }}
                    </span>

                </div>
            @endforeach

        </div>
    </footer>
    <script>
        $(".post-description").text(function() {
            var maxLength = $(this).attr('data-maxlength');
            currentText = $(this).text();
            // console.log(currentText);
            if (currentText.length >= maxLength) {
                return currentText.substr(0, maxLength) + "...";
            } else {
                return currentText
            }
        });
        var src = $(".post-slide img");

        for (let i = 0; i < src.length; i++) {
            let element = $(src[i]).attr("data-src");

            $(src[i]).attr("src", element);
        }
    </script>
@endsection
