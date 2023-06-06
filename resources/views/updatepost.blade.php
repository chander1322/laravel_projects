@include('header')
<div class="col-md-12">
  @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
  @endif
  @if(Session::has('alert-danger'))
  <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('alert-danger') }}</p>
  @endif
  <div class="messages"></div>
</div>

<div class="container card-0 justify-content-center ">
  <div class="card-body px-sm-4 px-0">
    <div class="row justify-content-center mb-5">
      <div class="col-md-10 col">
      </div>
    </div>
    <div class="row justify-content-center round">
      <div class="col-lg-10 col-md-12 ">
        <div class="card shadow-lg card-1">
          <div class="card-body inner-card">
            <div class="row justify-content-center">
              <div class="col-lg-5 col-md-6 col-sm-12">
                <h3>Update Post</h3>
                <form class="updatepost" id="addpost" method="post" action="{{ route('updatepost') }}" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                  <label for="first-name">Title</label>
                  <input type="hidden" class="form-control" value="{{$edit[0]->id}}" name="id">
                 
                  <input type="text" class="form-control" value="{{$edit[0]->title}}" name="title" placeholder="Type Title">
                </div>
                <div class="form-group">
                  <label for="Mobile-Number">Description</label>
                  <input type="text" class="form-control" name="desc" value="{{$edit[0]->description}}" placeholder="Enter Description">
                </div>
                <!-- {{$edit[0]->image}} -->
                <div class="form-group ">
                  <label class="my-auto">Upload Image</label>
                  <input id="file" name="" value="{{$edit[0]->image}}" type="file" class="form-control">
                  <input id="text" name="image" value="{{$edit[0]->image}}" type="hidden" class="form-control">
                </div><br>
                <div class="form-group ">
                    <button type="submit"  class="justify-content-center btn btn-primary btn-block">Update Post
                    </button>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $('.updatepost').submit(function (e) {
      e.preventDefault();
      $.ajax({
        headers:{
            'X-CSRF-TOKEN': $(
                'meta[name="csrf-token"]'
            ).attr("content"),
        },
      });
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response.success) {
            //  $('#addpost')[0].reset(); 
            var messages = $('.messages');
            var successHtml = '<div class="alert alert-success">'+ response.message +'</div>';
            $(messages).html(successHtml);
              // console.log('Image uploaded successfully.');
              // console.log('Image name: ' + response.image);
          } else {
              console.log('Image upload failed.');
          }
        },
        error: function (error) {
          console.log(error);
        }
      });
    });
  });
</script>