@include('header')

@include('side-bar')
<div class="col sec_cont">
   <form>
      <div class="row">
         <div class="head_top plr">
            <h1> Group Management </h1>
            <div class="row add_coach">
               <div class="col-lg-6">
                  <label class="searc-btn">
                     <input type="serach" placeholder="Search">
                     <img src="{{ asset('theme/assets/images/akar-icons_search.svg') }}" alt="search">
                  </label>
               </div>
               <div class="col-lg-6">
                  <div class="dropdown">
                     <a class="btn btn-secondary dropdown-toggle" href="{{ url('/group-export') }}" role="button">
                        Export
                     </a>
                     <a class="btn btn-secondary dropdown-toggle" href="{{ url('/group-add-form') }}" role="button">
                        + Add Group
                     </a>
                  </div> 
               </div>

            </div>
         </div>
         <div class="coach-m table-responsive">
            <table class="table">
               <thead>
                  <tr>
                     <th scope="col">Sr.</th>
                     <th>Image</th>
                     <th style="font-size:25px;" scope="col">Name</th>
                     <th scope="col">Players</th>
                     <th scope="col">Teams</th>
                     <th scope="col">Coach</th>
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
                     <td style="font-size:25px;">{{ $item->name }}</td>
                     <td>{{ $item->getCount($item->id,App\Models\Group::PLAYER) }}</td>
                     <td>{{ $item->getCount($item->id,App\Models\Group::TEAM) }}</td>
                     <td>{{ $item->getCount($item->id,App\Models\Group::COACH) }}</td>
                     <td>
                        <a href="{{ route('group-view', ['id' => $item->id]) }}" type="button" class="" data-id="{{$item->id}}" data-bs-target="#staticBackdrop">
                           <img src="{{ asset('theme/assets/images/edit.svg') }}" alt="edit">
                        </a>
                        <a href="#" role="button" id="dropdownMenuEdit" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ asset('theme/assets/images/3-dots.svg') }}" alt="dots">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuEdit">
                           <li><a class="dropdown-item" href="{{ route('group-edit', ['id' => $item->id]) }}">Edit
                              </a>
                           </li>
                           <li><a class="dropdown-item" href="{{ route('group-delete', ['id' => $item->id]) }}">Delete</a></li>
                        </ul>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $data->links('vendor.pagination.bootstrap-4') }}
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