
@extends('frontend.layout.content')

@section('rating')
<style>
.post_ratings .rating_submit {
    padding: 8px 30px;
    display: inline-block;
    background-color: #039be5;
    color: #fff;
    border: none;
    cursor: pointer;
}
.rating_submit_inner {
    display: block;
    direction: rtl;
    unicode-bidi: bidi-override;
    /* text-align: center; */
}
.rating_submit_inner .star {
    display: none;
}
.rating_submit_inner label {
    color: lightgray;
    display: inline-block;
    font-size: 60px;
    margin: 0 -2px;
    transition: transform .15s ease;
    cursor: pointer;
}
.rating_submit_inner label:hover {
    transform: scale(1.35, 1.35);
}
.rating_submit_inner label:hover,
.rating_submit_inner label:hover ~ label {
    color: orange;
}
.rating_submit_inner .star:checked ~ label {
    color: orange;
}
.post_ratings .fa {
    color: #ff9800;
}
.post_ratings .fa.light {
    color: #d3d3d3;
}
    
    </style>
@endsection


@section('comment')




<style>
    .container1 {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
      width: 60%;
    }
    
    /* .darker {
      border-color: #ccc;
      background-color: #ddd;
    } */
    
    .container1::after {
      content: "";
      clear: both;
      display: table;
    }
    
    .container1 img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }
/*     
    .container img.right {
      float: right;
      margin-left: 20px;
      margin-right:0;
    }
     */
    .time-right {
      float: right;
      color: #aaa;
    }
    
    .time-left {
      float: left;
      color: #999;
    }
    </style>







@endsection

@section('content')

<section class="ftco-section">
    <div class="container">
        <div class="row">
           
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="frontend/images/{{$food->img_food}}.jpg" class="image-popup"><img src="frontend/images/{{$food->img_food}}.jpg" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3>{{$food->name_food}}</h3>
                <div class="rating d-flex">
                        <p class="text-left mr-4">
                            @for($i = 1; $i<=5;$i++)
                            @php
                                 $style = ($i > $rate[$food->id_food])  ? "class='ion-ios-star-outline'" : "class='ion-ios-star' style='color: #ffcc00;'"   ; 
                               
                            @endphp
                            <a href="#"><span {!!$style!!}></span></a>
                            @endfor      
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">{{$countRating}} <span style="color: #bbb;">Rating</span></a>
                        </p>
                        <p class="text-left">
                            {{-- <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a> --}}
                        </p>
                            </div>
                            <p class="price"><span class="price-dc" ><h5 style="text-decoration: line-through;">{{number_format($food->preprice_food)}} VNĐ</h5></span></p>
                        <p class="price"><span class="price-dc">{{number_format($food->price_food)}} VNĐ</span></p>
                <p>{{$food->desc_food}}</p>
            <div class="row mt-4">
                      
                        <div class="w-100"></div>
                <form action="{{route('addCart')}}" method="POST" class="addcart-form">
                    @csrf
                    <input type="hidden" name="id_food" value="{{ $food->id_food }}">
                    <div class="input-group col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                                <i class="ion-ios-remove"></i>
                            </button>
                        </span>

                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                        
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                <i class="ion-ios-add"></i>
                            </button>
                        </span>

                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <p style="color: #000;"></p>
                    </div>
            </div>
                    <p><a href="javascript:void(0);" data-id="{{$food->id_food}}" class="addcart btn btn-black py-3 px-5">Add to Cart</a></p>
                    
            </div>
        </form>
        </div>
    </div>
</section>



<div class="container mt-3" >
    <h4>Comment</h4>      
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} 
        
        <a class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach



@if (!isset($auth))
<div class="post_ratings">
       
     <div class="rating_submit_inner" title="Required Login">
         <input id="radio1" type="radio" name="rating" value="5" class="star"/>
         <label for="radio1">&#9733;</label>
         <input id="radio2" type="radio" name="rating" value="4" class="star"/>
         <label for="radio2">&#9733;</label>
         <input id="radio3" type="radio" name="rating" value="3" class="star"/>
         <label for="radio3">&#9733;</label>
         <input id="radio4" type="radio" name="rating" value="2" class="star"/>
         <label for="radio4">&#9733;</label>
         <input id="radio5" type="radio" name="rating" value="1" class="star"/>
         <label for="radio5">&#9733;</label>
     </div>
 </div>
 @else
 <div class="post_ratings">
   
    <form id="addStar" action="{{route('rating')}}" method="POST">
        @csrf
        <input type="hidden" name="id_food" value="{{ $food->id_food }}">
     <div class="rating_submit_inner">
         <input id="radio1" type="radio" name="rating" value="5" class="star"/>
         <label for="radio1">&#9733;</label>
         <input id="radio2" type="radio" name="rating" value="4" class="star"/>
         <label for="radio2">&#9733;</label>
         <input id="radio3" type="radio" name="rating" value="3" class="star"/>
         <label for="radio3">&#9733;</label>
         <input id="radio4" type="radio" name="rating" value="2" class="star"/>
         <label for="radio4">&#9733;</label>
         <input id="radio5" type="radio" name="rating" value="1" class="star"/>
         <label for="radio5">&#9733;</label>
     </div>
       
    
    </form>
        
 </div>
