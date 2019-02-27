@extends('layouts.app')

@section('content')

<form id="form">
	<div class="form-group row">
		<label for="sku" class="col-sm-2 col-form-label">SKU</label>
		<div class="col-sm-10">
			<input type="text" required class="form-control" id="sku" name="sku" value="{{$product->sku}}">
		</div>
	</div>

	<div class="form-group row">
		<label for="name" class="col-sm-2 col-form-label">Name</label>
		<div class="col-sm-10">
			<input type="text" required class="form-control" id="name" name="name" value="{{$product->name}}">
		</div>
	</div>

	<div class="form-group row">
		<label for="description" class="col-sm-2 col-form-label">Description</label>
		<div class="col-sm-10">
			<textarea required class="form-control" id="description" name="description">{{$product->description}}</textarea>
		</div>
	</div>

	<div class="form-group row">
		<label for="price" class="col-sm-2 col-form-label">Price</label>
		<div class="col-sm-10">
			<input type="text" required pattern="\d+\.{1}\d{2}" class="form-control" id="price" name="price" value="{{$product->getFormattedPrice()}}" />
			<small>Valid format: 999.99</small>
		</div>
	</div>

	<div class="text-right">
		<button type="submit" class="btn btn-primary">Save</button>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){

		var form = $("#form");
		form.submit(function(evt){

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: '/products{{ $product->exists ? "/{$product->getKey()}" : ''}}',
				type: '{{ $product->exists ? "PUT" : 'POST'}}',
				data: form.serialize(),
				success: function(){
					swal('Success!', 'Product successfully saved.', 'success')
						.then(function() {
							window.location.href = '/products';
						});
				},
				error: function (err) {
					showErrorMessage(err.responseJSON);
				}
			});

			evt.preventDefault();
		});
	});
</script>
@endsection
