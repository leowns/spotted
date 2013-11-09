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


    $('textarea').autosize();

    $(document).click(function (event) {

        if (!$("#new_item_form").has(event.target).length > 0) {
            var $el = $("#new_item_div");
            if ($el.is(":visible")) {
                $("#new_item_div").slideUp("slow");
                $("#form_message").animate({ height: "43px" }, 1000);
                $("#form_message").css("min-height", "0");
            }
        }
    });

    $("#form_message").click(function(event) {
        event.stopPropagation();

        $("#form_message").animate({
            "min-height": "140px"
        }, 600);
        $("#new_item_div").slideDown("slow");


//        $("#form_message").animate({
//            "min-height": "200px"
//        }, {
//            duration: 500,
//            complete: function() {
//                $("#new_item_div").slideDown("slow");
//                $("#form_message").css("min-height", "200px");
//            }
//        });
    })

    $('*[data-toggle="tooltip"]').tooltip();



});