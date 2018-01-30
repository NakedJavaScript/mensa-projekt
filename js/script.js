function AddValuesToModal(date, addFood='') {
    if (addFood) {
        date_field = document.getElementById("edit_date_field");
        date_field.value = date;
        food_field = document.getElementById("edit_food_field");
        food_field.value = addFood;
    } else {
        date_field = document.getElementById("date_field");
        date_field.value = date;
    }
};

//Scripts for essensliste.php

//zum bearbeiten von essen
$(document).on("click",'#edit_food' , function (e) {
var identity= $(this).attr('speise_ID'); //Werte aus den Attributen werden variablen zugeordnet
var name=$(this).attr('speise_name');
var allergene=$(this).attr('allergene')
var allergenArr = allergene.split(', ')//aus allergene wird ein Array erstellt
var sonstiges=$(this).attr('sonstiges');
var preis=$(this).attr('preis');
//set what we got to our form
$('#speise_ID').val(identity);
$('#name').val(name);
$('#sonstiges').val(sonstiges);
$('#preis').val(preis);
for (i=0; i!=allergenArr.length;i++) { //Jeder checkbox dessen Wert mit einem Element der aus der Array übereinstimmt wird das Attribut "checked" gegeben.
      var checkbox = $("input[type='checkbox'][value='"+allergenArr[i]+"']");
      checkbox.attr("checked","checked");
  }
});
        /*Wenn "keine Allaergene" gecheckt wird, dann werden alle anderen checkboxen unchecked und disabled */
        $(".ka").change(function() {
        	$(".cb").not(this).prop("checked", false);//entfernt das "checked" attribut
        	$(".cb").not(this).prop("disabled", this.checked);//disabled alle checkboxen, außer die soeben gecheckte
        });

          	$(document).on("click",'#close_modal' , function () { //wenn das modal geschlossen wird, wird von allen checkboxen das "checked" attribut entfernt
          			$('input:checkbox').removeAttr('checked');
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
