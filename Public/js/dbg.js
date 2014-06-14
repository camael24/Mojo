$('.ddb').click(function ()  {
	
	var d = $(this).attr('data-dbg');
	if(d == 'deploy'){
		$('#ddb')
			.removeClass('dbg')
			.addClass('dbg-mini');
		$(this).attr('data-dbg' , 'hide');
		$(this)
			.removeClass('glyphicon-arrow-down')
			.addClass('glyphicon-arrow-up');
	}
	else {
		$('#ddb')
			.removeClass('dbg-mini')
			.addClass('dbg');
		$(this).attr('data-dbg' , 'deploy');
		$(this)
			.removeClass('glyphicon-arrow-up')
			.addClass('glyphicon-arrow-down');
	}
})