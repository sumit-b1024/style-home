@extends('layouts.frontend')
@section('content')
	<section class="banner_inner">
        <div class="bannerParallax_inner privacy">

        </div>
    </section>

    <section class="designer_cont project_main">
        <h4>Project Detail </h4>
        <div class="container">
            <div class="row"><div class="col-sm-8"><form> <div class="room_design">  <h4>Please tell us a little bit more about the room you want to improve</h4>    <div class="form-group">  <label> Can you tell us a little bit more about the room and who it's for and its current state? (If it's a kid's room, please mention their age so the designer can propose age appropriate designs)</label> <textarea class="form-control" rows="5" id="comment">ss</textarea>  </div>      <div class="form-group">	<label>Please attach a few pictures or video of the room</label>  	<div class="video_upload">		 	<label for="file-upload" class="custom-file-upload">   Upload</label><input id="file-upload" type="file"/>				</div></div>		<div class="form-group">  <label>What are the dimensions of the room? </label> <input type="text" name="dimensions" class="form-control">  </div>			<div class="form-group">  <label>Which items in the room you want to keep? Please attach pictures of the items if they are not shown in the pictures you uploaded in </label> <textarea class="form-control" rows="5" id="comment">ss</textarea>  	<div class="video_upload">		 	<label for="file-upload" class="custom-file-upload">Upload</label><input id="file-upload" type="file"/>				</div>  </div>	   </div>   <div class="room_design">  <h4>Now, let's talk about the project</h4>       <div class="form-group">  <label>What is the vision you have for this room?</label> <input type="text" name="vision" class="form-control">  </div>    <div class="form-group">  <label>Any specific areas you want the designer to focus on?</label> <input type="text" name="focus" class="form-control">  </div>     <div class="form-group">  <label>Do you have inspiration images you want to upload to give us a better idea of your style?</label> 	<div class="video_upload">		 	<label for="file-upload" class="custom-file-upload">upload</label><input id="file-upload" type="file"/>				</div>  </div>       <div class="form-group">  <label>Do you have a pinterest board link you want to share with us?</label> <input type="text" name="board" class="form-control">  </div>      <div class="form-group">  <label>Any color schemes you have in mind?</label> <input type="text" name="color" class="form-control">  </div>           <div class="form-group">  <label>Any specific items or material you want us to make sure we include in the design?</label> <input type="text" name="item" class="form-control">  </div>         <div class="form-group">  <label>What is your budget for this project?</label> <input type="text" name="budget" class="form-control">  </div>          <div class="form-group">  <label>Any other considerations we need to keep in mind  (kids, pets, preferences, likes or dislikes) ?</label> <input type="text" name="budget" class="form-control">  </div>     </div> <button type="submit" class="btn btn-primary mb-2 style_submit">Submit</button></form> </div><div class="col-sm-4">  <img src="http://learning.neuronsit.in/style-home/public/img/right_img.jpg" alt="style-A-home"></div>
                
            </div>
        </div>
    </section>

   
@endsection
