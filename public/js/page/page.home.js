$(document).ready(function() {

    //WAYPOINT - JQUERY COUNTTO//
    $('#count-wrapper').waypoint(function() {
        $('.title-count').countTo();
    }, {
        offset: '80%',
        triggerOnce: true
    });

    //MAGINFIC POPUP
    $('#owl-our-work').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
		gallery: {
		enabled: true, // set to true to enable gallery

		preload: [0,2], // read about this option in next Lazy-loading section

		navigateByImgClick: true,

		arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button

		tPrev: 'Anterior', // title for left button
		tNext: 'Próximo', // title for right button
		tCounter: '<span class="mfp-counter">%curr% de %total%</span>' // markup of counter
		}
    });

    //SLIDER OUR WORK
    $("#owl-our-work").owlCarousel({
        paginationSpeed: 500,
        autoPlay: 4000,
        items: 4,
        itemsCustom: [
            [0, 4],
            [450, 4]
        ]

    });

    //SLIDER CLIENTS
    $("#owl-clients").owlCarousel({
        paginationSpeed: 400,
        autoPlay: 5500,
        items: 4,
        pagination: false,
        itemsCustom: [
            [0, 3],
            [450, 4]
        ]

    });

});
