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
        Discount table
       </div>
       
       <a class="btn btn-success glyphicon glyphicon-plus" href="javascript:void(0)" title="Add" id="createNewProduct"> </a>
         
      
      <table class="table table-bordered data-table" id="listDis" ui-jq="footable">
           <thead>
             <tr>
              
               <th data-breakpoints="xs">ID</th>
               <th>Topic</th>
               <th>Content (%)</th>
               <th>Start</th>
               <th>End</th>
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
                <input type="hidden" name="id_dis" id="id_dis">
            {{-- Sự kiện --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Topic</label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="topic_dis"  name="topic_dis" placeholder="Enter Name" value="" maxlength="50" required="">
                     </div>
                </div>
            {{-- Sự kiện --}}

            {{-- Nội dung --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Content</label>
                     <div class="col-sm-12">
                        <input type="number" class="form-control" id="content_dis"  name="content_dis" placeholder="Enter Name" value="" maxlength="50" required="">
                     </div>
                </div>
            {{-- Nội dung --}}

            {{-- Ngày bắt đầu --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Start</label>
                     <div class="col-sm-12">
                        <input type="date" class="form-control" id="start_dis"  name="start_dis" placeholder="Enter Name" value="" maxlength="50" required="">
                     </div>
                </div>
            {{-- Ngày bắt đầu --}}

            {{-- Ngày kết thúc --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">End</label>
                     <div class="col-sm-12">
                        <input type="date" class="form-control" id="end_dis"  name="end_dis" placeholder="Enter Name" value="" maxlength="50" required="">
                     </div>
                </div>
            {{-- Ngày kết thúc --}}



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
            ajax: "{{ route('listDis') }}",
            columns: [         
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'topic_dis', name: 'discount.topic_dis'},
                {data: 'content_dis', name: 'discount.content_dis'},
                {data: 'start_dis', name: 'discount.start_dis'},
                {data: 'end_dis', name: 'discount1.end_dis'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });
        


        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#id_dis').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create New Product");
            $('#ajaxModel').modal('show');
            
        });

        $('body').on('click', '.editProduct', function () {
        var id_dis = $(this).data('id');
        
          $.get("{{ route('editDis') }}",{ id_dis: id_dis }, function (data) {
          $('#modelHeading').html("Edit Discount");
          $('#saveBtn').val("edit-category");
          $('#ajaxModel').modal('show');
          
          $('#id_dis').val(data.id_dis);
          $('#topic_dis').val(data.topic_dis);
          $('#content_dis').val(data.content_dis);
          $('#start_dis').val(data.start_dis);
          $('#end_dis').val(data.end_dis);
          
      })
   });

            function formatDate(value){

            }
        $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('addDis') }}",
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
     
     var id_dis = $(this).data("id");
     var ok= confirm("Are You sure want to delete !");
     if(ok){
      $.ajax({
          type: "DELETE",
          url: "{{route('delDis')}}",
          data: {
           id_dis: id_dis
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



