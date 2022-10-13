@extends('layouts.frontend')
@section('content')

<section class="banner_inner">
<div class="bannerParallax_inner"></div>
</section>
<section class="designer_cont project_main">
<button class="create_button btn btn-secondary brown_btn mt-5 mb-3 mx-auto d-block pl-5 pr-5 pt-3 pb-3" data-toggle="modal" data-target="#myModal">Create New Project</button>
	<h4>Recent Project </h4>
	<div class="container">
	<div class="row">
	<div class="tabs_cont">
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
	<li class="nav-item" role="presentation"><a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all"  role="tab" aria-controls="pills-all" aria-selected="true">All</a></li>
	<li class="nav-item" role="presentation"><a class="nav-link" id="pills-living-tab" data-toggle="pill" href="#pills-living" role="tab" aria-controls="pills-living" aria-selected="false">Under Progress</a></li>
	<li class="nav-item" role="presentation"><a class="nav-link" id="pills-kitchen-tab" data-toggle="pill" href="#pills-kitchen" role="tab" aria-controls="pills-kitchen" aria-selected="false">Completed </a></li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
	    <div class="tab-pane fade show active" id="pills-all" role="tabpanel"  aria-labelledby="pills-all-tab">
	        <ul class="project_listing">
    @if(count($projects)>0)
    @foreach($projects as $project)
	  <li>
      <div class="project_details">
       <h4>{{$project->title}}</h4>
       <span>{{$project->first_name}}</span>  
      </div>
      @if($project->room_picture)
      <?php
      $x = explode (",", $project->room_picture);
      ?>
      <div class="proj_img"><img src="{{asset("public/uploads/{$x[0]}")}}" alt=""></div>
      @endif
      <a class="view_project">View Project</a>
      </li>
      @endforeach
      @endif
     <!--
       <li>
      <div class="project_details">
       <h4>Project Tittle</h4>
       <span>Designer Name</span>  
      </div>
      <div class="proj_img"><img src="http://learning.neuronsit.in/style-home/public/img/home8.jpg" alt=""></div>
      <a class="view_project">View Project</a>
      </li>
      
        <li>
      <div class="project_details">
       <h4>Project Tittle</h4>
       <span>Designer Name</span>  
      </div>
      <div class="proj_img"><img src="http://learning.neuronsit.in/style-home/public/img/home8.jpg" alt=""></div>
      <a class="view_project">View Project</a>
      </li>
      
        <li>
      <div class="project_details">
       <h4>Project Tittle</h4>
       <span>Designer Name</span>  
      </div>
      <div class="proj_img"><img src="http://learning.neuronsit.in/style-home/public/img/home8.jpg" alt=""></div>
      <a class="view_project">View Project</a>
      </li>
      
        <li>
      <div class="project_details">
       <h4>Project Tittle</h4>
       <span>Designer Name</span>  
      </div>
      <div class="proj_img"><img src="http://learning.neuronsit.in/style-home/public/img/home8.jpg" alt=""></div>
      <a class="view_project">View Project</a>
      </li>-->
 </ul>
                       
</div>                        

<div class="tab-pane fade" id="pills-living" role="tabpanel" aria-labelledby="pills-living-tab">                            
 <ul class="project_listing">
@if(count($projects)>0)
    @foreach($projects as $project)
	  <li>
      <div class="project_details">
       <h4>{{$project->title}}</h4>
       <span>{{$project->first_name}}</span>  
      </div>
      @if($project->room_picture)
      <?php
      $x = explode (",", $project->room_picture);
      ?>
      <div class="proj_img"><img src="{{asset("public/uploads/{$x[0]}")}}" alt=""></div>
      @endif
      <a class="view_project">View Project</a>
      </li>
      @endforeach
      @endif
 <!--
   <li>
  <div class="project_details">
   <h4>Project Tittle</h4>
   <span>Designer Name</span>  
  </div>
  <div class="proj_img"><img src="http://learning.neuronsit.in/style-home/public/img/home8.jpg" alt=""></div>
  <a class="view_project">View Project</a>
  </li>
  
    <li>
  <div class="project_details">
   <h4>Project Tittle</h4>
   <span>Designer Name</span>  
  </div>
  <div class="proj_img"><img src="http://learning.neuronsit.in/style-home/public/img/home8.jpg" alt=""></div>
  <a class="view_project">View Project</a>
  </li>-->


 </ul>
                                 
</div>                        