@endif
    
 
    <div id="commentList" style="overflow-y: scroll; height: 20rem;">
        @foreach ($comment as $item)
        <div class="container1">
            <h5>{{$item->emp->username}}</h5>
            
            <p>{{$item->content_cmt}}</p>
            <span class="time-right">{{date(' H:m:s d-m-Y ',strtotime($item->created_at))}}</span>
            <span><a href="#">Reply</a> &nbsp; &nbsp; 
            <a href="{{route('delComment',['id'=>$item->id_cmt])}}">Delete</a> &nbsp; &nbsp; <a href="" data-toggle="modal" data-target="#myModal">Update</a></span>
            @if ($item->replies->count() > 0)
                @foreach ($item->replies as $rep)
        </div>
                <div class="container1" style="margin-left: 50px">
                    <h3>{{$rep->emp->username}}</h3>
                    
                    <p>{{$rep->content_cmt}}</p>
                    <span class="time-right">{{date(' H:m:s d-m-Y ',strtotime($rep->created_at))}}</span>
                @endforeach
            
            @endif 
                </div>


                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    
                    
                        <div class="modal-header">
                        <h4 class="modal-title">Update comment of {{$item->emp->username}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                    
                        <form action="{{route('upComment',['id'=>$item->id_cmt])}}" method="POST">
                            @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea name="content_cmt" cols="90" rows="7" class="form-control" placeholder="Message">{{$item->content_cmt}}</textarea>
                            </div>
                        </div>
                        
                
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Message</button>
                            <button type="close" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>




        @endforeach
    </div>
  
    <div class="row block-9">
        <div class="col-md-12 order-md-last d-flex">
          <form id="commentForm"  class="bg-white p-5 contact-form">
            @csrf
            <input type="hidden" name="id_food" value="{{ $food->id_food }}">
            <div class="form-group">
              <textarea name="content_cmt" cols="90" rows="7" class="form-control" placeholder="Message"></textarea>
            </div>

            <div class="form-group">@if (!isset($auth))
              <input onclick="return alert('Bạn chưa đăng nhập!!')" disabled value="Login Pls!!! " class="btn btn-primary py-3 px-5">
              @else
              <input type="submit" value="Send Message " id="saveBtn" onclick="showComment({{$food->id_food}})" class="btn btn-primary py-3 px-5">
              @endif
            </div>
          </form>
        
        </div>
</div>




<section class="ftco-section">
    <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
          <span class="subheading">Products</span>
        <h2 class="mb-4">Related Products</h2>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
      </div>
    </div>   		
    </div>
    <div class="container">
        <div class="row">
            @foreach ($relate as $relF)
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="{{route('productPages',['id'=>$relF->id_food])}}" class="img-prod"><img class="img-fluid" src="frontend/images/{{$relF->img_food}}.jpg" alt="Colorlib Template">
                        <span class="status">30%</span>
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                    <h3><a href="{{route('productPages',['id'=>$relF->id_food])}}">{{$relF->name_food}}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="{{route('productPages',['id'=>$relF->id_food])}}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a href="javascript:void(0);" data-id="{{$relF->id_food}}" class="addcartR buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                <a href="javascript:void(0);" data-id="{{$relF->id_food}}" class="heart d-flex justify-content-center align-items-center ">
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
//comment
$('#saveBtn').click(function (e) {
        e.preventDefault();
        $.ajax({
          data: $('#commentForm').serialize(),
          url: "{{route('commentPost')}}",
          type: "POST",
          dataType: 'JSON',
          success: function (data) {
            console.log(data);
            alert(data.message);
          },
          error: function (data) {
              console.log(data);
              alert(data.message)
          }
        });
    });



//loadcomment




// $("#saveBtn").click(function(){
//   $.ajax({url: "./getComment/"+"{{$food->id_f}}", success: function(result){
//     $("#commentList").html(result);
//   }});
// });

// cái đoạn t bắt load lại comment nè
function showComment(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("commentList").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("commentList").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "./getComment/"+str, true);
  xhttp.send();
}


//shoping cart

        
        $('.addcart').click(function(){
            $('.addcart-form').submit();
        });

        $('.addcart-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('addCart')}}",
                method:"POST",
                data: $(this).serialize(),
                
            }).done(function(data){
                loadCountCart(data.count)
                alert(data.success);
            }).error(function(e){
                alert("thất bại")
                console.log(e);
            });
        });



        $('.addcartR').click(function (e) {
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
                alert("thất bại")
            });
        
         });  

//wishlist
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





//Rating
$('#addStar').change('.star', function(e) {

  $.ajax({
    type: 'POST',
    cache: false,
    dataType: 'JSON',
    url: $(this).attr('action'),
    data: $(this).serialize(),
    success: function(data) {
      console.log(data);
      alert(data.message);
    },
    
  }).error(function(e){
        console.log(e);
        alert(e.message);
    });
});




    </script>


@endsection