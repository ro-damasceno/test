@extends('layouts.app')

@section('content')

	<div class="card">
		<div class="card-header">Products</div>

		<div class="card-body">

			<div class="text-right mb-3">
				<div class="row">
					<div class="col">
						<form class="form-inline my-2 my-lg-0">
							<input class="form-control mr-sm-2" type="search" placeholder="Search" name="q" value="{{$queries['q']??null}}" aria-label="Search">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
						</form>
					</div>
					<div class="col-auto">
						<span class="btn-fake-products btn btn-success mr-2">Create 50 fake products</span>
						<a class="btn btn-primary" href="{{route('products.create')}}">Add Product</a>
					</div>
				</div>
			</div>

			@if(count($products) > 0)

				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>SKU</th>
							<th>Name</th>
							<th>Price</th>
							<th>Last Modification</th>
							<th colspan="2">Actions</th>
						</tr>
						</thead>

						<tbody>
						@foreach($products as $product)
							<tr>
								<td>{{$product->sku}}</td>
								<td class="text-truncate" style="max-width:200px;">{{$product->name}}</td>
								<td>{{$product->price}}</td>
								<td>{{ date ("m/d/Y H:i:s", strtotime ($product->updated_at))}}</td>
								<td class="text-center">
									<a href="{{route ('products.show', ['id' => $product->getKey()])}}">Edit</a>
								</td>
								<td>
									<span class="btn-delete text-danger" style="cursor:pointer;" data-ref="{{$product->getKey()}}">Delete</span>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>

				{{$products->appends(['q'=>$queries['q']??null])->links()}}
			@else
				<div class="alert alert-info">
					<h4>There is no product registered!</h4>
					<hr/>
					<p>Click <a href="{{route ('products.create')}}">here</a> to add a new product. </p>
				</div>
			@endif
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.btn-delete ').on('click', function(evt){

				if (!confirm('Are you sure you want to remove this item ? ')) {
					return;
				}

				var $btn = $(this);
				var id   = $btn.attr('data-ref');

				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: '/products/'+id,
					type: 'DELETE',
					success: function(){
						swal('Ops!', 'Product successfully deleted.', 'success')
							.then(function(){
								$btn.closest('tr').remove();
							})
					},
					error: function (err) {
						showErrorMessage(err.responseJSON);
					}
				});
			});

			$('.btn-fake-products').on('click', function(evt){

				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: '/products/fake-items',
					type: 'POST',
					success: function(){
						swal('Success', 'Products successfully created.', 'success')
							.then(function(){
								window.location.reload();
							})
					},
					error: function (err) {
						showErrorMessage(err.responseJSON);
					}
				});
			});
		});
	</script>
@endsection
