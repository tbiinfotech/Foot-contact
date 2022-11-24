@include('header')

@include('side-bar')
<div class="col sec_cont club-body">
   <form>

      <div class="row">
         <div class="head_top plr">
            <h1> Archive Coach </h1>
            <div class="row add_coach">
               <div class="col-lg-4">

               </div>


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
                     <th scope="col">Register</th>
                     <th scope="col">Last login</th>
                     <th scope="col">Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($data as $key=>$item)
                  <tr>
                     <td scope="row">{{ ($item->currentpage()-1) * 10 + $key + 1 }}</td>
                     <td>
                        @if($item->image)
                        <img src="{{ asset('/Uploads/'.$item->image) }}" width="50" height="50" />
                        @else
                        <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                        @endif
                     </td>
                     <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                     <td>{{ $item->playerGroupName($item->id) }} {{ $item->playerGroupCount($item->id) }}</td>
                     <td>{{ $item->created_at }}</td>
                     <td>{{ $item->updated_at }}</td>
                     <td>
                        <a href="{{ route('coach-view', ['id' => $item->id]) }}" type="button" data-id="{{$item->id}}">
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

                           @endif
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuEdit">
                           <li><a class="dropdown-item" href="{{ route('coach-archive', ['id' => $item->id]) }}">Not Archive </a></li>
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
                                          <img src="{{ asset('theme/assets/images/Camera.svg') }}" alt="camera">
                                          
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
   </form>
</div>
</div>
</div>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
</body>

</html>
<script>
   $(document).on('click', '#delete_data', function() {
      var result = confirm('Do you want to perform this action?');
      if (!result) {
         return false;
      }
   })
   $(document).ready(function() {
      $('#srch-player').change(function() {
         var option_id = $(this).val();
         window.location.href = "{{URL::to('/player-index')}}?search=" + option_id;

      });

      //group change
      $('.group-list').change(function() {
         var option_id = $(this).val();
         window.location.href = "{{URL::to('/player-index')}}?group=" + option_id;

      });
      //club change
      $('.club-list').change(function() {
         var option_id = $(this).val();
         window.location.href = "{{URL::to('/player-index')}}?club=" + option_id;

      });
   });
</script>