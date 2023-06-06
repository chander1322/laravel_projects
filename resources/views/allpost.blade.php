@include('header')
<style>
#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style>
<br>
<h5 class="text-bold">Date filter</h5>
<input type="text" id="myInput" placeholder="Search data.." title="Type in a name">
<table class="table" id="posttable">
  <thead>
    <tr>
      <th scope="col">Sr.No</th>
      <th scope="col">Title</th>
      <th scope="col">Desc</th>
      <th scope="col">Date</th>
      <th scope="col">Image</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0;?>
    @foreach($data as $post)
    <tr>
      <th scope="row">{{++$i}}</th>
      <td>{{$post->title}}</td>
      <td>{{$post->description}}</td>
      <td class="date_filter">{{$post->created_at}}</td>
      <td><img src="{{asset('uploads').'/'.$post->image}}" width="50px" height="50px"></td>
      <td><a href="{{url('postupdata').'/'.$post->id}}"><button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-id="{{ $post->id }}" data-bs-target="#exampleModal">
                Edit
                </button>
            </a>
       </td>
       <td><button type="submit" class="btn btn-danger btn-block delete-record" data-id="{{ $post->id }}">Delete
                    </button>
        </td>
    </tr>
    @endforeach
  </tbody>
  
</table>
<div class="pagination" >
    {{ $data->links() }}
</div>
<!-- Delete -->
<script>
    $(document).ready(function () {
        $('.delete-record').click(function (e) {
            e.preventDefault();
        if (confirm("Are you sure?")) {
            var id = $(this).data('id');
            var url = '/delete/' + id;
            $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function (response) {
                    if (response.success) {
                        console.log(response.message);
                        // Remove the table row from the DOM
                        $(e.target).closest('tr').remove();
                    } else {
                        console.log(response.message);
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        return false;
    });
    //Date filter
    $('#myInput').keyup(function() {
        var filterValue = $(this).val(); 
        $('#posttable tr').each(function() { 
            var dateColumnValue = $(this).find('.date_filter').text(); 
            if (dateColumnValue.indexOf(filterValue) > -1) {
                $(this).show(); 
            } else {
                $(this).hide(); 
            }
        });
    });
 });   
</script>


