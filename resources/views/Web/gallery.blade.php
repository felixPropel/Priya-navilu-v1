@extends('webLayout.webApp')
@section('content')

<script onload="myFunction()">
  $(document).ready(function() {
   
    $(".image-container").imagesLoaded(function() {

      $(".image-container").masonry({
      itemSelector: ".image-item"
      
    });
    $(".image-item").css('visibility','visible');
    });
   

});
</script>


<div class="pb-3 pt-3 pl-1  m-9 row justify-content-center  labels">
  @php
  $allCateGories = \App\Models\Category::get()->toArray();
  $allTags = \App\Models\Tag::where('type',0)->get()->toArray();
  $searchingDatas1 = array_merge($allCateGories, $allTags);

  @endphp

  @foreach($searchingDatas1 as $searchingData)
  <a href="{{ route('searchingCategory', ['catName'=>$key[0],'key' =>$searchingData['name']])}}"><span class="rounded-pill button-65  mr-1 color-{{mt_rand(1, 6)}} label-{{$searchingData['name']}} ">{{$searchingData['name']}}</span></a>
  @endforeach

</div>
<div class="image-container">

  @foreach($filterDatas as $filterData)
  <div class="image-item color-{{mt_rand(1, 6)}}" onclick="window.location.href='{{ route('serachingByPostId', ['key' => $filterData['postId']]) }}'">
    @if($filterData->social_media_url)
<?php echo $filterData->social_media_url ?>
    @else
    <img data-src="{{$filterData->medium_thumbnail}}" alt="{{$filterData->title}}"  >
    @endif

    <div class="overlay">
      <h3 class="card-title title" style="color:{{$filterData->text_color}};">( {{$filterData->title}} )</h3>
      <div class="more">
        <a href="{{ route('serachingByPostId', ['key' => $filterData['postId']]) }}">
          <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Explore More
        </a>
      </div>
    </div>
  </div>

  @endforeach
  {{-- <div class="grid-item">
    {{-- <img  data-src="{{$filterData->thumbnail}}" alt=""> --}}
  {{-- <iframe  src="https://www.youtube.com/embed/MxEtxo_AaZ4?autoplay=1&mute=1&controls=0&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <div class="overlay">
      
      <h3 class="card-title title">(Youtbe Video)</h3>
      <div class="download">
        <a href="http://lorempixel.com/486/320/" download>
          <i class="fa fa-download" aria-hidden="true"></i>
        </a>
      </div>
      <div class="more">
      <a href="{{ route('serachingByPostId', ['key' => $filterData['postId']]) }}">
  <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Explore More
  </a>
</div>
</div>
</div> --}}
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
<!-- Part 3: the script call -->

<!-- Now that everything is loaded we create a script to trigger masonary on $grid. Note that this simply says: "if the images are fully loaded, trigger masnory on $grid. -->

<script>
  var currentUrl = window.location.href;
  var parts = currentUrl.split('/');
var lastParameter = parts[parts.length - 1];
     lastParameter=lastParameter.split('%20');
     lastParameter=lastParameter[0];
$(".label-"+lastParameter).addClass("activeLabels");

    var src = $(".image-item img");

  $(document).ready(function() {
    for (let i = 0; i < src.length; i++) {
      let element = $(src[i]).attr("data-src");

      $(src[i]).attr("src", element);
    }
    // $(src).css("height","auto");
  });
</script>
@endsection