@include('header')
         @include('side-bar')
         <div class="col sec_cont">
            <div class="row">
               <div class="head_top">
                  <h1> Select Player </h1>
                  <a class="btn back_btn" href="#" role="button"> Back </a>
               </div>
               <div class="head-pl">
                  <h2>Select Players (11/80)</h2>
                   <div> All <label class="tair">
                  <input type="checkbox">
                  <span class="mak"></span>
                  </label> </div>
               </div>
               <div class="sp_rd sel_plr">
                  <ul>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/1.png') }}" alt="one"> Sofiane	Benamar </div>
                        <label class="tair">
                        <input type="checkbox">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li> <label><img src="{{ asset('theme/assets/images/2.png') }}" alt="two">Ethan	Cano</label>
                        <label class="tair">
                        <input type="checkbox">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/3.png') }}" alt="three">Rayan	Jouani</div>
                        <label class="tair">
                        <input type="checkbox" checked="checked">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/4.png') }}" alt="four">Raphaël	De Abreu</div>
                        <label class="tair">
                        <input type="checkbox" checked="checked">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/1.png') }}" alt="five">Mathis	Beauregard
                        </div>
                        <label class="tair">
                        <input type="checkbox">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/2.png') }}" alt="six">Léo	Penais</div>
                        <label class="tair">
                        <input type="checkbox">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/3.png') }}" alt="seven">Junior	Ndolo</div>
                        <label class="tair">
                        <input type="checkbox" checked="checked">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div> <img src="{{ asset('theme/assets/images/1.png') }}" alt="one">Sofiane	Benamar </div>
                        <label class="tair">
                        <input type="checkbox">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/2.png') }}" alt="two">Ethan	Cano</div>
                        <label class="tair">
                        <input type="checkbox" checked="checked">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/3.png') }}" alt="three">Rayan	Jouani</div>
                        <label class="tair">
                        <input type="checkbox" checked="checked">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/4.png') }}" alt="four">Raphaël	De Abreu</div>
                        <label class="tair">
                        <input type="checkbox" checked="checked">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/1.png') }}" alt="five">Mathis	Beauregard</div>
                        <label class="tair">
                        <input type="checkbox" checked="checked">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/2.png') }}" alt="six">Léo	Penais</div>
                        <label class="tair">
                        <input type="checkbox">
                        <span class="mak"></span>
                        </label>
                     </li>
                     <li>
                        <div><img src="{{ asset('theme/assets/images/3.png') }}" alt="seven">Junior	Ndolo</div>
                        <label class="tair">
                        <input type="checkbox" checked="checked">
                        <span class="mak"></span>
                        </label>
                     </li>
                  </ul>
				  
				  
				  <div class="text-end mt-4">
				   <button type="submit" name="" class="btn drk-btn"> Preview </button>
				  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
   </body>
</html>