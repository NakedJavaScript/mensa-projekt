// Adds values from the ordered food to the modal
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

// Function to draw the graph for the sales page, using Chart.js
function drawGraph(values) {
    values = values.split(",");
    if (values.length == 7) {
        labels =  ["Vor 6 Tagen","Vor 5 Tagen","Vor 4 Tagen","Vor 3 Tagen","Vor 2 Tagen","Vor 1 Tag","Heute"]
    } else if (values.length == 4) {
        labels =  ["Vor 3 Wochen","Vor 2 Wochen","Vor 1 Wochen","Diese Woche"]
    } else {
        labels =  ["Vor 11 Monaten","Vor 10 Monaten","Vor 9 Monaten","Vor 8 Monaten","Vor 7 Monaten","Vor 6 Monaten","Vor 5 Monaten","Vor 4 Monaten","Vor 3 Monaten","Vor 2 Monaten","Vor 1 Monat","Diesen Monat"]
    }
     document.getElementById("myChart").outerHTML = '<canvas id="myChart" width="400" height="400"></canvas>';
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Einnahmen',
                data: values,
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

// Scripts for foodList.php

// Function to edit food
$(document).on("click",'#edit_food' , function (e) {
    var identity= $(this).attr('speise_ID'); // Values from the attributes are assigned variables
    var name=$(this).attr('speise_name');
    var allergens=$(this).attr('allergens')
    var allergensArr = allergens.split(', ') // Create an array out of the allergens
    var sonstiges=$(this).attr('sonstiges');
    var preis=$(this).attr('preis');
    //set what we got to our form
    $('#speise_ID').val(identity);
    $('#name').val(name);
    $('#sonstiges').val(sonstiges);
    $('#preis').val(preis);
    for (i=0; i!=allergensArr.length;i++) { // Every checkbox whose value match with the element of the array receives the attribute "checked"
        var checkbox = $("input[type='checkbox'][value='"+allergensArr[i]+"']");
        checkbox.attr("checked","checked");
    }
});

// When you pick "keine Allergene" every checkbox is unchecked and disabled
$(".ka").change(function() {
    $(".cb").not(this).prop("checked", false); // Removes the checked attribute
    $(".cb").not(this).prop("disabled", this.checked); // Disables every checkbox, except the one you just checked
});

$(document).on("click",'#close_modal' , function () { // If the modal is closed, every checked attribute from the checkboxes are removed
    $('input:checkbox').removeAttr('checked');
});

$(function(){
    // Add special CSS to the active link in the navbar
    var links = $('.navbar-collapse ul li .nav-link');
    $.each(links, function (key, va) {
        if (va.href == document.URL) {
            $(this).addClass('active-nav-links');
        }
    });

    // Code for the back to top button
    var offset = 200, // Browser window scroll (in pixels) after which the "back to top" link is shown
    offset_opacity = 1200, // Browser window scroll (in pixels) after which the "back to top" link opacity is reduced
    scroll_top_duration = 700, // Duration of the top scrolling animation (in ms)
    $back_to_top = $('.cd-top'); // Grab the "back to top" link

    // Hide or show the "back to top" link
    $(window).scroll(function(){
        ($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
        if( $(this).scrollTop() > offset_opacity ) {
            $back_to_top.addClass('cd-fade-out');
        }
    });

    // Smooth scroll to top
    $back_to_top.on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0 ,
        }, scroll_top_duration
        );
    });

    // Activates the bootstrap tooltip
    $('[data-toggle="tooltip"]').tooltip()
    $('body').tooltip({
        selector: '[rel="tooltip"]'
    });

    // Allows for disabled buttons to show a tooltip
    $(".heart-btn").click(function(e) {
        if (! $(this).hasClass("disabled")) {
            $(".disabled").removeClass("disabled").attr("data-toggle", null);
            $(this).addClass("disabled").attr("data-toggle", "tooltip");
            $(this).mouseenter();
        }
    });

    // jquery Tablesorter
    // Settings for the tablesorter pager
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

        // CSS Classnames for the navigation in the pager
        cssNext: '.next', // next
        cssPrev: '.prev', // previous
        cssFirst: '.first', // first
        cssLast: '.last', // last
        cssGoto: '.gotoPage', // Dropdown for the "show many users.."
        cssPageDisplay: '.pagedisplay', // Sets where the output will be shown
        cssPageSize: '.pagesize',
        cssDisabled: 'disabled'
    };

    // Settings of the tablesorter
    var $table = $('.tabelsorterTable').tablesorter({
        theme: 'jui', // Sets the theme
        widgets: ["filter"], // Allowes additional widget filter
        sortList: [[0,0],[2,0]], // Sorts the list on page load
        widgetOptions : {
            filter_columnFilters: true, // Allows to filter columns
            filter_placeholder: { search : 'suchen...' } // Replaces the searchbar placeholder
        }
    })

    // bind to pager events
    .bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c){
        var msg = '"</span> event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') +
        ' page <span class="typ">' + (c.page + 1) + '/' + c.totalPages + '</span>';
        $('#display')
        .append('<li><span class="str">"' + e.type + msg + '</li>')
        .find('li:first').remove();
    })

    // Initializes the pager
    .tablesorterPager(pagerOptions);
});
