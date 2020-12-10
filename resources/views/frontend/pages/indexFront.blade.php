@extends('frontend.layout.master')
@section('index')
        {{-- Loại sản phẩm --}}
		<section class="ftco-section ftco-category ftco-no-pt">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							@foreach ($category as $cate)
								<div class="col-md-4">
									<div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(frontend/images/{{$cate->img_cate}}.jpg);">
										<div class="text px-3 py-1">
											<h2 class="mb-0"><a href="{{route('categoryPages',['id'=>$cate->id_cate])}}">{{$cate->name_cate}}</a></h2>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				<div>Sản phẩm mới nhất</div>


				
				<div>Sản phâm giảm giá</div>
				<div>Sản phẩm nổi bật</div>

				

				
			</div>
		</section>

    
@endsection