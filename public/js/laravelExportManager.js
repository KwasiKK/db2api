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

                // if (response.success) {
                //     window.location.reload();
                // }
                // else {
                //     $(".feedback").html(`<div class='alert alert-danger alert-dismissable'>
                //             <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                //             Error occured while ` + action + ` the table.
                //             Details:
                //             <pre>` + response.output + `</pre>
                //         </div>`);
                // }
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