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
        Store table
       </div>
       
       <a class="btn btn-success glyphicon glyphicon-plus" href="javascript:void(0)" title="Add" id="createNewProduct"> </a>
         
      
      <table class="table table-bordered data-table"  ui-jq="footable">
           <thead>
             <tr>
              
               <th data-breakpoints="xs">ID</th>
               <th>Address</th>
               <th>Name</th>
               <th>Phone</th>
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
                <input type="hidden" name="id_store" id="id_store">
            {{-- Địa chỉ --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Address</label>
                     <select required  class="form-control m-bot15"  name="id_address" id="id_address">
                      <option value="">Choice Discount...</option>
                      @foreach ($address as $sl_addr)
                      @if ($sl_addr->state_address == 1)
                     <option value='{{$sl_addr->id_address}}'>{{$sl_addr->number_address}}  {{$sl_addr->street_address}}, {{$sl_addr->district_address}}</option>
                      @endif
                      @endforeach
                    </select>
                </div>
            {{-- Địa chỉ --}}

            {{-- Tên cửa hàng --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Name</label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="name_store"  name="name_store" placeholder="Enter Name" value="" maxlength="50" required="">
                     </div>
                </div>
            {{-- Tên cửa hàng --}}

            {{-- Số phone --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Phone </label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="phone_store"  name="phone_store" placeholder="Enter Name" maxlength="50" required="">
                     </div>
                </div>
            {{-- Số phone --}}

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes </button>
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
    $(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            ajax:"{{route('listSto')}}",
            columns: [
                {data:'DT_RowIndex'},
                {data:'addressStreet'},
                {data:'name_store'},
                {data:'phone_store'},
                {data:'state_store'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
        });

        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#id_store').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create New Product");
            $('#ajaxModel').modal('show');
            
        });

        $('body').on('click', '.editProduct', function () {
        var id_store = $(this).data('id');
          $.get("{{ route('editSto') }}",{ id_store: id_store }, function (data) {
          
          $('#modelHeading').html("Edit Store");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#id_store').val(data.id_store);
          $('#id_address').val(data.id_address);
          $('#name_store').val(data.name_store);
          $('#phone_store').val(data.phone_store);
      })
   });

        $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('addSto') }}",
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
     
     var id_store = $(this).data("id");
     var ok= confirm("Are You sure want to delete !");
     if(ok){
      $.ajax({
          type: "DELETE",
          url: "{{route('delSto')}}",
          data: {
           id_store: id_store
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



