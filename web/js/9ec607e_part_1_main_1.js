$( document ).ready(function() {

    // Takes the gutter width from the bottom margin of .pin-inner

    var gutter = 30;
    var container = $('#item_wrapper');



    // Creates an instance of Masonry on #pin-outer

    container.masonry({
        gutter: gutter,
        itemSelector: '.item',
        columnWidth: '.item'
    });

});