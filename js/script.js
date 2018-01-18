function AddDateToModal(date) {
    date_field = document.getElementById("date_field");
    date_field.value = date;
}

//zum Bearbeiten der Nutzer
    $(document).on("click",'#edit_button' , function (e) {
      var vorname= $(this).attr('vorname');
      var nachname=$(this).attr('nachname');
      var email=$(this).attr('email');
      var kontostand=$(this).attr('kontostand');
        //setzen der Werte
          $('#vorname').val(vorname);
          $('#nachname').val(nachname);
          $('#email').val(email);
          $('#kontostand').val(kontostand);
    });

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