<div class="tab-pane fade" id="pills-kitchen" role="tabpanel"                            aria-labelledby="pills-kitchen-tab">                           
  <ul class="project_listing">
  @if(count($complete_projects)>0)
    @foreach($complete_projects as $complete_project)
	  <li>
      <div class="project_details">
       <h4>{{$complete_project->title}}</h4>
       <span>{{$complete_project->first_name}}</span>  
      </div>
      @if($complete_project->room_picture)
      <?php
      $x = explode (",", $complete_project->room_picture);
      ?>
      <div class="proj_img"><img src="{{asset("public/uploads/{$x[0]}")}}" alt=""></div>
      @endif
      <a class="view_project">View Project</a>
      </li>
      @endforeach
      @endif
 <!--
   <li>
  <div class="project_details">
   <h4>Project Tittle</h4>
   <span>Designer Name</span>  
  </div>
  <div class="proj_img"><img src="http://learning.neuronsit.in/style-home/public/img/home8.jpg" alt=""></div>
  <a class="view_project">View Project</a>
  </li>
  
    <li>
  <div class="project_details">
   <h4>Project Tittle</h4>
   <span>Designer Name</span>  
  </div>
  <div class="proj_img"><img src="http://learning.neuronsit.in/style-home/public/img/home8.jpg" alt=""></div>
  <a class="view_project">View Project</a>
  </li>-->


 </ul>     
 </div>                        
 </div> 
 
       

     <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog interior_box">
    
      <!-- Modal content-->
      <div class="modal-content">
	  <div class="card calulator-card first visible">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> What's your interior design style?</h4>
        </div>
        <div class="modal-body">
          <div class="interior_img">		  
		  <img src="{{Request::root()}}/public/img/interior_banner.jpg">
		  </div>
		  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
		  <button class="next1 bt_score">Take the Quiz</button>
        </div>
		
        </div>
		
		
		 <div class="card calulator-card first">
		   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">What is your preferred bedroom style?</h4>
        </div>
		
		<div class="modal-body">
		<form action="{{route('frontend.preferred.bedroom')}}"  method="post" id="preferred_bedroom_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
			  <li>
			    <label class="checkcontainer">
					<input name="preferred_bedroom" type="radio" value="1" class="colorinput-input" required>
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/bedroom1.jpg" alt=""></div>
						<span class="bg-azure">Minimalist with a few eye-catching accents!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
		  <li>
			    <label class="checkcontainer">
					<input name="preferred_bedroom" type="radio" value="2" class="colorinput-input" required>
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/bedroom2.jpg" alt=""></div>
						<span class="bg-azure">Minimalist with a few eye-catching accents!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
		  <li>
			    <label class="checkcontainer">
					<input name="preferred_bedroom" type="radio" value="3" class="colorinput-input" required>
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/bedroom3.jpg" alt=""></div>
						<span class="bg-azure">Minimalist with a few eye-catching accents!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			
			     <li>
			    <label class="checkcontainer">
					<input name="preferred_bedroom" type="radio" value="4" class="colorinput-input" required>
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/bedroom4.jpg" alt=""></div>
						<span class="bg-azure">Minimalist with a few eye-catching accents!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			     <li>
			    <label class="checkcontainer">
					<input name="preferred_bedroom" type="radio" value="5" class="colorinput-input" required>
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/bedroom5.jpg" alt=""></div>
						<span class="bg-azure">Minimalist with a few eye-catching accents!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			     <li>
			    <label class="checkcontainer">
					<input name="preferred_bedroom" type="radio" value="6" class="colorinput-input" required>
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/bedroom6.jpg" alt=""></div>
						<span class="bg-azure">Minimalist with a few eye-catching accents!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			 			   
			
			</ul>
			<span class="text-danger" role="alert" id="err_preferred_bedroom"></span>
		  </div>
		  
            <button type="submit" class="next bt_score1">Next</button>
			</form>
			<button class="pre bt_score1">Previous</button>
			
		</div>
		
		
		 </div>
		
		
		<div class="card calulator-card first">
		<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Which dining room lights you up?</h4>
        </div>
		
		<div class="modal-body">
		<form action="{{route('frontend.diningroom')}}"  method="post" id="diningroom_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
			  <li>
			    <label class="checkcontainer">
					<input name="diningroom" type="radio" value="1" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/light1.jpg" alt=""></div>
						<span class="bg-azure">Artisan hanging lights and a rustic centrepiece</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
		  <li>
			    <label class="checkcontainer">
					<input name="diningroom" type="radio" value="2" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/light2.jpg" alt=""></div>
						<span class="bg-azure">Lots of light, uplifting colours and a statement art piece!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
		  <li>
			    <label class="checkcontainer">
					<input name="diningroom" type="radio" value="3" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/light3.jpg" alt=""></div>
						<span class="bg-azure">Sleek and spacious...</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			
			   
			 <li>
			    <label class="checkcontainer">
					<input name="diningroom" type="radio" value="4" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/light4.jpg" alt=""></div>
						<span class="bg-azure">A sophisticated design with contemporary pieces.</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
		  <li>
			    <label class="checkcontainer">
					<input name="diningroom" type="radio" value="5" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/light5.jpg" alt=""></div>
						<span class="bg-azure">A more traditional family homey dining area</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
				<li>
			    <label class="checkcontainer">
					<input name="diningroom" type="radio" value="6" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/light6.jpg" alt=""></div>
						<span class="bg-azure">Luxurious and decadent</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
				</li>

			</ul>
		  <span class="text-danger" role="alert" id="err_diningroom"></span>
		  </div>
		
		  
            <button class="next bt_score1">Next</button>
			</form>
			<button class="pre bt_score1">Previous</button>
		</div>
		
		
		 </div>
		
		
			 <div class="card calulator-card first">
		   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pick some accents for your coffee table...</h4>
        </div>
		<div class="modal-body">
		<form action="{{route('frontend.coffee.table')}}"  method="post" id="coffee_table_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
			  <li>
			    <label class="checkcontainer">
					<input name="coffee_table" type="radio" value="1" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/coffee_table.jpg" alt=""></div>
						<span class="bg-azure">A retro trey, up-cycled candle holder, and coffee table books.</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
		  <li>
			    <label class="checkcontainer">
					<input name="coffee_table" type="radio" value="2" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/coffee_table1.jpg" alt=""></div>
						<span class="bg-azure">A bouquet, a couple magazines, and my coffee... Obviously.</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
		  <li>
			    <label class="checkcontainer">
					<input name="coffee_table" type="radio" value="3" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/coffee_table2.jpg" alt=""></div>
						<span class="bg-azure">Plants, plants, and more plants!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			
			   
			 <li>
			    <label class="checkcontainer">
					<input name="coffee_table" type="radio" value="4" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/coffee_table3.jpg" alt=""></div>
						<span class="bg-azure">A bowl for my keys and my favorite books</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
		  <li>
			    <label class="checkcontainer">
					<input name="coffee_table" type="radio" value="5" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/coffee_table4.jpg" alt=""></div>
						<span class="bg-azure">A unique vase or statue</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
		  <li>
			    <label class="checkcontainer">
					<input name="coffee_table" type="radio" value="6" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/coffee_table5.jpg" alt=""></div>
						<span class="bg-azure">A glam table lamp</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			
				  <li>
			    <label class="checkcontainer">
					<input name="coffee_table" type="radio" value="7" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/coffee_table6.jpg" alt=""></div>
						<span class="bg-azure">Chess set </span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
			   		  <li>
			    <label class="checkcontainer">
					<input name="coffee_table" type="radio" value="8" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/coffee_table7.jpg" alt=""></div>
						<span class="bg-azure">Picture Frames</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			 			   
			
			</ul>
			<span class="text-danger" role="alert" id="err_coffee_table"></span>
		  </div>
		
		  
            <button class="next bt_score1">Next</button>
		</form>
		<button class="pre bt_score1">Previous</button>
		</div>
		
		 </div>
		
		 <div class="card calulator-card first">
		   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">How do you want your home to feel?</h4>
        </div>
		<div class="modal-body">
		<form action="{{route('frontend.home.feel')}}"  method="post" id="home_feel_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
			  <li>
			    <label class="checkcontainer">
					<input name="home_feel" type="radio" value="1" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/home1.jpg" alt=""></div>
						<span class="bg-azure">Luxurious... I'm talking faux fur pillows and gold hardware!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
		  <li>
			    <label class="checkcontainer">
					<input name="home_feel" type="radio" value="2" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/home2.jpg" alt=""></div>
						<span class="bg-azure">Streamlined with few main decor pieces. No clutter for me!</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
		  <li>
			    <label class="checkcontainer">
					<input name="home_feel" type="radio" value="3" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/home3.jpg" alt=""></div>
						<span class="bg-azure">Exciting. I want visitors to feel like my décor has a story... </span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			
			   
			 <li>
			    <label class="checkcontainer">
					<input name="home_feel" type="radio" value="4" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/home4.jpg" alt=""></div>
						<span class="bg-azure">A mix of contemporary and retro pieces to keep things interesting.</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
		  <li>
			    <label class="checkcontainer">
					<input name="home_feel" type="radio" value="5" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/home5.jpg" alt=""></div>
						<span class="bg-azure">A traditional home with modern elements</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
		  <li>
			    <label class="checkcontainer">
					<input name="home_feel" type="radio" value="6" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/home6.jpg" alt=""></div>
						<span class="bg-azure">Natural and light </span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			
		  <li>
			    <label class="checkcontainer">
					<input name="home_feel" type="radio" value="7" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/home7.jpg" alt=""></div>
						<span class="bg-azure">Cozy, homey and stylish</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			     <li>
			    <label class="checkcontainer">
					<input name="home_feel" type="radio" value="8" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/home8.jpg" alt=""></div>
						<span class="bg-azure">Functional, simple and cool with darker tones</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			 			   
			
			</ul>
			<span class="text-danger" role="alert" id="err_home_feel"></span>
		  </div>
		
		  
            <button class="next bt_score1">Next</button>
		</form>
		<button class="pre bt_score1">Previous</button>
		</div>
		
		 </div>
		
		 <div class="card calulator-card first">
		   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Which areas in your home needs a bit of work?</h4>
        </div>
		<div class="modal-body">
		<form action="{{route('frontend.home.area')}}"  method="post" id="home_area_form" novalidate="novalidate">
		@csrf
		  <div class="style_list">
		    <ul>
			  <li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="1" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/dining_room.jpg" alt=""></div>
						<span class="bg-azure">Dining Area</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
		  <li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="2" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/room1.jpg" alt=""></div>
						<span class="bg-azure">TV Room/ Living Room</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
		  <li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="3" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/bedroom.jpg" alt=""></div>
						<span class="bg-azure">Bedroom</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			
			   
			 <li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="4" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/office.jpg" alt=""></div>
						<span class="bg-azure">Office</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
		  <li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="5" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/Balcony.jpg" alt=""></div>
						<span class="bg-azure">Balcony</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
		  <li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="6" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/garden.jpg" alt=""></div>
						<span class="bg-azure">Garden/ Terrace</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			
		<li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="7" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="http://learning.neuronsit.in/style-home/public/img/Entryway.jpg" alt=""></div>
						<span class="bg-azure">Entryway</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			   
			   <li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="8" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box"><img src="https://media3.giphy.com/media/dCdPMRDW3rJ8OeJIDd/giphy.gif?cid=646febc5fx4ma4zttaz15h89z27v8tx576ylkao0ooo0yymc&rid=giphy.gif&ct=g" alt=""></div>
						<span class="bg-azure">Other</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			   
			      <li>
			    <label class="checkcontainer">
					<input name="home_area" type="radio" value="9" class="colorinput-input" >
					<div class="style_box colorinput-color ">
					<div class="img_box">
					<img src="https://media4.giphy.com/media/118p3q768COZhu/giphy.gif?cid=646febc5hmbo20b1jddtk3ww01ax1jgf0xt31ba0js3j30nr&rid=giphy.gif&ct=g" alt=""></div>
						<span class="bg-azure">Not sure yet</span>
						
						</div>
						<span class="checkmark"></span>
				</label>
			   </li>
			 			   
			
			</ul>
			<span class="text-danger" role="alert" id="err_home_area"></span>
		  </div>
		
		  
            <button class="next bt_score1">Next</button>
		</form>
		<button class="pre bt_score1">Previous</button>
		</div>
		
		 </div>
		
		<div class="card calulator-card first">        
		<div class="modal-header">          
		<button type="button" class="close" data-dismiss="modal">×</button>          
		<h4 class="modal-title"> What's your interior design style?</h4>
		</div>        
		<div class="modal-body">         
		<div class="interior_img">		  		  
		<img src="http://learning.neuronsit.in/style-home/public/img/inerior_banner1.jpg">		  
		</div>		  
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>		  
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>	
		
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>	
		
		<div class="style_social_link">
		 <h3>Share Your Results</h3>
		  <span><a href="#"><i class="fab fa-facebook"></i></a></span>
		  <span><a href="#"><i class="fab fa-twitter"></i></a></span>
		</div>
		<form action="{{route('frontend.start.project')}}"  method="post" id="start_project_form" novalidate="novalidate">
		@csrf
		<button type="submit" class="start_project">Are you ready to find a designer and start this project?</a>
		</form>
		</div>		        
		</div>
		
		
      </div>
      
    </div>
  </div>




 </section>    
 
 
 
 
 <div class="flashBannerCont">        <div class="container">            <div class="row">                <div class="flashBanner">                    <h2>                        Learn more about our Design packages                    </h2>                    <button class="btn btn-secondary brown_btn pl-5 pr-5">Read more</button>                </div>            </div>        </div>    </div>	
 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
	
