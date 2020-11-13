@extends('backend.layout.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link rel='stylesheet' type='text/css'
          href='https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <link rel='stylesheet' type='text/css'
          href='https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css'>
@endsection
@section('content')


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open modal
  </button>
  
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>

<div class="table-agile-info">
    <div class="panel panel-default">
       <div class="panel-heading">
        Basic table
       </div>
       <div>
        <div id="paginationListFood" style="margin-bottom: 10px; display: flex;">
          <input class="form-control"
                 type="text"
                 placeholder="Page"
                 id="inputPaginationListFood"
                 style="width: 60px; margin-right: 5px;">
          <button class="btn btn-primary"
                  id="buttonPaginationListFood">
              Go
          </button>
      </div>
      
         <table class="table" id="listFood" ui-jq="footable" ui-options='{
           "paging": {
             "enabled": true
           },
           "filtering": {
             "enabled": true
           },
           "sorting": {
             "enabled": true
           }}'>
           <thead>
             <tr>
               <th></th>
               <th data-breakpoints="xs">ID</th>
               <th>Category</th>
               <th>Discount</th>
               <th>Name</th>
               <th>Desc</th>
               <th>Price</th>
               <th>Preprice</th>
               <th>State</th>
               
             </tr>
           </thead>
           <tfoot>
             {{-- <tr data-expanded="true">
               <td></td>
               <td>ID</td>
               <td>Category</td>
               <td>Discount</td>
               <td>Name</td>
               <td>Desc</td>
               <td>Price</td>
               <td>Preprice</td>
               <td>State</td> --}}
               
           </tfoot>
         </table>
       </div>
     </div>
   </div>
   
   
   <!-- Button to Open the Modal -->

@endsection



@section('script')
    <script type='text/javascript' src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
    <script type='text/javascript' src='https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
    <script type='text/javascript' src='https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js"></script>
    <script type='text/javascript' src='https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js'></script>
    <script>
        $(function () {
            listFood = $('#listFood').DataTable(
            //  $('#listFood').DataTable(
                {
                    dom: 'lifrtBp',
                    
                    processing: true,

                    serverSide: true,
                    
                    ajax: {
                        url: route('getDS'),
                    },
                    buttons: [
                        'excel',
                    ],
                    columns: [
                        {data: null},
                        {
                            data: 'id_food', name: 'food.id_food',
                            // render: function (data) {
                            //     return `<button type="button" class="btn btn-danger">${data}</button>`;
                            // }
                        },
                        {data: 'id_cate', name: 'food.id_cate'},
                        {data: 'id_dis', name: 'food.id_dis'},
                        {data: 'name_food', name: 'food.name_food'},
                        {data: 'desc_food', name: 'food.desc_food'},
                        {data: 'price_food', name: 'food.price_food'},
                        {data: 'preprice_food', name: 'food.preprice_food'},
                        {data: 'state_food', name: 'food.state_food'},
                    ],
                    columnDefs: [
                        {
                            'targets': 0,
                            'checkboxes': {
                                'selectRow': true
                            }
                        }
                    ],
                    // select: {
                    //     'style': 'multi'
                    // },
                    order: [1, 'asc'],
                    // initComplete: function () {
                    //     this.api().columns().every(function () {
                    //         var column = this;
                    //         var input = document.createElement("input");
                    //         $(input).attr('class', 'filter');
                    //         $(input).attr('style', 'width: 100%');
                    //         $(input).appendTo($(column.footer()).empty())
                    //             .on('keyup change', function () {
                    //                 column
                    //                     .search($(this).val(), false, false, true)
                    //                     .draw();
                    //             });
                    //     });
                    //     $('#listFood > tfoot > tr > th:nth-child(1) > input').hide();
                    // },
                }
            );
        });
        $('#buttonPaginationListFood').click(function () {
            var inputPage = parseInt($('#inputPaginationListFood').val());
            var totalPages = listFood.page.info().pages;
            if (!inputPage) {
                alert("Please input the number of page!");
                listFood.off();
            } else if (inputPage > totalPages) {
                alert("Sorry, this page is unavailable!");
            } else {
                listFood.page(inputPage - 1).draw(false);
            }
        });
    </script>
@endsection