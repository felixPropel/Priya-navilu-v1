
$(document).ready(function() {
const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];

let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();


    });
    

var Nheight=$(".sub-image");
var NheightPx="calc(100vh - 140px)";
// console.log(NheightPx);
$(".img-showcase").css('height',NheightPx);
function slideImage() {
    const displayWidth = document.querySelector('.img-showcase .sub-image:first-child').clientWidth;
    document.querySelector('.img-showcase div').style.marginLeft = `${- (imgId - 1) * displayWidth}px`;
    let newId=imgId-1;
    $(".img-showcase").css('height','auto')
    var NheightPx=Nheight[newId].clientHeight;
console.log(NheightPx);
$(".img-showcase").css('height',''+NheightPx+'px');

}

window.addEventListener('resize', slideImage);



// var container = document.querySelector(".sub-image");
// var img = document.querySelector(".sub-image-a img");
// const container = document.querySelector(".sub-image-b");
// const img = document.querySelector(".sub-imag-b img");
// container.addEventListener("mousemove", onZoom);
// container.addEventListener("mouseover", onZoom);
// container.addEventListener("mouseleave", offZoom);
$(".sub-image").mousemove(function (e) { 
    // values: e.clientX, e.clientY, e.pageX, e.pageY
    // alert("ok");
    const x = e.clientX - e.target.offsetLeft;
    const y = e.clientY - e.target.offsetTop;

   $(this).children("img").css('transform-origin',''+x+'px '+y+'px').css('transform','scale(5.5)');

});
$(".sub-image").mouseleave(function () { 
    $(this).children("img").css('transform-origin','center center').css('transform','scale(1)');
});
function onZoom(e) {
    const x = e.clientX - e.target.offsetLeft;
    const y = e.clientY - e.target.offsetTop;

    // console.log(x, y)

    img.style.transformOrigin = `${x}px ${y}px`;
    img.style.transform = "scale(2.5)";
}

function offZoom(e) {
    img.style.transformOrigin = `center center`;
    img.style.transform = "scale(1)";
}

    $("#news-slider").owlCarousel({
        items : 3,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        navigation:true,
        navigationText:["",""],
        pagination:true,
        autoPlay:true
    });

});

});