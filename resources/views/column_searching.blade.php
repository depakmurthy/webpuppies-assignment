<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>All Restuarants</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">    
     <br />
     <h3 align="center">All Restuarants</h3>
     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="product_table">
     <thead>
      <tr>
        <th>Restuarant Name</th>
        <th class="text-center">Rating</th>
        <th class="text-center">Number of visits</th>
        <th class="text-center">Open date(s)</th>
        <th class="text-center">
          <select name="category_filter" id="category_filter" class="form-control">
            <option value="">Select Restuarant Status</option>
              @foreach($category as $row)
                <option value="{{ $row->category_id }}">{{ $row->category_name }}</option>
              @endforeach
          </select>
        </th>
      </tr>
     </thead>
    </table>
   </div>
   <br />
   <br />
  </div>
 </body>
</html>


<script>
$(document).ready(function(){

 fetch_data();

 function fetch_data(category = '')
 {

  $('#product_table').DataTable({
   processing: true,
   serverSide: true,
   ajax: {
    url:"{{ route('column-searching.index') }}",
    data: {category:category}
   },
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
   columns:[
    {data: 'resname', resname: 'resname'},
    {data: 'rating', rating: 'rating'},
    {data: 'visits', visits: 'visits'},
    {data: 'date', date: 'date'},
    {data: 'category_name', name: 'category_name', orderable: false}
   ]
  });
 }

 $('#category_filter').change(function(){
  var category_id = $('#category_filter').val();

  $('#product_table').DataTable().destroy();

  fetch_data(category_id);
 });
 
});
</script>