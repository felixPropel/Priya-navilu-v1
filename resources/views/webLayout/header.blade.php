<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
 {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  --}}
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
  <meta name="title" content="Navilu marbles">
<meta name="description" content="NAVILU established in the year 1987 is an exclusive outlet for superior quality Floors , Fittings & Modular Kitchen.">
<meta name="keywords" content="tiles,fitting,catalogue,trichy tiles,trichy marbles ,navilu">
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="English">

  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico')}}">
  <script src="{{ asset('assets/Web/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{ asset('assets/Web/js/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{ asset('assets/Web/js/masonry.pkgd.min.js')}}"></script>

  <link href="{{ asset('assets/Web/fonts/icomoon/style.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/Web/css/owl.carousel.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/Web/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

  <link href="{{ asset('assets/Web/css/style.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/Web/css/custom.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/Web/css/gallery.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/Web/css/detail.css')}}" rel="stylesheet" type="text/css" />




  <!-- Style -->

  <title>Navilu</title>
</head>

<body>
  @php
  $allCateGories = \App\Models\Category::get()->toArray();
  $allTags = \App\Models\Tag::get()->toArray();
  $searchingDatas = array_merge($allCateGories, $allTags);
  @endphp 
  <div class="spinner-container">
    <div class="spinner"></div>
  </div>


  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>



  <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

    <div class="col-12">
      <div class="row align-items-center justify-content-between position-relative tob-bar-navilu">
        <div class="site-logo" onclick="window.location.href='/'">

          <img src="{{ asset('assets/Web/images/navilu-white.png')}}" alt="" width="180px">
        </div>
       
        <form  class="search-form " method="post" id="myForm" action="{{ route('serachingKeywordByForm') }}" accept-charset="UTF-8">
          <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            <label for="search" class="search-label">
            
            <div class="input-group input-container d-none">
              <input type="text" name ="keywords" class=" form-control input-search keywords outline-none" placeholder="Type to Search..." id="search" list="languages" autocomplete="off">
              <button type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2"><span class="icon-send"></span></button>
          
            <datalist name="keywords" class="keywords1" id="languages">
               
                @foreach($searchingDatas as $searchingData)
                <option value="{{$searchingData['name']}}">
                  @endforeach
              </datalist>
              <span class="input-group-addon"><i class="fa fa-check"></i></span>
          </div>
          <button type="button" for="search" class="btn-search"><i class="icon-search"></i></button>
        </label>
           
          </form>
     
        <div class="new_scroll_menu_container">
          <ul class="new_scroll_menu owl-carousel" id="dynamicMenu" >
            @foreach($allCateGories as $category)
            <li class="item"><a href="{{ route('serachingKeyword', ['key' =>$category['name'] ]) }}">{{$category['name']}}</a></li>
         @endforeach
          </ul>
          <ul class="default-bar">
            <li><a onclick="javascript:void(0)" page-scroll="#showroom" >Showroom</a></li>
            <li style="display:none;" class="cus"> <a onclick="javascript:void(0)" page-scroll="#contactUs"  >Contact Us</a></li>
          </ul>
          
         
         </div>
       

      </div>

    </div>

  </header>

  <script type="text/javascript">
    function submitForm() {
      var selectedOption = $('.keywords').val();
      var r = [{
        key: $('.keywords').val()
      }];
      var url = "{{ route('serachingKeyword'," + r + ") }}";
      console.log(selectedOption, url);
      return false;


      $('#myForm').attr('action', url);
      $('form#myForm').submit();
      return false;
    }
  </script>