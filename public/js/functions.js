function showErrorMessage (data) {

	const wrapper = document.createElement('div');
	var message = data.error || 'Something went wrong';
	if (data.type == 'validation') {

		var items = data.items;
		message+='<ul class="text-left small">';

		Object.keys(items).forEach(function(key) {
			message+= '<dt>'+key+'</dt>';
			items[key].forEach(function(validationError){
				message+= '<dd>'+validationError+'</dd>';
			});
		});
		message+='</ul>';
	}
	wrapper.innerHTML = message;

	swal({
		title: 'Ops!',
		content: wrapper,
		icon: 'error'
	});
}