@include('header')
@include('side-bar')
<div class="col sec_cont club-body">
   <div class="row">
      <div class="head_top">
         <h1> Club Management </h1>
         <div class="dropdown">
         <a class="btn drk-btn" href="{{ route('club-info-input') }}" role="button" >
                        Import 
                        </a>
            <a class="btn btn-secondary dropdown-toggle" href="{{ route('club-info-export') }}" role="button">
               Export
            </a>
            <a class="btn btn-secondary dropdown-toggle" href="{{ route('club-info-add') }}" role="button">
               + Add Club
            </a>
         </div>
      </div>
      <div class="coach-m table-responsive">
         <table class="table">
            <thead>
               <tr>
                  <th scope="col">Sr.</th>
                  <th scope="col">Logo</th>
                  <th scope="col">Club Name</th>
                  <th scope="col">President</th>
                  <th scope="col">Actions</th>
               </tr>
            </thead>
            <tbody> 
              
            @foreach($data as $key=>$item)
             
               <tr>
               <td scope="row">{{ ($item->currentpage()-1) * 10 + $key + 1 }}</td>
                  <td>
                  @if($item->logo)
                     <img src="{{ asset('Uploads/'.$item->logo) }}" alt="image" width="50" height="50" />
                  @else
                  <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                  @endif

                  </td>
                  <td>
                 
                  {{ $item->name }}</td>
                  <td>{{ $item->president }}</td>
                  <td>
                     
                     <a href="{{ route('club-info-view', ['id' => $item->id]) }}" type="button" class="" data-id="{{$item->id}}" data-bs-target="#staticBackdrop">
                     @if(Auth::user()->role_id == "1")
                           <img src="{{ asset('theme/assets/images/eye.svg') }}" alt="edit">
                           @else
                           <img src="{{ asset('theme/assets/images/edit.svg') }}" alt="edit">

                           @endif                        </a>
                           @if(Auth::user()->role_id == "1")
                        <a href="#" role="button" id="dropdownMenuEdit" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ asset('theme/assets/images/Edit-view.svg') }}" alt="dots">
                           @else
                           <a href="#" role="button" id="dropdownMenuEdit" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ asset('theme/assets/images/3-dots.svg') }}" alt="dots">

                           @endif                              </a>
                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuEdit">
                        <li><a class="dropdown-item" href="{{ route('club-info-edit', ['id' => $item->id]) }}">Edit
                           </a>
                        </li>
                        <li><a id="delete_data" class="dropdown-item" href="{{ route('club-info-delete', ['id' => $item->id]) }}">Delete</a></li>
                     </ul>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         {{ $data->links('vendor.pagination.bootstrap-4') }}
         <!-- Modal -->
      </div>
   </div>
</div>
</div>
</div>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
<script>
   
   // db.collection("cities").doc("SF")
   //  .onSnapshot((doc) => {
   //      console.log("Current data: ", doc.data());
   //  });
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
               $("#club_id").val(data.response.data.id);
               $("#first_name").val(data.response.data.first_name);
               $("#last_name").val(data.response.data.last_name);
               $("#phone").val(data.response.data.phone);
               $("#email").val(data.response.data.email);
               $('#staticBackdrop').modal('show');

            }
         }
      });
   });
   $('.view-profile').click(function() {

      var id = $("#club_id").val(); 
      var url = "{{ url('club-view?id=')}}";
   window.location=url+id;
   });
   $('.club-update').click(function() {
      var id = $("#club_id").val(); 
      var first_name = $("#first_name").val(); 
      var last_name = $("#last_name").val(); 
      $.ajax({
         url: "{{ url('update-club') }}",
         type: 'GET', 
         dataType: 'JSON',
         data: {id:id,first_name: first_name, last_name: last_name},
         success: function(data) {
            window.location="{{ url('club-index')}}";
         }
      });
   });
   $(document).on('click', '#delete_data', function(){
	var result = confirm('Do you want to perform this action?');
    if(!result){
    	return false;
    }
})
</script>
</body>

</html>