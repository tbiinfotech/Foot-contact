@include('header')

@include('side-bar')
<style>
  .sec_cont h1 {
    font-size: 20px;
    font-family: 'Outfit-Bold';
    margin-bottom: -10px;
    margin-top: 18px;

}
  </style>
<div class="col sec_cont">
  <div class="row">
    <div class="head_top">
      <h1> View Category </h1>
      <a class="btn back_btn" href="{{ url('/sport-category-index') }}" role="button"> Back </a>
    </div>
    <div class="row">
      <div class="col-lg-4">

        <div class="user_img">
          @if($data->image)
          <img src="{{ asset('Uploads/'.$data->image) }}" width="100" height="100" />
          @else
          <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="100" height="100" />
          @endif
        </div></div>
        <div class="col-lg-8">
          <h1>Title </h1><br>
          {{ $data->title }}
        </div>
      </div></div>
      <div class="row">
      <div class="col-lg-12">
          <div class="">
            <label>
            <h1>Description </h1><br>
              <span>{{ $data->description }}</span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <!-- <table>
        <tr>
        <div class="row"> 
                     <div class="col-lg-6">
          <th>Image</th>
          <div class="col-lg-6">
          <th>Title</th>
                     </div></div></div>
                     <div class="row"> 
                     <div class="col-lg-12">
          <th>Description</th>
                     </div>
        </tr>
        <tr>
          <td>{{$data->title}}</td>
          <td>{{$data->description}}</td>
        </tr>
      </table> -->
  </div>
</div>
</div>
</div>


<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
</body>

</html>