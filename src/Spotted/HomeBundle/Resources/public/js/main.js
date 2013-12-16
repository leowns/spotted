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
	
	$('#Location').typeahead({
		valueKey: 'name',
		prefetch: Routing.generate('spotted_listlocations'),
		
		
	});
	$("input[name=filtersleft]:radio").change(function () {
		$.post(
			  Routing.generate('ajaxfilters'), 
			  {filter1: $("[name='filtersleft']:checked").val(),filter2: $("[name='filtersright']:checked").val()}, 
			  function(data){
			  
			  });
			
	});
		$("input[name=filtersright]:radio").change(function () {
		$.post(
			  Routing.generate('ajaxfilters'), 
			  {filter1: $("[name='filtersleft']:checked").val(),filter2: $("[name='filtersright']:checked").val()}, 
			  function(data){
			
			  });
	});
    $("#new_item_close").click(function (event) {
       // if (!$("#new_item_form").has(event.target).length > 0 && !$("#Location").has(event.target).length > 0) {


            var $el = $("#new_item_div");
            if ($el.is(":visible")) {
                $("#new_item_div").slideUp("slow");
                $("#form_message").animate({ height: "43px" }, 1000);
                $("#form_message").css("min-height", "0");
            }

            $("#new_item_close").hide();
       // }
    });

    $("#form_message").click(function(event) {
        event.stopPropagation();

        $("#form_message").animate({
            "min-height": "140px"
        }, 600);
        $("#new_item_div").slideDown("slow");
        $("#new_item_close").show();


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




    jQuery('#style-selector').hide(200);

    jQuery('#t-row-left-ss').hide();

    jQuery('#t-row-left-ss').click(function(){
        jQuery('#style-selector').hide(200);
        jQuery('#t-row-left-ss').hide();
    });
    jQuery('#t-row-right-ss').click(function(){
        jQuery('#style-selector').show(300,function(){
            jQuery('#t-row-left-ss').show();
        });
    });

    $('#bg-list').change(function () {
        $("body").css('background-image', 'url("' + $('option:selected', this).data('url') + '")');
    });

});