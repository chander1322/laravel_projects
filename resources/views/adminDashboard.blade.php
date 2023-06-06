@include('header')
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
              <div class="messages"></div>
              </div>
              <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>

                <h2>Add a New Post </h2>
                <form  id="addpost" method="post" action="{{ route('addpost') }}" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                  <label for="first-name">Title</label>
                  <input type="text" class="form-control" name="title" placeholder="Type Title">
                  <span id="title-error"></span>
                </div>
                <div class="form-group">
                  <label for="Mobile-Number">Description</label>
                  <input type="text" class="form-control" name="desc" placeholder="Enter Description">
                </div>
                <div class="form-group ">
                  <label class="my-auto">Upload Image</label>
                  <input id="file" name="image" type="file" class="form-control">
                </div><br>
                <div class="form-group ">
                    <button type="submit" class="justify-content-center btn btn-primary btn-block">Add Post
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
    $('#addpost').submit(function (e) {
      e.preventDefault();
      $.ajax({
          headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")},
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
              $('#addpost')[0].reset(); 
              var messages = $('.messages');
              var successHtml = '<div class="alert alert-success">'+ response.message +'</div>';
              $(messages).html(successHtml);
            } else {
              console.log(response.error);

            }
          },
          error: function (error) {
            console.log(error);
          }
        });
    });
    // function printErrorMsg (msg) {
    //         $(".print-error-msg").find("ul").html('');
    //         $(".print-error-msg").css('display','block');
    //         $.each( msg, function( key, value ) {
    //             $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    //         });
    //     }
  });
</script>