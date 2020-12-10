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
        Member table
       </div>
       
       <a class="btn btn-success glyphicon glyphicon-plus" href="javascript:void(0)" title="Add" id="createNewProduct"> </a>
         
      
      <table class="table table-bordered data-table" id="listMember" ui-jq="footable">
           <thead>
             <tr>
              
               <th data-breakpoints="xs">ID</th>
               <th>Username</th>
               <th>Name</th>
               <th>BirthDay</th>
               <th>Gender</th>
               <th>Permission</th>
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
                <input type="hidden" name="id_emp" id="id_emp">
            {{-- Username --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Username</label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="username"  name="username" placeholder="thêm thành viên" value="" maxlength="50" required="">
                     </div>
                </div>
            {{-- Username --}}

            {{-- Password --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Password</label>
                     <div class="col-sm-12">
                        <input type="password" class="form-control" id="password"  name="password" maxlength="50" required="">
                     </div>
                </div>
            {{-- Password --}}

            {{-- Name --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Name</label>
                     <div class="col-sm-12">
                        <input type="text" class="form-control" id="name_emp"  name="name_emp" placeholder="Enter Name" value="" maxlength="50" required="">
                     </div>
                </div>
            {{-- Name --}}

            {{-- Birth --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Birth</label>
                     <div class="col-sm-12">
                        <input type="date" class="form-control" id="birth_emp"  name="birth_emp" placeholder="Enter Name" value="" maxlength="50" required="">
                     </div>
                </div>
            {{-- Birth --}}

            {{-- Gender --}}
                <div class="form-group">
                     <label for="name" class="col-sm-2 control-label">Gender</label>
                     <div class="col-sm-12">
                        <label class="radio-inline"style="margin-left: 20px;">
                            <input type="radio" id="gender_emp" name="gender_emp" value="0" 
                            
                            > Male
                        </label>
                        <label class="radio-inline" style="margin-left: 100px;">
                            <input type="radio" id="gender_emp" name="gender_emp" value="1"> Female
                        </label>
                    </div>
                </div>
            {{-- Gender --}}
            
            {{-- Permission --}}
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Permission</label>
                <div class="col-sm-12">
                    <select required  class="form-control m-bot15"  name="per_emp" id="per_emp">
                     <option value="">Choice Permission...</option>
                     
                        <option value='0'>Admin</option>
                        <option value='1'>Member</option>
                        <option value='2'>Shipper</option>
                        
                   </select>
                </div>
           </div>
       {{-- Permission --}}
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
            ajax: "{{ route('listMember') }}",
            columns: [         
                {data: 'DT_RowIndex'},
                {data: 'username'},
                {data: 'name_emp'},
                {data: 'birth'},
                {data: 'gender'},
                {data: 'per'},
                {data: 'state'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });
        


        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#id_emp').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create New Member");
            $('#ajaxModel').modal('show');
            
        });



        $('body').on('click', '.editProduct', function () {
        var id_emp = $(this).data('id');
          $.get("{{ route('editMem') }}",{ id_emp: id_emp }, function (data) {
          $('#modelHeading').html("Edit Category");
          $('#saveBtn').val("edit-category");
          $('#ajaxModel').modal('show');
          $('#id_emp').val(data.id_emp);
          $('#username').val(data.username);
          $('#password').val(data.password);
          $('#name_emp').val(data.name_emp);
          $('#birth_emp').val(data.birth_emp);
          $('input[name="gender_emp"]:checked').val(data.gender_emp);
          $('#per_emp').val(data.per_emp);
      })
   });


        $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('addMem') }}",
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
     
     var id_emp = $(this).data("id");
     var ok= confirm("Are You sure want to delete !");
     if(ok){
      $.ajax({
          type: "DELETE",
          url: "{{route('delMem')}}",
          data: {
           id_emp: id_emp
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



