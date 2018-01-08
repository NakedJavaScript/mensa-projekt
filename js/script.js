$(document).ready(function () {
    var links = $('.navbar-collapse ul li .nav-link');
    $.each(links, function (key, va) {
        if (va.href == document.URL) {
            $(this).addClass('active-link');
        }
    });
});

/*Skript für abfrage bevor gelöscht wird. */
		$(document).ready(function(){
		$("a.delete").click(function(e){
        if(!confirm('Willst du diesen Eintrag wirklich löschen?')){
            e.preventDefault();
            return false;
        }
        return true;
		});
	});

