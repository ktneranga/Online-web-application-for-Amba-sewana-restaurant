/* clients carousel*/
var owl = $('.owl-carousel');
owl.owlCarousel({
    items:4,
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true
});

$(function(){
	$('clients-list').owlCarousel({
		items :4,
		autoplay :true,
		loop : true,
		autoplayHoverPause : true
	});
})