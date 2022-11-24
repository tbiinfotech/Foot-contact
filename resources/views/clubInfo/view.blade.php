@include('header')

@include('side-bar')
<div class="col sec_cont">
  <div class="head_top">
      <h1> Club Information </h1>
      <a class="btn back_btn" href="{{ url('/club-info-index') }}" role="button"> Back </a>
  </div>
  <div class="row mb-4 align-items-center">
	  <div class="col-lg-6">
		<div class="user_img">
		  @if($data->logo)
		  <img src="{{ asset('Uploads/'.$data->logo) }}" alt="image" width="100" height="100" />
		  @else
		  <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="100" height="100" />
		  @endif
		</div>
	  </div>
	  <div class="col-lg-6">
		<h1>Title </h1>
		{{ $data->name }}
	  </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>President </h1>
          <span>{{ $data->president }}</span>
        </label>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Official Id Number </h1>
          <span>{{ $data->official_id_number }}</span>
        </label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Main Address
          </h1>
          <span>{{ $data->main_address }}</span>
        </label>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>City </h1>
          <span>{{ $data->city }}</span>
        </label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Official Email

          </h1>
          <span>{{ $data->official_email }}</span>
        </label>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Contact Email
          </h1>
          <span>{{ $data->contact_email }}</span>
        </label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Website Url
          </h1>
          <span>{{ $data->website_url }}</span>
        </label>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Federation Page Link </h1>
          <span>{{ $data->federation_page_link }}</span>
        </label>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Facebook
          </h1>
          <span>{{ $data->facebook }}</span>
        </label>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Instagram </h1>
          <span>{{ $data->instagram }}</span>
        </label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1> Twitter
          </h1>
          <span>{{ $data->twitter }}</span>
        </label>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Premises Address
          </h1>
          <span>{{ $data->premises_address }}</span>
        </label>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="main_address">
        <label>
          <h1>Premises Field Type </h1>
          <span>{{ $data->premises_field_type }}</span>
        </label>
      </div>
    </div>
  </div>
 
</div>
</div>
</div>


<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
</body>

</html>