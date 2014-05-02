$(document).ready(function () {
    //basic pop-up
    $('#open-pop-up-1').click(function(e) {
        e.preventDefault();
        $('#pop-up-1').popUpWindow({action: "open"});
		$('#img_txt2').css('display','none');	$('.view3').css('display','none');
		$('.landscape_cardview .view3 .main_displaybox').css('display','none');
		
    });

    //Buttons pop-up
    $('#open-pop-up-2').click(function (e) {
        e.preventDefault();
        $('#pop-up-2').popUpWindow({
            action: "open",
            buttons: [{
                text: "Yes",
                click: function () {
                    this.close();
                }
            }, {
                text: "No",
                click: function () {
                    this.close();
                }
            }]
        });
    });
	

});