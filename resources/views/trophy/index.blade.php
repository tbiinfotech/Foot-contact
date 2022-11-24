@include('header')

@include('side-bar')
<div class="col sec_cont club-body">
    <form>
        <div class="row">
            <div class="head_top plr">
                <h1> Trophy Management </h1>
                <div class="row add_coach">
                    <div class="col-lg-6">
                        <label class="searc-btn">  
                        <input type="text" id="srch-trophy" value="{{$search}}" placeholder="Search Player name">
                            <img src="{{ asset('theme/assets/images/akar-icons_search.svg') }}" alt="search">
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="{{ url('/trophy-add') }}" role="button">
                                + Add Trophy
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="coach-m table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if($item->image)
                                <img src="{{ asset('/Uploads/'.$item->image) }}" width="50" height="50" />
                                @else
                                <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('trophy-view', ['id' => $item->id]) }}" type="button" class="" data-id="{{$item->id}}" data-bs-target="#staticBackdrop">
                                    <img src="{{ asset('theme/assets/images/edit.svg') }}" alt="edit">
                                </a>
                                <a href="#" role="button" id="dropdownMenuEdit" data-bs-toggle="dropdown" aria-expanded="false"> <img src="{{ asset('theme/assets/images/3-dots.svg') }}" alt="dots">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuEdit">
                                    <li><a class="dropdown-item" href="{{ route('trophy-edit', ['id' => $item->id]) }}">Edit
                                        </a>
                                    </li>
                                    <li><a id="delete_data" class="dropdown-item" href="{{ route('trophy-delete', ['id' => $item->id]) }}">Delete</a></li>
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
<script>
    $(document).on('click', '#delete_data', function() {
        var result = confirm('Do you want to perform this action?');
        if (!result) {
            return false;
        }
    })
    $(document).ready(function() {
      $('#srch-trophy').change(function() {
         var option_id = $(this).val();
         window.location.href = "{{URL::to('/player-index')}}?search=" + option_id;

      });
   });
</script>