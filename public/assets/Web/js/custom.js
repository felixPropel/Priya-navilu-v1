$(document).ready(function () {
    $(".spinner-container").remove();


// $(".tile-img img").hover(function(){
//     $(this).addClass("rotate-in-2-cw");
// });
 $(".btn-search").click(function () { 
    if($(".btn-search i").hasClass("icon-search") )  {
        $(this).html("<i class='icon-close'></i>");
    }  
    else{
        $(this).html("<i class='icon-search'></i>");
 
    }
        
   $(".input-container ").toggleClass("d-none");
   $(".input-container ").toggleClass("input-anime");
    
 });


// $(window).scroll(function() {
   
//     var top_of_element = $("#container").offset().top;
//     var bottom_of_element = $("#container").offset().top + $("#container").outerHeight();
//     var top_of_elementA = $("#containerA").offset().top;
//     var bottom_of_elementA = $("#containerA").offset().top + $("#containerA").outerHeight();
//     var top_of_elementB = $("#containerB").offset().top;
//     var bottom_of_elementB = $("#containerB").offset().top + $("#containerB").outerHeight();

//     var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
//     var top_of_screen = $(window).scrollTop();
   
//     if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){
//     $(".kitchen").addClass("tracking-in-contract-bck-bottom");
//     } 
    
//     if ((bottom_of_screen > top_of_elementA) && (top_of_screen < bottom_of_elementA)){
//         console.log("2");
//     }
//     if ((bottom_of_screen > top_of_elementB) && (top_of_screen < bottom_of_elementB)){
//         console.log("3");
//     }
// });
function generateRandomColor(){
    let maxVal = 0xFFFFFF; // 16777215
    let randomNumber = Math.random() * maxVal; 
    randomNumber = Math.floor(randomNumber);
    randomNumber = randomNumber.toString(16);
    let randColor = randomNumber.padStart(6, 0);   
    return `#${randColor.toUpperCase()}`
}
$("#dynamicMenu").owlCarousel({
    items : 4,
    itemsDesktopSmall: [979, 4],
    itemsTablet: [768, 5],
    itemsTabletSmall: !4,
    itemsMobile: [479, 3],

    navigation:true,
    navigationText:["",""],
    pagination:true,
    autoPlay:true,
    autoWidth:true
});
$("#imgCarousel").owlCarousel({
    items : 3,
    itemsDesktop:[1199,3],
    itemsDesktopSmall:[980,2],
    itemsMobile : [600,1],
    navigation:true,
    navigationText:["",""],
    pagination:true,
    autoPlay:true
});

    $("a[page-scroll]").click(function(){
      var hash =$(this).attr("page-scroll");
      $('html, body').animate({
              scrollTop: $(hash).offset().top
          }, 100, function() {
  
          
          });
   
        var topbar = $('.sticky-wrapper');
        var footer = $('footer');
        var footerTop = footer.offset().top;
      
        $(window).scroll(function() {
          if ($(window).scrollTop() + $(window).height() >= footerTop) {
            topbar.addClass('glow');
          } else {
            topbar.removeClass('glow');
          }
        });
      });

     

      
      
      
      
      
      
      
  });

  