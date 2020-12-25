
@extends('frontend.layout.master')

@section('product')


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Products</span>
                <h2 class="mb-4">Store's Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>   		
    </div>
    <div class="container">
        <div class="row">
            @foreach ($food as $ff)
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                   
                    <a href="{{route('productPages',['id'=>$ff->id_food])}}" class="img-prod"><img class="img-fluid" src="frontend/images/{{$ff->img_food}}.jpg" alt="Colorlib Template">
                    @if ($ff->id_dis == 1)
                            

                    @else
                    <span class="status">
                        {{$ff->discount->content_dis}}%</span>
                        <div class="overlay"></div>
                    @endif
                        
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                    <h3><a href="{{route('productPages',['id'=>$ff->id_food])}}">{{$ff->name_food}}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price">
                                    @if ($ff->preprice_food == null)
                                    
                                    
                                    <span class="price-sale">{{number_format($ff->price_food)}} VNĐ</span></p>    
                                    @else
                                    <span class="mr-2 price-dc">{{number_format($ff->preprice_food)}} VNĐ</span>
                                    <span class="price-sale">{{number_format($ff->price_food)}} VNĐ</span></p>
                                    
                                    
                                    @endif
                                    
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="{{route('productPages',['id'=>$ff->id_food])}}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                            <a href="javascript:void(0);" data-id="{{$ff->id_food}}" class="addcart buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart "></i></span>
                                </a>

                                
                                <a href="javascript:void(0);" data-id="{{$ff->id_food}}" class="heart d-flex justify-content-center align-items-center " >
                                    <span><i class="ion-ios-heart"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
          @endforeach
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

   

        $('.addcart').click(function (e) {
            e.preventDefault();
   
            $.ajax({
                url: "{{route('addCart')}}",
                method:"POST",
                data:{
                    id_food : $(this).data('id')
                }
            }).done(function(data){
                loadCountCart(data.count)
                alert(data.success);
            }).error(function(e){
                
            });
        
         });


        $('.heart').click(function (e) {
            e.preventDefault();
   
            $.ajax({
                url: "{{route('addWishList')}}",
                method:"POST",
                data:{
                    id_food : $(this).data('id')
                }
            }).done(function(data){
                loadCountWishList(data.count)
                alert(data.success);
            }).error(function(e){
                console.log(e);
            });
        
         });

    </script>


@endsection

