<section class="ftco-section ftco-partner">
    <div class="container">
        <div class="row">
            @foreach ($store as $store)
            <div class="col-sm ftco-animate">
                <a href="#" class="partner"><img src="frontend/images/{{$store->img_store}}.jpg" class="img-fluid" alt="Colorlib Template"></a>
            </div>    
            @endforeach
            
            
        </div>
    </div>
</section>