(function($) {
    $("#preferred_bedroom_form").submit(function(e){
		e.preventDefault();
		
		//$("#btn").text('Please wait...');
		//$("#btn").prop('disabled', true);
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#preferred_bedroom_form").serialize(),
			  success: function(response){
				//$("#btn").text('Submit');
				//$("#btn").prop('disabled', false);
				 if(response.status=='NOK')
				 {
					$("#err_preferred_bedroom").html(response.errors.preferred_bedroom?response.errors.preferred_bedroom:'');
					
					return;
				 }
				 else if(response.status=='OK'){
					 $("#err_preferred_bedroom").html('');
					 //Show previous button
						$('.pre').show();

						//Find the element that's currently showing
						$showing = $('.first.visible').first();

						//Find the next element
						$next = $showing.next();

						//Change which div is showing
						$showing.removeClass("visible").hide();
						$next.addClass("visible").show();

						//If there's no more elements, hide the NEXT button
						if (!$next.next().length) {
							$(this).hide();
						}
				 }
			  }
			});
		 
	});
  })(jQuery);
</script>

<script>
(function($) {
    $("#diningroom_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#diningroom_form").serialize(),
			  success: function(response){
				 if(response.status=='NOK')
				 {
					$("#err_diningroom").html(response.errors.diningroom?response.errors.diningroom:'');
					return;
				 }
				 else if(response.status=='OK'){
					$("#err_diningroom").html('');
					//Show previous button
					$('.pre').show();
					//Find the element that's currently showing
					$showing = $('.first.visible').first();
					//Find the next element
					$next = $showing.next();
					//Change which div is showing
					$showing.removeClass("visible").hide();
					$next.addClass("visible").show();
					//If there's no more elements, hide the NEXT button
					if (!$next.next().length) {
						$(this).hide();
					}
				 }
				 
			  }
			});
		 
	});
  })(jQuery);
