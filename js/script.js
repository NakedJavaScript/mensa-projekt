function AddDateToModal(date) {
    date_field = document.getElementById("date_field");
    date_field.value = date;
}

/*Skript für abfrage bevor gelöscht wird. */
		$(document).ready(function(){
		$("a.delete").click(function(e){
        if(!confirm('Wollen Sie diesen Eintrag wirklich löschen?')){
            e.preventDefault();
            return false;
        }
        return true;
		});
	});

  //Skript für Check buttons im NewFood Modal
  $("#ka").change(function() {
    $(":checkbox").not(this).prop("checked", false);//sets the state of 'checked' to false at every other checkbox
    $(":checkbox").not(this).prop("disabled", this.checked);//disables all checkboxes, but the checked one
  });


//Damit man in der Nav-Bar sieht bei welchen Link man sich gerade befindet
$(function(){
  var links = $('.navbar-collapse ul li .nav-link');
  $.each(links, function (key, va) {
      if (va.href == document.URL) {
          $(this).addClass('active-link');
      }
  });

	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 200,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) {
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

    // Aktiviert den Bootstrap Tooltip
    $('[data-toggle="tooltip"]').tooltip()

});

jQuery('#cody-info ul li').eq(1).on('click', function(){
$('#cody-info').hide();
});

$('body').tooltip({
    selector: '[rel="tooltip"]'
});


// Erlaubt es dem deaktivierten Button ein tooltip anzuzeigen
$(".heart-btn").click(function(e) {
    if (! $(this).hasClass("disabled"))
    {
        $(".disabled").removeClass("disabled").attr("data-toggle", null);
        $(this).addClass("disabled").attr("data-toggle", "tooltip");

        $(this).mouseenter();
    }
});


// Like Funktion

var like_state = 0;

$(document).ready(function(){
    $('.like-btn').on('click', function(){
        var food_id = $(this).data('id');
        $clicked_btn = $(this);

        if($clicked_btn.hasClass('like-btn') && like_state === 0) {
            action = "like";
            like_state = 1;
        } else if ($clicked_btn.hasClass('like-btn') && like_state === 1) {
            action = "unlike";
            like_state = 0;
        }

        $.ajax({
            url: 'index.php',
            type: 'speise',
            data: {
                'action': action,
                'food_id': food_id
            },
            success: function(data){
                res = JSON.parse(data);

                if (action == 'like') {
                    $clicked_btn.removeClass('like-btn');
                    $clicked_btn.addClass('unlike-btn');
                } else if (action == 'unlike'){
                    $clicked_btn.removeClass('unlike-btn');
                    $clicked_btn.addClass('like-btn');
                }
            }
        })
    });
});
