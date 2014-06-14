$('input[data-role="tagsinput"]').tagsinput({
	typeahead: {
		source: function(query) {
			return $.getJSON("['foo' , 'bar']");
		}
	}
});