@extends('layouts.frontend')
@section('content')

    <section class="designer_cont project_main mb-5 tittle_no_banner">
        <h4 class="purple">Explore</h4>
        <div class="container">
      <div class="row">			
	  <div class="col-sm-6">
		<span class="gallery_block1"><img src="public/img/gallery1.jpg">	</span>	 
     </div>	
     
	 <div class="col-sm-3">
	 <span class="gallery_block"><img src="public/img/gallery2.jpg"></span>	
	 <span class="gallery_block"><img src="public/img/gallery3.jpg"></span>
	 </div>
	  <div class="col-sm-3">
	 <span class="gallery_block"><img src="public/img/gallery4.jpg"></span>	
	  <span class="gallery_block"><img src="public/img/gallery5.jpg"></span>	
	 </div>
	 
	</div>
        </div>
        @extends('layouts.modal')
    </section>

    
@endsection