</script>

<script>
(function($) {
    $("#coffee_table_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#coffee_table_form").serialize(),
			  success: function(response){
				 if(response.status=='NOK')
				 {
					$("#err_coffee_table").html(response.errors.coffee_table?response.errors.coffee_table:'');
					return;
				 }
				 else if(response.status=='OK'){
					$("#err_coffee_table").html('');
					//Show previous button
					$('.pre').show();
					//Find the element that's currently showing
					$showing = $('.first.visible').first();
					//Find the next element
					$next = $showing.next();
					//Change which div is showing
					$showing.removeClass("visible").hide();
					$next.addClass("visible").show();
					//If there's no more elements, hide the NEXT button
					if (!$next.next().length) {
						$(this).hide();
					}
				 }
				 
			  }
			});
		 
	});
  })(jQuery);
</script>
 
 <script>
(function($) {
    $("#home_feel_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#home_feel_form").serialize(),
			  success: function(response){
				 if(response.status=='NOK')
				 {
					$("#err_home_feel").html(response.errors.home_feel?response.errors.home_feel:'');
					return;
				 }
				 else if(response.status=='OK'){
					$("#err_home_feel").html('');
					//Show previous button
					$('.pre').show();
					//Find the element that's currently showing
					$showing = $('.first.visible').first();
					//Find the next element
					$next = $showing.next();
					//Change which div is showing
					$showing.removeClass("visible").hide();
					$next.addClass("visible").show();
					//If there's no more elements, hide the NEXT button
					if (!$next.next().length) {
						$(this).hide();
					}
				 }
				 
			  }
			});
		 
	});
  })(jQuery);
</script>

<script>
(function($) {
    $("#home_area_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#home_area_form").serialize(),
			  success: function(response){
				 if(response.status=='NOK')
				 {
					$("#err_home_area").html(response.errors.home_area?response.errors.home_area:'');
					return;
				 }
				 else if(response.status=='OK'){
					$("#err_home_area").html('');
					//Show previous button
					$('.pre').show();
					//Find the element that's currently showing
					$showing = $('.first.visible').first();
					//Find the next element
					$next = $showing.next();
					//Change which div is showing
					$showing.removeClass("visible").hide();
					$next.addClass("visible").show();
					//If there's no more elements, hide the NEXT button
					if (!$next.next().length) {
						$(this).hide();
					}
				 }
				 
			  }
			});
		 
	});
  })(jQuery);
</script>
<script>
(function($) {
    $("#start_project_form").submit(function(e){
		e.preventDefault();
		var url=$(this).attr("action");
		$.ajax({
			  url: url,
			  type:"post",
			  data:$("#start_project_form").serialize(),
			  success: function(response){
				 if(response.status=='OK')
				 {
					window.location = response.url;
				 }
			  }
			});
		 
	});
  })(jQuery);
</script>

 @endsection