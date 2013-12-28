$( document ).ready(function() {

    /**
     * Third Party
     */
    $('*[data-toggle="tooltip"]').tooltip();

    $('textarea.autosize').autosize();

    $('*[data-toggle="popover"]').popover();


    $('#notification_menu').popover({
        html : true,
        content: function() {
            return $('#notification_content').html();
        }
    });

    /**
     * Landing Page
     */
    $( ".fade_slow" ).fadeIn( 4000 );



    /**
     * Register Page
     */
    $("fos_user_registration_form_gender").hid


    /**
     * Main Page
     */
    var gutter = 30;
    var container = $('#item_wrapper');

    // Creates a function of Masonry
    var reMasonry = function() {
        container.masonry({
            gutter: gutter,
            itemSelector: '.item',
            columnWidth: '.item'
        });
    };

    // Creates an instance of Masonry on .item
    reMasonry();


    /**
     * Spotted Write Post Form
     */
	$('#Location').typeahead([
	{	
			valueKey: 'name',
			prefetch: Routing.generate('spotted_secured_listlocations'),
			template: [                                                                 
			'<strong>{{name}}</strong> <p>{{street}}</p> <p>{{zip}} {{city}}</p>',                                                                            
		  ].join(''),                                                                 
		  engine: Hogan  
	},
	{
	
		valueKey: 'city',
			prefetch: Routing.generate('spotted_secured_listlocations'),
			template: [                                                                 
			'<strong>{{name}}</strong> <p>{{street}}</p> <p>{{zip}} {{city}}</p>',                                                                            
		  ].join(''),                                                                 
		  engine: Hogan  
	
	},
	{
	
		valueKey: 'street',
			prefetch: Routing.generate('spotted_secured_listlocations'),
			template: [                                                                 
			'<strong>{{name}}</strong> <p>{{street}}</p> <p>{{zip}} {{city}}</p>',                                                                            
		  ].join(''),                                                                 
		  engine: Hogan  
	
	},
	{
	
		valueKey: 'zip',
			prefetch: Routing.generate('spotted_secured_listlocations'),
			template: [                                                                 
			'<strong>{{name}}</strong> <p>{{street}}</p> <p>{{zip}} {{city}}</p>',                                                                            
		  ].join(''),                                                                 
		  engine: Hogan  
	
	}
		
	]);
	
	$('#Location').bind('typeahead:selected', function( obj,datum,name) {      
		
		var id= JSON.stringify(datum.id);
		//alert(id);
		$('#hidden').val(id);
		 // var n=JSON.stringify(datum.name);
		 // var name=n.replace(/\"/g, "");
		// var s = JSON.stringify(datum.street);
		// var street= s.replace(/\"/g, "");
		 // var c = JSON.stringify(datum.city);
		 // var city= c.replace(/\"/g, "");
		 // var z = JSON.stringify(datum.zip);
		 // var zip= z.replace(/\"/g, "");
		 // $('#Location').val(name+' '+street+' '+city+' '+zip);
});
	
	$("input[name=filtersleft]:radio").change(function () {
		$.post(
			  Routing.generate('spotted_secured_filters'), 
			  {filter1: $("[name='filtersleft']:checked").val(),filter2: $("[name='filtersright']:checked").val()}, 
			  function(data){
			  $('#item_wrapper').html(data);
			  });
			
	});
		$("input[name=filtersright]:radio").change(function () {
		$.post(
			  Routing.generate('spotted_secured_filters'), 
			  {filter1: $("[name='filtersleft']:checked").val(),filter2: $("[name='filtersright']:checked").val()}, 
			  function(data){
			 $('#item_wrapper').html(data);
			
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


    /**
     * Spotted Posts
     */
    $(".box.box-spotted").click(function(event) {
        event.stopPropagation();

        slideBox (this,'.spotted-match');

    });

    $(".box.comment").click(function(event) {
        event.stopPropagation();

        slideBox (this,'.spotted-comments');
    });

    function slideBox (target, name) {

        var $el = $(name);
        if (!$el.is(":visible")) {
            $(target).parents(".spotted-details").prevAll('.spotted-slidedown').hide();
        }

        var targetDIV = $(target).parents(".spotted-details").siblings(name);

        targetDIV.slideToggle('slow', function() {
            reMasonry();
        });
    }


    /**
     * Style Selector
     */

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