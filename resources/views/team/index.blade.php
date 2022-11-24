@include('header')
         @include('side-bar')
            <div class="col sec_cont club-body">
               <div class="row">
                  <div class="head_top">
                     <h1> Teams </h1>
                     <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="{{ route('team-add') }}" role="button" >
                        + Add Team
                        </a>
                     </div>
                  </div>
                  <div class="sport-m table-responsive">
                     <table class="table">
                        <thead>
                           <tr> 
                              <th scope="col">Sr.</th>
                              <th scope="col">Team Name</th>
                              <th scope="col">Category</th>
                              <th scope="col">Team Rank</th>
                              <th scope="col">Year Limit</th>
                              <th scope="col">Season</th>
                              <th scope="col">Championship</th>
                              <th scope="col">Actions</th>
                           </tr>
                        </thead>
                        <tbody> 
                        @foreach($data as $key=>$item)
                           <tr>
                           <td scope="row">{{ ($item->currentpage()-1) * 10 + $key + 1 }}</td>
                              <td>{{ $item->team_name }} </td>
                              <td>{{ $item->category }} </td>
                              <td>{{ $item->team_rank }} </td>
                              <td>{{ $item->year_limit }} </td>
                              <td>{{ $item->season }} </td>
                              <td>{{ $item->championship }} </td>
                              <td>
                              <a href="{{ route('team-view', ['id' => $item->id]) }}" type="button" class="" data-id="{{$item->id}}" data-bs-target="#staticBackdrop">
                           <img src="{{ asset('theme/assets/images/edit.svg') }}" alt="edit">
                        </a>
                                 <a href="#" role="button" id="dropdownMenuEdit" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ asset('theme/assets/images/3-dots.svg') }}" alt="dots">
                              </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuEdit">
                           <li><a class="dropdown-item" href="{{ route('team-edit', ['id' => $item->id]) }}">Edit
                              </a>
                           </li>
                           <li><a id="delete_data" class="dropdown-item" href="{{ route('team-delete', ['id' => $item->id]) }}">Delete</a></li>
                        </ul>
                              </a>
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
   </body>
</html>
<script>
   $(document).on('click', '#delete_data', function(){
	var result = confirm('Do you want to perform this action?');
    if(!result){
    	return false;
    }
})
   </script>
 