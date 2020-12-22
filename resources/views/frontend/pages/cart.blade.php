@extends('frontend.layout.content')
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('frontend/images/slider1.jpg');">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
          <h1 class="mb-0 bread">My Cart</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-cart">
          <div class="container">
              <div class="row">
              <div class="col-md-12 ftco-animate">
                  <div class="cart-list">
                      <table class="table">
                          <thead class="thead-primary">
                            <tr class="text-center">
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Product name</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($cartContent as $itemCart)
                            <tr class="text-center" id="product_{{ $itemCart->id }}">
                              <td class="product-remove"><a class="cart_delete" data-product-id="{{ $itemCart->id }}" data-id="{{ $itemCart->rowId }}"><span class="ion-ios-close"></span></a></td>
                              
                              <td class="image-prod"><div class="img" style="background-image:url(frontend/images/{{$itemCart->options->image}}.jpg);"></div></td>
                              
                              <td class="product-name">
                                  <h3>{{$itemCart->name}}</h3>
                                  <p>{{$itemCart->options->desc}}</p>
                              </td>
                              
                              <td class="price">{{number_format($itemCart->price)}}</td>
                              

                              <form action="{{ route('updateCart') }}" method="post" class="form-update-cart">
                                @csrf
                                <input type="hidden" name="rowId" value="{{ $itemCart->rowId }}">
                                <td class="quantity">
                                    <div class="input-group mb-3">
                                        <input type="number" name="quantity" id="quantity_{{$itemCart->id}}" class="quantity form-control input-number" value="{{$itemCart->qty}}" min="1" max="100">
                                    </div>
                                </td>
                              
                                <td class="total cart_total_price" >{{number_format($itemCart->priceTotal)}} VNĐ</td>
                                <td> <button type="submit" href="javascript:void(0);" data-id="{{ $itemCart->id }} " class="cart_update btn btn-warning py-3 px-4">Update</button> </td>
                            </form>

                        </tr><!-- END TR-->
                            @endforeach
                           <!-- END TR-->
                          </tbody>
                        </table>
                    </div>
              </div>
          </div>
          <div class="row justify-content-end">
              
             
              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                  <div class="cart-total mb-3">
                      <h3>Cart Totals</h3>
                      <p class="d-flex">
                          <span>Subtotal</span>
                          <span class="subtotal">{{ Cart::subtotal() .' '. 'VNĐ' }}</span>
                      </p>
                      <p class="d-flex">
                          <span>Delivery</span>
                          <span>$0.00</span>
                      </p>
                      <p class="d-flex">
                          <span>Discount</span>
                          <span>$3.00</span>
                      </p>
                      <hr>
                      <p class="d-flex total-price">
                          <span>Total</span>
                          <span class="subtotal">{{ Cart::subtotal() .' '. 'VNĐ' }}</span>
                      </p>
                  </div>
                  <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
              </div>
          </div>
          </div>
      </section>

      
@endsection

@section('script')
      <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.cart_delete').click(function(){
            var rowId = $(this).data('id');
            var itemId = $(this).data('product-id');

        
            $.get("{{ route('delCart') }}", {rowId: rowId}, function(data){
                loadCountCart(data.itemInCart);
                $('.subtotal').text(data.subtotal+" VNĐ");
            }).done(function() {
                document.getElementById('product_'+ itemId).remove();
            }).fail(function() {
                alert( "error" );
            });
        });


    
        $('.form-update-cart').submit(function(e){
        e.preventDefault();       
        var form = $(this);
        
        let food_Subtotal = form.parent().find('.cart_total_price');

        let url = form.attr('action');
        let rowId = $(this).data('id');
        console.log(rowId);
        $.ajax(
            {
                url: url,
                type: "POST",
                data: form.serialize(),
            }).done(function(data){
                loadCountCart(data.itemInCart);
                $('.subtotal').text(data.subtotal+" VNĐ");
                food_Subtotal.text(data.pSubtotal+" VNĐ");
                alert('thành công')
            }).fail(function(data){
                alert('thất bại')
        });
    });



    





    
      </script>


@endsection
   
