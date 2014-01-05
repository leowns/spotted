$( document ).ready(function() {

    /**
     * Third Party
     */
    $('*[data-toggle="tooltip"]').tooltip();

    $('textarea.autosize').autosize();

    $('*[data-toggle="popover"]').popover();


    var $MenuPopover = $('#notification_menu').popover({
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
     * Menü
     */
    $MenuPopover.on("show.bs.popover", function(e) {
        $this = $('#notification_li_menu');

        $this.siblings().removeClass("active");
        $this.addClass("active");
    });

    $MenuPopover.on("hidden.bs.popover", function(e) {
        $this = $('#notification_li_menu');

        $this.removeClass("active");

        if($this.siblings().hasClass('current_url')) {
            $('.current_url').toggleClass("active");
        }
    });




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
	
	$("input[name=filtersleft]:radio").change(function (event) {

        // If user has already set this kind of filter
        if (!$(this).parent().hasClass('active')) {
            // If user selects a gender and "all" is checked => uncheck "all"
            if ($(this).is(':checked')) {
                $('input:radio[id=filterrightAll]').removeAttr('checked');
                // Refresh the jQuery UI buttonset.
                $('input:radio[id=filterrightAll]').parent('label').removeClass('active');
            }

            $.post(
                Routing.generate('spotted_secured_filters'),
                {filter1: $("[name='filtersleft']:checked").val(),filter2: $("[name='filtersright']:checked").val(), watchlist: $("#message_filter").data('iswatchlist')},
                function(data){
                    container.masonry( 'remove', $('.item'));

                    container.html(data);

                    container.masonry( 'appended', $('.item'));
                    reMasonry()
                });
        } else {
            $(this).prop('checked', true);
        }

			
	});

    $("input[name=filtersright]:radio").change(function (event) {

        // If user has already set this kind of filter
        if (!$(this).parent().hasClass('active')) {
            // If user selected 'all' => uncheck every other radio
            if ($(this).is(':checked') && $(this).val() == 'all') {
                $('input:radio[name=filtersleft]').removeAttr('checked');
                // Refresh the jQuery UI buttonset.
                $('input:radio[name=filtersleft]').parent('label').removeClass('active');
            }

            $.post(
                Routing.generate('spotted_secured_filters'),
                {filter1: $("[name='filtersleft']:checked").val(),filter2: $("[name='filtersright']:checked").val(), watchlist: $("#message_filter").data('iswatchlist')},
                function(data){
                    container.masonry( 'remove', $('.item'));

                    container.html(data);

                    container.masonry( 'appended', $('.item'));
                    reMasonry()
                })
        } else {
            $(this).prop('checked', true);
        }

	});


    $('input:radio[name="filtersright"]').change(function(){

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

	// loads the modal for watchlist
	// $(document).on('click', ".box.wishlist", function (event) {
        // event.stopPropagation();
		// var postid = jQuery(this).attr("id");
		// //alert(postid);
		// $('#modal'+postid).modal('show');
    // });
	
	
		
    /**
     * Spotted Posts
     */
	 // // loads the watchlist when you clock on the navbar menu
	  // $(document).on('click', "#watchlist", function (event) {
        // event.stopPropagation();
		// $.post(
			  // Routing.generate('spotted_secured_watchlist'), 
			  
			  // function(data){
                  // container.masonry( 'remove', $('.item'));

                  // container.html(data);

                  // container.masonry( 'appended', $('.item'));
                  // reMasonry()
			  // })
		

    // });

	 
    $(document).on('click', ".box.box-spotted", function (event) {
        event.stopPropagation();

        slideBox (this,'.spotted-match');

    });

    $(document).on('click', ".box.comment", function (event) {
        event.stopPropagation();

        currentThis = this;

        var postid = jQuery(this).data("id");

        var $el = $("#comment_wrapper"+postid);

        if ($el.is(":visible")) {
            slideBox (currentThis,'.spotted-comments');
        } else {
            // load the Comments for each post
            showComment(postid, function() {
                slideBox (currentThis,'.spotted-comments');
            });
        }

    });

	$('button[name="btncomment"]').click(function(){
		var postid = jQuery(this).attr("id");
		$.post(
			  Routing.generate('spotted_secured_add_comment',{ postid: postid }),
			  {txthint: $("#txthint"+postid).val()}, 
			  function(){
                showComment(postid, function() {
                    reMasonry();
                });
			  });
	});
	
	function showComment (postid, myCallbackFn) {
		$.post(
			  Routing.generate('spotted_secured_show_comment',{ postid: postid }),
			  function(data){
				  $("#comment_wrapper"+postid).html(data);
			  }).done(function() {
                myCallbackFn.call();
              });
	
    }

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

	
$('form[name="contact_form"]').submit(function(){
		
		$('#mailmodal').modal('show');
		
	 });

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