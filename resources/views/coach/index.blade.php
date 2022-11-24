@include('header')
@include('side-bar')
<div class="col sec_cont club-body">
   <div class="row">
      <div class="head_top">
         <h1> Coach Management </h1>
         <div class="dropdown">
         <a class="btn btn-secondary dropdown-toggle" href="{{ route('coach-export') }}" role="button" >
                        Export 
                        </a>
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
               + Add Coach
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
               <li><a class="dropdown-item" href="{{ route('coach-add-form') }}">Add New Coach
                  </a>
               </li>
               <li><a class="dropdown-item" href="{{ route('coach-existing') }}">Change Role</a></li>
            </ul>
         </div>
      </div>  
      <div class="coach-m table-responsive">
         <table class="table">
            <thead>
               <tr>
                  <th scope="col">Sr.</th>
                  <th scope="col">Image</th>
                  <th scope="col">Name</th>
                  <th scope="col">Teams</th>
                  <th scope="col">Roles</th>
                  <th scope="col">Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach($data as $key=>$item)
               <tr>
               <td scope="row">{{ ($item->currentpage()-1) * 10 + $key + 1 }}</td>
                  <td> 
                  @if($item->image)
                  <img src="{{ asset('Uploads/'.$item->image) }}" alt="image" width="50" height="50" />
                  @else
                  <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                  @endif
                  </td>
                  <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                  <td>{{ $item->playerTeamCount($item->id) }}</td> 
                  <td>Coach</td> 
                  <td>
                     <a href="{{ route('coach-view', ['id' => $item->id]) }}" type="button" class="">
                        <img src="{{ asset('theme/assets/images/edit.svg') }}" alt="edit">
                     </a>
                     <a href="#" role="button" id="dropdownMenuEdit" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ asset('theme/assets/images/3-dots.svg') }}" alt="dots">
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuEdit">
                        <li><a class="dropdown-item" href="{{ route('coach-edit', ['id' => $item->id]) }}">Edit
                           </a>
                        </li>
                        <li><a id="delete_data" class="dropdown-item" href="{{ route('coach-delete', ['id' => $item->id]) }}">Delete</a></li>
                        <li><a class="dropdown-item" href="{{ route('coach-archive', ['id' => $item->id]) }}">Archive </a></li>

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
                        <form action="/action_page.php">
                           <div class="row">
                              <div class="col-md-12">
                                 <h4>Coach Image</h4>
                                 <div class="user_img">
                                    <img src="{{ asset('theme/assets/images/pic.png') }}" alt="user">
                                    <span>
                                       <input type="file" name="user">
                                       @if(Auth::user()->role_id == "1")
                                 <img src="{{ asset('theme/assets/images/Camera-b.svg') }}" alt="camera">
                           @else
                           <img src="{{ asset('theme/assets/images/Camera.svg') }}" alt="camera">
                           @endif
                                       Upload Photo</span>
                                    <a href="#" class="view-pr">View Profile</a>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <label> First Name </label>
                                 <input type="name" name="name">
                              </div>
                              <div class="col-md-6">
                                 <label> Last Name </label>
                                 <input type="text" name="name">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <label> Mobile Number </label>
                                 <input type="text" name="name">
                              </div>
                              <div class="col-md-6">
                                 <label> Email Address </label>
                                 <input type="mail" name="name">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <label> Assign Role </label>
                                 <label class="sd">
                                    <select>
                                       <option> </option>
                                       <option> Assign Role </option>
                                       <option> Assign Role </option>
                                    </select>
                                    <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                                 </label>
                                 <div class="bootstrap-tagsinput">
                                    <span class="tag label label-info">Coach<span data-role="remove"><img src="{{ asset('theme/assets/images/tagcross.svg') }}" alt="camera"></span></span>
                                    <span class="tag label label-info">Manager<span data-role="remove"><img src="{{ asset('theme/assets/images/tagcross.svg') }}" alt="camera"></span></span>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <label> Assign Groups </label>
                                 <label class="sd">
                                    <select>
                                       <option> </option>
                                       <option> Assign Role </option>
                                       <option> Assign Role </option>
                                    </select>
                                    <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                                 </label>
                                 <div class="bootstrap-tagsinput">
                                    <span class="tag label label-info">U-18<span data-role="remove"><img src="{{ asset('theme/assets/images/tagcross.svg') }}" alt="camera"></span></span>
                                    <span class="tag label label-info">Senior<span data-role="remove"><img src="{{ asset('theme/assets/images/tagcross.svg') }}" alt="camera"></span></span>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12 text-end">
                                 <button type="submit" class="btn gry-btn"> Cancel </button>
                                 <button type="submit" class="btn drk-btn"> Save </button>
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
     $(document).on('click', '#delete_data', function(){
	var result = confirm('Do you want to perform this action?');
    if(!result){
    	return false;
    }
})
   //  $('#staticBackdrop').click(function(){
   //  var id=$(this).attr('data-id');
   //  alert(id);
   //  $.ajax({url:"Open-Offer.php?OfferID="+OfferID,cache:false,success:function(result){
   //      $(".md-content").html(result); //Here, Changes Done
   //  }});
   //  });
</script>
</body>

</html>