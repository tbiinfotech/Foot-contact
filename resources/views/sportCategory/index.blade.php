@include('header')
@include('side-bar')
<div class="col sec_cont club-body">
   <div class="row">
      <div class="head_top">
         <h1> Sport Category </h1>
         <div class="dropdown">
            <a class="btn drk-btn" href="{{ route('sport-category-input') }}" role="button">
               Import
            </a>
            <a class="btn drk-btn" href="{{ route('sport-category-export') }}" role="button">
               Export
            </a>
            <a class="btn drk-btn" href="{{ route('sport-category-add') }}" role="button">
               + Add Sport Category
            </a>
         </div>
      </div>
      <div class="sport-m table-responsive">
         <table class="table">
            <thead>
               <tr>
                  <th scope="col">Sr.</th>
                  <th scope="col">Image</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Status</th> 
                  <th scope="col">Actions</th>
               </tr>
            </thead>
            <tbody>
               @foreach($data as $key=>$item)
               <tr>
                  <td scope="row">{{$key+1 }}</td>
                  <td> @if($item->image)
                     <img src="{{ asset('Uploads/'.$item->image) }}" width="50" height="50" />
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                     @endif
                  </td>
                  <td>{{ $item->title }} </td>
                  <!-- <td>{{substr($item->description, 0, 80) }}</td> -->
                  <td>{{substr($item->description, 0, 260) }}</td>
                  @if($item->status == 0)
                  <td>Archive </td>
                  @else
                  <td>Not Archive </td>
                  @endif
                  <td>
                     <a href="{{ route('sport-category-view', ['id' => $item->id]) }}" type="button">
                        <img src="{{ asset('theme/assets/images/edit.svg') }}" alt="edit">
                     </a>
                     <a href="#" role="button" id="dropdownMenuEdit" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ asset('theme/assets/images/3-dots.svg') }}" alt="dots">
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuEdit">
                        <li><a class="dropdown-item" href="{{ route('sport-category-edit', ['id' => $item->id]) }}">Edit
                           </a>
                        </li>
                        @if($item->status == 0)
                        <li><a class="dropdown-item" href="{{ route('sport-category-notdelete', ['id' => $item->id]) }}">Not Archive </a></li>
                        @else 
                        <li><a class="dropdown-item" href="{{ route('sport-category-delete', ['id' => $item->id]) }}">Archive </a></li>
                        @endif
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