@extends('backend.layout.master')

@section('style')



    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <link rel='stylesheet' type='text/css' href='https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="table-agile-info">
    <div class="panel panel-default">
       <div class="panel-heading">
        Basic table
       </div>
       
       <a class="btn btn-success glyphicon glyphicon-plus" href="javascript:void(0)" title="Add" id="createNewProduct"> </a>
         
      
      <table class="table table-bordered data-table" id="listFood" ui-jq="footable">
           <thead>
             <tr>
              
               <th data-breakpoints="xs">ID</th>
               <th>Category</th>
               <th>Discount (%)</th>
               <th>Name</th>
               <th>Price (VND)</th>
               <th>Preprice (VND)</th>
               <th>State</th>
               <th width="7rem">Action</th>
               
             </tr>
           </thead>
           <tbody>                 
           </tbody>
         </table>
       </div>
     </div>
   </div>
   
   <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modelHeading"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form id="productForm" name="productForm" class="form-horizontal">
                <input type="hidden" name="id_food" id="id_food">
            {{-- Loại thức ăn --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Category</label>
                     <div class="col-sm-12">
                         <select required  class="form-control m-bot15"  name="id_cate" id="id_cate">
                          <option value="">Choice Category...</option>
                          @foreach ($category as $sl_cate)
                          @if ($sl_cate->state_cate == 1)
                          <option value='{{$sl_cate->id_cate}}'>{{$sl_cate->name_cate}}</option>
                          @endif
                          @endforeach
                        </select>
                     </div>
                </div>
            {{-- Loại thức ăn --}}

            {{-- Khuyến mãi --}}
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Discount</label>
                <div class="col-sm-12">
                  <select required  class="form-control m-bot15"  name="id_dis" id="id_dis">
                    <option value="">Choice Discount...</option>
                    @foreach ($discount as $sl_dis)
                    @if ($sl_dis->state_dis == 1)
                    <option value='{{$sl_dis->id_dis}}'>{{$sl_dis->content_dis}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
           </div>

           {{-- Khuyến mãi --}}

           {{-- Tên sản phẩm --}}
           <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-12">
                  <input type="text" class="form-control" id="name_food"  name="name_food" placeholder="Enter Name" value="" maxlength="50" required="">
              </div>
            </div>
            {{-- Tên sản phẩm --}}



            {{-- Mô tả --}}
                <div class="form-group">
                     <label class="col-sm-2 control-label">Description</label>
                     <div class="col-sm-12">
                         <textarea  id="desc_food" name="desc_food" required="" placeholder="Enter Details" class="form-control"></textarea>
                     </div>
                </div>


                {{-- Giá sản phẩm --}}
           <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Price</label>
              <div class="col-sm-12">
                  <input type="text" class="form-control" id="price_food"  name="price_food" placeholder="Enter Name" value="" maxlength="50" required="">
              </div>
            </div>
            {{-- Giá sản phẩm --}}

            {{-- Giá củ --}}
           <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Price-old</label>
              <div class="col-sm-12">
                  <input type="text" class="form-control" id="preprice_food"  name="preprice_food" placeholder="Enter Name" value="" maxlength="50" required="">
              </div>
            </div>
            {{-- Giá củ --}}
    </div>

            

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
            </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
  
      </div>
    </div>
  </div>


@endsection


@section('script')



    <script type='text/javascript' src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
    <script type='text/javascript' src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
    <script type='text/javascript' src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js"></script>
    <script type='text/javascript' src='https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js'></script>
    
    <script type="text/javascript">
    $(function () {
     
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        var table = $('.data-table').DataTable({
            // processing: true,
            // serverSide: true,
            ajax: "{{ route('listFood') }}",
            columns: [         
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'category', name: 'category.name_cate'},
                {data: 'discount', name: 'discount.content_dis'},
                {data: 'name_food', name: 'food.name_food'},
                {data: 'food', name: 'food.price_food'},
                {data: 'food', name: 'food.preprice_food'},
                {data: 'state_food', name: 'food.state_food'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });



        


        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#id_food').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create New Product");
            $('#ajaxModel').modal('show');
            
        });
     
        $('body').on('click', '.editProduct', function () {
        var id_food = $(this).data('id');
          $.get("{{ route('editFood') }}",{ id_food: id_food }, function (data) {
          console.log(data);
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#id_food').val(data.id_food);
          $('#id_cate').val(data.id_cate);
          $('#id_dis').val(data.id_dis);
          $('#name_food').val(data.name_food);
          $('#desc_food').val(data.desc_food);
          $('#price_food').val(data.price_food);
          $('#preprice_food').val(data.preprice_food);
      })
   });



        $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('addFood') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('hide');
            table.ajax.reload();
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
     
    $('body').on('click', '.deleteProduct', function () {
     
    var id_food = $(this).data("id");
   var ok= confirm("Are You sure want to delete !");
    if(ok){
     $.ajax({
         type: "DELETE",
         url: "{{route('delFood')}}",
         data: {
          id_food: id_food
         },

         success: function (data) {
             table.ajax.reload();
             
         },
         
         error: function (data) {
             console.log('Error:', data);
         }
     });
    }else{

      return false;

      }
   });


  });

        
</script>
@endsection



