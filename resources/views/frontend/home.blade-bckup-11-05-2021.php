@extends('layouts.frontend')
@section('content')
<section class="banner">
 <img src="{{Request::root()}}/public/images/banner.jpg">
        <div class="banner_content">
            <div class="container">
                <div class="row">
                    <div class="content">
                        <h1>I need to furnish my new house on a realistic budget.</h1>
                        <?php
						$user=auth()->user();
						if(!empty($user) ){
						if($user->role_id==2){
						?>
                        <button class="btn btn-secondary brown_btn" type="button" data-toggle="modal" data-target="#myModal">
                            Find Your Style
                        </button>
						<?php
						}
						else{
						?>
						<a class="btn btn-secondary brown_btn" type="button" href="{{route('frontend.login')}}">
                            Find Your Style
                        </a>
						<?php
						}
						}
						else{
						?>
						<a class="btn btn-secondary brown_btn" type="button" href="{{route('frontend.login')}}">
                            Find Your Style
                        </a>
						<?php
						}
						?>


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



                    </div>
                </div>
            </div>
        </div>
    </section>






    <section class="whatWeDo">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 cont_left">
                    <h5>What we do</h5>
                    <h4>Style - A - Home</h4>
                    <h4>Interior <span>Services</span></h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s,
                    </p>
                    <button class="btn btn-secondary brown_btn">View Service <i
                            class="fas fa-long-arrow-alt-right"></i></button>
                </div>
                <div class="cont-right col-lg-9">
                    <ul>
                        <li>
                            <img src="{{Request::root()}}/public/images/whatWeDo1.jpg" alt="style-A-home">
                            <div class="heading">
                                Living Room
                            </div>
                        </li>
                        <li>
                            <img src="{{Request::root()}}/public/images/whatWeDo2.jpg" alt="style-A-home">
                            <div class="heading">
                                Dining Rooms
                            </div>
                        </li>
                        <li>
                            <img src="{{Request::root()}}/public/images/whatWeDo3.jpg" alt="style-A-home">
                            <div class="heading">
                                Bedrooms
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="simplerTalks">
        <div class="simpler_banner">
            <div class="container">
                <div class="row">
                    <h2>Even Simpler Than You Think</h2>
                    <ul>
                        <li>
                            <div class="talks_cont">
                                <img src="{{Request::root()}}/public/images/simpler_icon1.png" alt="style-A-home">
                            </div>
                            <div class="content_talks">
                                <h1>1.</h1>
                                <label>Tell us what you need</label>
                            </div>
                            <p>
                                Pick a room, set your budget and tell us about your Pinterest worthy dreams – whether a
                                full
                                overhaul, or just some ideas to pull it together.
                            </p>
                        </li>
                        <li>
                            <div class="talks_cont">
                                <img src="{{Request::root()}}/public/images/simpler_icon2.png" alt="style-A-home">
                            </div>
                            <div class="content_talks">
                                <h1>2.</h1>
                                <label>Tell us what you need</label>
                            </div>
                            <p>
                                Pick a room, set your budget and tell us about your Pinterest worthy dreams – whether a
                                full
                                overhaul, or just some ideas to pull it together.
                            </p>
                        </li>
                        <li>
                            <div class="talks_cont">
                                <img src="{{Request::root()}}/public/images/simpler_icon3.png" alt="style-A-home">
                            </div>
                            <div class="content_talks">
                                <h1>3.</h1>
                                <label>Tell us what you need</label>
                            </div>
                            <p>
                                Pick a room, set your budget and tell us about your Pinterest worthy dreams – whether a
                                full
                                overhaul, or just some ideas to pull it together.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="my_style">
        <div class="container">
            <div class="style_cont">
                <div class="row">
                    <div class="img_style">
                        <img src="{{Request::root()}}/public/images/mystyle.jpg" alt="style-A-home">
                    </div>
                    <div class="myStyle_content">
                        <h4>what’s my style</h4>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley
                            of type and scrambled it to make a type specimen book. It has survived not only five
                            centuries,
                        </p>
                        <button class="mt-5 brown_btn pl-4 pr-4 pt-1 pb-1">Pre Order</button>
                    </div>
                </div>
            </div>
            <div class="session_cont mt-5 pt-4">
                <div class="row">
                    <div class="col-lg-4 col-xs-12">
                        <div class="box">
                            <div class="liveSession">
                                <label class="mb-0">$19</label>
                            </div>
                            <h3>Live Session</h3>
                            <p>Schedule a 20-minute video call with a Havenly designer in real time.</p>
                            <div class="icon_play">
                                <a href="#"><img src="{{Request::root()}}/public/images/play.png" alt="style-A-home"></a>
                            </div>
                            <ul class="profile mb-4">
                                <li>
                                    <img src="{{Request::root()}}/public/images/profile.png" alt="style-A-home">
                                    <p>”Do you think this look would work in my living room?”</p>
                                </li>
                            </ul>
                            <button class="mt-3 brown_btn d-block">Schedule a video call</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12">
                        <div class="box">
                            <div class="liveSession">
                                <label class="mb-0">$19</label>
                            </div>
                            <h3>Style A Home Mini</h3>
                            <p>Get design inspiration and custom solutions to spice up your space or refresh a room.</p>
                            <div class="icon_play">
                                <img src="{{Request::root()}}/public/images/session2.jpg" alt="style-A-home">
                            </div>
                            <button class="mt-3 brown_btn d-block">Schedule a video call</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12">
                        <div class="box">
                            <div class="liveSession">
                                <label class="mb-0">$19</label>
                            </div>
                            <h3>Style A Home Mini</h3>
                            <p>Get design inspiration and custom solutions to spice up your space or refresh a room.</p>
                            <div class="icon_play">
                                <img src="{{Request::root()}}/public/images/session2.jpg" alt="style-A-home">
                            </div>
                            <button class="mt-3 brown_btn d-block">Schedule a video call</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial">
        <div class="testimonial_img">
            <div class="container">
                <div class="row">
                    <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="testimonialBox">
                                    <h3>Mind if we show off?</h3>
                                    <label>Designed by Pamela Kilyk for Luigi P.</label>
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.
                                        It has survived not only five centuries,</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonialBox">
                                    <h3>Mind if we show off?</h3>
                                    <label>Designed by Pamela Kilyk for Luigi P.</label>
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.
                                        It has survived not only five centuries,</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="testimonialBox">
                                    <h3>Mind if we show off?</h3>
                                    <label>Designed by Pamela Kilyk for Luigi P.</label>
                                    <ul>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.
                                        It has survived not only five centuries,</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-xs-12">
                    <h3>We work with top clients.</h3>
                    <span>Partners</span>
                </div>
                <div class="col-lg-9 col-xs-12">
                   <div class="partner_links">
				    <ul>
					 <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon1.png" alt=""></a></li>
					  <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon2.png" alt=""></a></li>
					   <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon3.png" alt=""></a></li>
					    <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon4.png" alt=""></a></li>
						 <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon5.png" alt=""></a></li>
						  <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon6.png" alt=""></a></li>
					       <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon7.png" alt=""></a></li>
					        <li><a href="#"> <img src="{{Request::root()}}/public/images/partner_icon8.png" alt=""></a></li>
					</ul>

				   </div>
                </div>
            </div>
        </div>
    </section>
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
