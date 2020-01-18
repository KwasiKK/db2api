$(document).ready(function() {
	$(".btn-export").on("click", function(e) {
		e.preventDefault();
		$(".btn-export").attr("disabled", true);
		var data = {};

		data.tables = $('input[name=table-checkbox-default]:checked').map(function(_, el) {
			return $(el).val();
		}).get();

		data.features = $('input[name=feature-checkbox-success]:checked').map(function(_, el) {
			return $(el).val();
		}).get();

		$(".loading-block").slideDown();

        $.ajax({ //ajaxing the  data
            url: "/export/laravel/" + $('input.project_id').val(),
            data: data,
            cache: false,
            method: "POST",
            success: function(response){
                console.log({response});
                if (response.success) {
		            $(".feedback").html(`<div class='alert alert-success alert-dismissable'>
		                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		                    The laravel project files are created. You can copy the routes, models, views, migrations, controllers, authentication files to your existing laravel project.
		                </div>`);

                    window.open("/download/project/" + $('input.project_id').val(), '_blank');
                    console.log("download/project");
                }
                else {
                    $(".feedback").html(`<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            Error occured while the table.
                            Details:
                            <pre>` + response + `</pre>
                        </div>`);
                }
            },
        }).done(function(data) {
            console.log(data);
            //$(".debug").html(response);
            $(".loading-block").slideUp();
            $(".btn-export").attr("disabled", false);
        }).fail(function(jqXHR,status, errorThrown) {
            $(".feedback").html(`<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    Error occured while exporting the project.
                    Details:
                    <pre>` + jqXHR.responseText + `</pre>
                </div>`);
            console.error(errorThrown);
            console.log(jqXHR.responseText);
            console.log(jqXHR.status);
            $(".loading-block").slideUp();
            $(".btn-export").attr("disabled", false);
        });
	});
});