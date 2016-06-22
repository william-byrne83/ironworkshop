jQuery(document).ready(function(){
	
	// External Link
	jQuery('a[rel="external"]').click(function(){
        window.open( jQuery(this).attr('href') );
        return false;
    });

	// Print
	jQuery('a[rel="print"]').click(function() {
		window.print();
		return false;
	});
	
	// Generate a random password for users
	jQuery("#generate_password").change(function() {
		var generate = jQuery(this).prop('checked');
		if(generate == true){
			jQuery.post(
				'/backoffice/users/generate-random-password/',
				{generate: 1},
				function(data) {
					jQuery("#generated_password").html(data);
					var new_pw = jQuery("#new_pw").val();
					jQuery("#password").val(new_pw).trigger('keyup');
					jQuery("#password_again").val(new_pw);
				}
			);
		}else{
			var new_pw = '';
			jQuery("#generated_password").html('');
			jQuery("#new_pw").val(new_pw);
			jQuery("#password").val(new_pw).trigger('keyup');
			jQuery("#password_again").val(new_pw);
		}
	});
	
	// Add region select based on country select
	jQuery("#location_country").change(function(event){
		var country_id = jQuery(this).val();
		jQuery.post(
			'/backoffice/users/regions/',
			{country_id: country_id},
			function(data) {
				if(data) {
					jQuery("#location_region").removeClass("hide");
					jQuery("#location_region").html(data);
				} else {
					jQuery("#location_region").html("");
					jQuery("#location_region").addClass("hide");
				}
			}
		);
	});
	
	// Change property type
	jQuery(".change_property_type").change(function(event){
		var property_type = jQuery(this).val(),
			property_id = jQuery(this).next("#property_id").val();
		jQuery.post(
			'/backoffice/properties/update-property-type/',
			{property_id: property_id, property_type: property_type}
		);
		jQuery(this).parent().append("<span class='label label-success'>Property Type Updated</span>");
		jQuery(this).parent().find(".label").delay(1800).fadeOut('slow');
	});
	
	// Change property status
	jQuery(".change_property_status").change(function(event){
		var property_status = jQuery(this).val(),
			property_id = jQuery(this).next("#property_id").val();
		jQuery.post(
			'/backoffice/properties/update-property-status/',
			{property_id: property_id, property_status: property_status}
		);
		jQuery(this).parent().append("<span class='label label-success'>Property Status Updated</span>");
		jQuery(this).parent().find(".label").delay(1800).fadeOut('slow');
	});


    function cropUpload(id, width, height) {
        var $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    });
                    $('.image-crop').addClass('ready');
                }

                reader.readAsDataURL(input.files[0]);
            }
            else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $(id).croppie({
            viewport: {
                width: width,
                height: height
            },
            boundary: {
                width: 300,
                height: 300
            },
            enableExif: true
        });

        $('#image').on('change', function () { readFile(this); });
        if ( $( "#image1" ).length ) {
            $('#image1').on('change', function () { readFile(this); });
        }


        $('#save').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'original'
            }).then(function (resp) {
                $('#imagebase64').val(resp);
                $('#form').submit();
            });
        });
    }

    if ( $( "#homepage-image" ).length ) {
        cropUpload('#homepage-image', 200, 100);
    }

    if ( $( "#news-image" ).length ) {
        cropUpload('#news-image', 171, 200);
    }

    if ( $( "#result-image" ).length ) {
        cropUpload('#result-image', 150, 200);
    }

    if ( $( "#store-image" ).length ) {
        cropUpload('#store-image', 200, 200);
    }

    if ( $( "#trainer-image" ).length ) {
        cropUpload('#trainer-image', 150, 200);
    }

    if ( $( "#gallery-image" ).length ) {
        cropUpload('#gallery-image', 200, 133);
    }

    if ( $( "#about-us-image" ).length ) {
        cropUpload('#about-us-image', 200, 100);

        //cropUpload('#about-us2-image', 200, 186);

            var $uploadCrop2;

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $uploadCrop2.croppie('bind', {
                            url: e.target.result
                        });
                        $('.image-crop').addClass('ready');
                    }

                    reader.readAsDataURL(input.files[0]);
                    return false;

                }
                else {
                    swal("Sorry - you're browser doesn't support the FileReader API");
                }
            }

            $uploadCrop2 = $('#about-us2-image').croppie({
                viewport: {
                    width: 200,
                    height: 186
                },
                boundary: {
                    width: 300,
                    height: 300
                },
                enableExif: true
            });

            $('#image2').on('change', function () { readFile(this); });


            $('#save').on('click', function (ev) {
                $uploadCrop2.croppie('result', {
                    type: 'canvas',
                    size: 'original'
                }).then(function (resp) {
                    $('#imagebase642').val(resp);
                    $('#form').submit();
                });
            });
    }


});