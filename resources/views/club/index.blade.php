@include('header')
@include('side-bar')
<div class="col sec_cont club-body">
   <div class="row">
      <div class="head_top">
         <h1> Club Management </h1>
         <div class="dropdown">
            <a class="btn drk-btn" href="{{ route('club-input') }}" role="button">
               Import
            </a>
            <a class="btn btn-secondary dropdown-toggle" href="{{ route('club-export') }}" role="button">
               Export
            </a>
            <a class="btn btn-secondary dropdown-toggle" href="{{ route('club-add') }}" role="button">
               + Add Club Admin
            </a>
         </div>
      </div>
      <div class="coach-m table-responsive">
         <table class="table">
            <thead>
               <tr>
                  <th scope="col">Sr.</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Users</th>
                  <!-- <th scope="col">Group</th> -->
                  <th scope="col">Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach($data as $key=>$item)
               <tr>
                  <td scope="row">{{ ($item->currentpage()-1) * 10 + $key + 1 }}</td>

                  <td>
                     @if($item->image)
                     <img src="{{ asset('Uploads/'.$item->image) }}" width="50" height="50" />
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                     @endif
                  </td>
                  @if(!empty($item->first_name))
                  <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                  @else
                  <td>{{ $item->name }}</td>
                  @endif
                  <td>{{ $item->getUserCount($item->id) }}</td>
                  <td>
                     <a href="#" type="button" class="viewItemId" data-bs-toggle="modal" data-id="{{$item->id}}" data-bs-target="#staticBackdrop">
                     @if(Auth::user()->role_id == "1")
                           <img src="{{ asset('theme/assets/images/eye.svg') }}" alt="edit">
                           @else
                           <img src="{{ asset('theme/assets/images/edit.svg') }}" alt="edit">

                           @endif
                     </a>
                     @if(Auth::user()->role_id == "1")
                        <a href="#" role="button" id="dropdownMenuEdit" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ asset('theme/assets/images/Edit-view.svg') }}" alt="dots">
                           @else
                           <a href="#" role="button" id="dropdownMenuEdit" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ asset('theme/assets/images/3-dots.svg') }}" alt="dots">

                           @endif                     </a>
                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuEdit">
                        <li><a class="dropdown-item" href="{{ route('club-edit', ['id' => $item->id]) }}">Edit
                           </a>
                        </li>
                        <li><a id="delete_data" class="dropdown-item" href="{{ route('club-delete', ['id' => $item->id]) }}">Delete</a></li>
                     </ul>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         {{ $data->links('vendor.pagination.bootstrap-4') }}
         <!-- Modal -->
         <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header cross_bi">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div class="sp_rd add_coach">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('club-create') }}">
                           <div class="row">
                              <div class="col-md-12">
                                 <h4>Club Image</h4>
                                 <div class="user_img">
                                    <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="100" height="100" />
                                    <span>
                                       <input type="file" id="image" name="image">
                                       @if(Auth::user()->role_id == "1")
                                 <img src="{{ asset('theme/assets/images/Camera-b.svg') }}" alt="camera">
                           @else
                           <img src="{{ asset('theme/assets/images/Camera.svg') }}" alt="camera">
                           @endif
                                       Upload Photo
                                    </span>
                                    <a href="#" class="view-pr view-profile">View Profile</a>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <input type="hidden" name="club_id" id="club_id">
                              <div class="col-md-6">
                                 <label> First Name </label>
                                 <input type="text" name="first_name" id="first_name" disabled>
                              </div>
                              <div class="col-md-6">
                                 <label> Last Name </label>
                                 <input type="text" name="last_name" id="last_name" disabled>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <label> Mobile Number </label>
                                 <input type="text" name="phone" id="phone" disabled>
                              </div>
                              <div class="col-md-6">
                                 <label> Email Address </label>
                                 <input type="mail" name="email" id="email" disabled>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12 text-end">
                                 <!-- <a href="{{ url('/club-index') }}" class="btn gry-btn"> Cancel </a>
                                 <button class="btn drk-btn club-update"> Save </button> -->
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
<script>
   $('.viewItemId').click(function() {
      var id = $(this).attr('data-id');
      $(".modal-body #staticBackdrop").val(id);
      $.ajax({
         url: "{{ url('club-detail') }}",
         type: 'GET',
         dataType: 'JSON',
         data: {
            id: $(this).attr('data-id')
         },
         success: function(data) {
            if (data.success) {
               localStorage.setItem('id', data.response.data.id);
               // $("#user_img").val(data.response.data.image);
               $("#club_id").val(data.response.data.id);
               $("#first_name").val(data.response.data.first_name);
               $("#last_name").val(data.response.data.last_name);
               $("#phone").val(data.response.data.phone);
               $("#email").val(data.response.data.email);
               $('#staticBackdrop').modal('show');
               $('.user_img').html('<img src="http://15.188.226.196/public/Uploads/'+data.response.data.image+'"  width="100" height="100"/>');

            }
         }
      });
   });
   $('.view-profile').click(function() {

      var id = $("#club_id").val();
      var url = "{{ url('club-view?id=')}}";
      window.location = url + id;
   });
   $('.club-update').click(function() {
      var id = $("#club_id").val();
      var first_name = $("#first_name").val();
      var last_name = $("#last_name").val();
      $.ajax({
         url: "{{ url('update-club') }}",
         type: 'GET',
         dataType: 'JSON',
         data: {
            id: id,
            first_name: first_name,
            last_name: last_name
         },
         success: function(data) {
            window.location = "{{ url('club-index')}}";
         }
      });
   });
   $(document).on('click', '#delete_data', function() {
      var result = confirm('Do you want to perform this action?');
      if (!result) {
         return false;
      }
   })
</script>
</body>

</html>