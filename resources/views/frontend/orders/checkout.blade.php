@extends('layouts.frontend')

@section('title', 'Checkout Page')

@section('content')
	<!-- header end -->
	<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210">
		<div class="container">
			<div class="breadcrumb-content text-center">
				<h2  style="color: black;">Halaman Checkout</h2>
				<ul >
					<li><a href="{{ url('/') }}" style="color: black;">beranda</a></li>
					<li><p style="color: black;">- Halaman Checkout</p></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- checkout-area start -->
	<div class="checkout-area ptb-100">
		<div class="container">
        <form action="{{ route('checkout') }}" method="post">
            @csrf
			<div class="row">
				<div class="col-lg-6 col-md-12 col-12">
					<div class="checkbox-form">						
						<h3>Detail Pembayaran</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Username <span class="required">*</span></label>
                                    <input type="text" name="username" value="{{ auth()->user()->username }}" placeholder="Username ...">
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Nama Depan <span class="required">*</span></label>
                                    <input type="text" name="first_name" value="{{ auth()->user()->first_name }}" placeholder="Nama depan ...">
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Nama Belakang <span class="required">*</span></label>
                                    <input type="text" name="last_name" value="{{ auth()->user()->last_name }}" placeholder="Nama belakang ...">
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Alamat <span class="required">*</span></label>
                                    <input type="text" name="address1" value="{{ auth()->user()->address1 }}" placeholder="Alamat rumah...">
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Patokan <span class="required">*</span></label>
                                    <input type="text" name="address2" value="{{ auth()->user()->address2 }}" placeholder="Alamat rumah...">
								</div>
							</div>
							<div class="col-md-12">
								<div class="checkout-form-list">
									<label>Provinsi <span class="required">*</span></label>
									<select name="province_id"id="province-id" value="{{ auth()->user()->province_id }}">
											<option value="">- Pilih Provinsi -</option>
											@foreach($provinces as $province => $pro)
											<option {{ auth()->user()->province_id == $province ? 'selected' : null }} value="{{ $province }}">{{ $pro }}</option>
											@endforeach
									</select> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Kota <span class="required">*</span></label>
									<select name="city_id" id="city-id" value="{{ auth()->user()->city_id }}" >
									<option value="">- Pilih Kota -</option>
											@foreach($cities as $id => $city)
											<option {{ auth()->user()->city_id == $id ? 'selected' : null }} value="{{ $id }}">{{ $city }}</option>
											@endforeach
                                 	</select> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Kode Pos <span class="required">*</span></label>						
									<input type="number" name="postcode" placeholder="Kode Pos" value="{{ auth()->user()->postcode }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Nomor Hp <span class="required">*</span></label>		
									<input type="text" name="phone" placeholder="Nomor Hp..." value="{{ auth()->user()->phone }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="checkout-form-list">
									<label>Alamat Email </label>
									<input type="text" name="email" readonly placeholder="Email..." value="{{ auth()->user()->email}}">								
								</div>
							</div>							
						</div>
						<div class="different-address">
							<div id="ship-box-info">
								<div class="row">
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>First Name <span class="required">*</span></label>
										<input type="text" name="shipping_first_name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Last Name <span class="required">*</span></label>
										<input type="text" name="shipping_last_name">
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Company Name</label>
										<input type="text" name="shipping_company">
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Address <span class="required">*</span></label>
											<input type="text" name="shipping_address1" placeholder="Home number and street name">
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Address <span class="required">*</span></label>
											<input type="text" name="shipping_address2" placeholder="Apartment, suite, unit etc. (optional)">
										</div>
									</div>
									<div class="col-md-12">
										<div class="checkout-form-list">
											<label>Province<span class="required">*</span></label>
											<select name="shipping_province_id"id="shipping-province">
												<option value="">- Please Select -</option>
												
											</select> 
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
                                            <label>City<span class="required">*</span></label>
                                            <select name="city_id" id="shipping-city" >
                                          
                                 	</select> 
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Postcode / Zip <span class="required">*</span></label>				
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Phone  <span class="required">*</span></label>			
										</div>
									</div>
									<div class="col-md-6">
										<div class="checkout-form-list">
											<label>Email </label>										
										</div>
									</div>	
								</div>					
							</div>
							<div class="order-notes">
								<div class="checkout-form-list mrg-nn">
									<label for="note">Catatan Pesanan</label>
									<textarea name="note" id="note" cols="30" rows="10"></textarea>
								</div>									
							</div>
						</div>													
					</div>
				</div>	
				<div class="col-lg-6 col-md-12 col-12">
					<div class="your-order">
						<h3>Pesanan Kamu</h3>
						<div class="your-order-table table-responsive">
							<table>
								<thead>
									<tr>
										<th class="product-name">Produk</th>
										<th class="product-total">Total</th>
									</tr>							
								</thead>
								<tbody>
									@forelse ($items as $item)
										@php
                                            $product = $item->associatedModel;
											$image = !empty($product->firstMedia) ? asset('storage/images/products/'. $product->firstMedia->file_name) : asset('frontend/assets/img/cart/3.jpg')
											
										@endphp
										<tr class="cart_item">
											<td class="product-name">
												{{ $item->name }}	<strong class="product-quantity"> × {{ $item->quantity }}</strong>
											</td>
											<td class="product-total">
												<span class="amount">{{ number_format(\Cart::get($item->id)->getPriceSum()) }}</span>
											</td>
										</tr>
									@empty
										<tr>
											<td colspan="2">The cart is empty! </td>
										</tr>
									@endforelse
								</tbody>
								<tfoot>
									<tr class="cart-subtotal">
										<th>Subtotal</th>
										<td><span class="amount">{{ number_format(\Cart::getSubTotal()) }}</span></td>
									</tr>
									<!-- <tr class="cart-subtotal">
										<th>Tax</th>
										<td><span class="amount">{{ number_format(\Cart::getSubTotal()) }}</span></td>
									</tr> -->
									<tr class="cart-subtotal">
										<th>Biaya Ongkos Kirim ({{ $totalWeight }} gram)</th>
										<td><select id="shipping-cost-option" required name="shipping_service"></select></td>
									</tr>
									<tr class="order-total">
										<th>Pesanan Total</th>
										<td><strong><span class="total-amount">{{ number_format(\Cart::getTotal()) }}</span></strong>
										</td>
									</tr>								
								</tfoot>
							</table>
						</div>
						<div class="payment-method">
							<div class="payment-accordion">
								<!-- <div class="panel-group" id="faq">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq" href="#payment-1">Direct Bank Transfer.</a></h5>
										</div>
										<div id="payment-1" class="panel-collapse collapse show">
											<div class="panel-body">
												<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-2">Cheque Payment</a></h5>
										</div>
										<div id="payment-2" class="panel-collapse collapse">
											<div class="panel-body">
												<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-3">PayPal</a></h5>
										</div>
										<div id="payment-3" class="panel-collapse collapse">
											<div class="panel-body">
												<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
											</div>
										</div>
									</div>
								</div> -->
								<div class="order-button-payment" >
									<input type="submit" id="test" value="Pesan" />
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>

	<style>
		.black-text {
    color: black;
}
	</style>
	<!-- checkout-area end -->	
@endsection