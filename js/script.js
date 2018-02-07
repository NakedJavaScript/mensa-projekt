function AddValuesToModal(date, addFood='') {
    if (addFood) {
        dateField = document.getElementById("editDateField");
        dateField.value = date;
        foodField = document.getElementById("editFoodField");
        foodField.value = addFood;
    } else {
        dateField = document.getElementById("dateField");
        dateField.value = date;
    }
};

function drawGraph() {
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Montag","Dienstag","Mittwoch","Donnerstag","Freitag"],
            datasets: [{
                label: 'Bestellte Tagesessen',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
};

//Scripts for essensliste.php

//zum bearbeiten von essen
$(document).on("click",'#edit_food' , function (e) {
var identity= $(this).attr('foodID'); //Werte aus den Attributen werden variablen zugeordnet
var name=$(this).attr('foodName');
var allergenic=$(this).attr('allergenic')
var allergenicArray = allergenic.split(', ')//aus allergene wird ein Array erstellt
var others=$(this).attr('others');
var price=$(this).attr('price');
//set what we got to our form
$('#speise_ID').val(identity);
$('#name').val(name);
$('#others').val(others);
$('#price').val(price);
for (i=0; i!=allergenicArray.length;i++) { //Jeder checkbox dessen Wert mit einem Element der aus der Array übereinstimmt wird das Attribut "checked" gegeben.
      var checkbox = $("input[type='checkbox'][value='"+allergenicArray[i]+"']");
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

// script für das jquery tablesorter plugin
$(function() {

    // Einstellungen des Pagers
    var pagerOptions = {
      container: $(".pager"),
      output: '{startRow:input} – {endRow} / {totalRows} Einträge',
      updateArrows: true,
      page: 0,
      size: 10,
      savePages : true,
      storageKey:'tablesorter-pager',
      pageReset: 0,
      fixedHeight: false,
      removeRows: false,
      countChildRows: false,

      // css klassennamen der Seiten-Pfeile
      cssNext: '.next', // nächste
      cssPrev: '.prev', // vorherige
      cssFirst: '.first', // erste
      cssLast: '.last', // letzte
      cssGoto: '.gotoPage', // Dropdown zur Auswahl der Anzahl an angezeigten Nutzern
      cssPageDisplay: '.pagedisplay', // wo das Output angezeigt werden soll
      cssPageSize: '.pagesize', // Dropdown für die Anzeige der Auswahl
      cssDisabled: 'disabled'
    };

    // Einstellungen des Tablesorters
  var $table = $('.tabelsorterTable').tablesorter({
    theme: 'jui',
    widgets: ["filter"],
    sortList: [[0,0],[2,0]],
    widgetOptions : {
      filter_columnFilters: true,
      filter_placeholder: { search : 'suchen...' }
    }
  })

  // bind to pager events
  // *********************
  .bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c){
    var msg = '"</span> event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') +
      ' page <span class="typ">' + (c.page + 1) + '/' + c.totalPages + '</span>';
    $('#display')
      .append('<li><span class="str">"' + e.type + msg + '</li>')
      .find('li:first').remove();
  })

  // Pager wird initialisiert
  .tablesorterPager(pagerOptions);
});
