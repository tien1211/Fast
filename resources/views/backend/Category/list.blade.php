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
        Category table
       </div>
       
       <a class="btn btn-success glyphicon glyphicon-plus" href="javascript:void(0)" title="Add" id="createNewProduct"> </a>
         
      
      <table class="table table-bordered data-table" id="listCate" ui-jq="footable">
           <thead>
             <tr>
              
               <th data-breakpoints="xs">ID</th>
               <th>Category</th>
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
                <input type="hidden" name="id_cate" id="id_cate">
            {{-- Loại thức ăn --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Category</label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="name_cate"  name="name_cate" placeholder="Enter Name" value="" maxlength="50" required="">
                     </div>
                </div>
            {{-- Loại thức ăn --}}
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
    $(function () {
     
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        var table = $('.data-table').DataTable({
            // processing: true,
            // serverSide: true,
            ajax: "{{ route('listCate') }}",
            columns: [         
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name_cate', name: 'category.name_cate'},
                {data: 'state_cate', name: 'category.state_cate'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });
        


        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#id_cate').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create New Product");
            $('#ajaxModel').modal('show');
            
        });



        $('body').on('click', '.editProduct', function () {
        var id_cate = $(this).data('id');
          $.get("{{ route('editCate') }}",{ id_cate: id_cate }, function (data) {
          $('#modelHeading').html("Edit Category");
          $('#saveBtn').val("edit-category");
          $('#ajaxModel').modal('show');
          $('#id_cate').val(data.id_cate);
          $('#name_cate').val(data.name_cate);
          
      })
   });


        $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('addCate') }}",
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
     
     var id_cate = $(this).data("id");
     var ok= confirm("Are You sure want to delete !");
     if(ok){
      $.ajax({
          type: "DELETE",
          url: "{{route('delCate')}}",
          data: {
           id_cate: id_cate
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



