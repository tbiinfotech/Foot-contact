@include('header')

@include('side-bar')
<div class="col sec_cont">
    <div class="row">
        <div class="head_top">
            <h1> Edit Group </h1>
            <a class="btn back_btn" href="{{ url('/group-index') }}" role="button"> Back </a>
        </div>
        <div class="sp_rd add_coach">
            <form method="POST" enctype="multipart/form-data" action="{{ route('group-update',['id' => $id]) }}">
                <div class="row">
                    <div class="row">

                    </div>
                    <div class="col-md-12">
                        <h4>Group Image</h4>
                        <div class="user_img">
                            <img src="{{ asset('theme/assets/images/user.png') }}" alt="user">
                            <span>
                                <input type="file" id="image" name="image">
                              
                                @if(Auth::user()->role_id == "1")
                                 <img src="{{ asset('theme/assets/images/Camera-b.svg') }}" alt="camera">
                           @else
                           <img src="{{ asset('theme/assets/images/Camera.svg') }}" alt="camera">
                           @endif
                                Upload Photo</span>
                              
                        </div>
                        @foreach ($errors->all() as $error)
                                @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                                @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label> Group Name </label>
                        <input type="name" name="name" value="{{ $data->name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label> Teams </label>
                        <label class="sd">
                            <select name="team[]" multiple size="3" id="team" class="grid">
                                @foreach($teams as $team)
                                <option value={{ $team->id }}>{{ $team->team_name }}</option>
                                @endforeach
                            </select>
                            <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label> Coaches </label>
                        <label class="sd">
                            <select name="coach[]" multiple size="3" id="coach" class="grid">
                                @foreach($coaches as $coach)
                                <option value={{ $coach->id }}>{{ $coach->first_name }} {{ $coach->last_name }}</option>
                                @endforeach
                            </select>
                            <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label> Players </label>
                        <label class="sd">
                            <select name="player[]" multiple size="3" id="player" class="grid">
                                @foreach($players as $player)
                                <option value={{ $player->id }}>{{ $player->first_name }} {{ $player->last_name }}</option>
                                @endforeach
                            </select>
                            <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                        </label>

                    </div>
                    <div class="col-md-6">
                        <label>Description </label>
                        <textarea name="description" rows="5" cols="30"> {{ $data->description }}</textarea>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a href="{{ url('/group-index') }}" class="btn gry-btn"> Cancel </a>
                        <button type="submit" class="btn drk-btn"> Submit </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
</body>

</html>
