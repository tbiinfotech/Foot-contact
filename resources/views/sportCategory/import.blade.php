@include('header')

         @include('side-bar')
         <div class="col sec_cont">
            <div class="row">
               <div class="head_top">
                  <h1> Import Sport Category </h1>
                  <a class="btn back_btn" href="{{ url('/sport-category-index') }}" role="button"> Back </a>
               </div>
               <div class="sp_rd add_coach">
                  <form method="POST" enctype="multipart/form-data" action="{{ route('sport-category-import') }}">
                     
                     <div class="row">
                        <div class="col-md-12">
                           <label> File </label> 
                           <input type="file" name="image" id="image" required>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <label> Format of CSV </label> 
                           Title,Description
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 text-end">
                        <a href="{{ url('/sport-category-index') }}" class="btn gry-btn"> Cancel </a>
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