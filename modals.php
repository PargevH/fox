<!--     CHANGE PROFILE PHOTO     -->

<div class="modal fade" id="myModalImg" role="dialog">
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
        	<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title"></h4>
        	</div>
        	<div class="modal-body">
         		<input type="file" name="profil_img" class='input_img' id='profil_img_input'>	
        	</div>
        	<div class="modal-footer footer_img">
          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	</div>
      	</div>
    </div>
</div>

<!--     POST      -->

<div class="modal fade" id="myModalPost" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">ADD POST</h4>
          </div>
          <form class="modal_form">
          <div class="modal-body_post">
            <label for="fname">Post name</label>
              <input type="text" id="Pname" name="postName" placeholder="Post name..">
              <input type="file" name="post_img" class='input_post_img' id='post_img_input'>
          </div>
          <div class="modal-footer post_footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
           </form>
        </div>
    </div>
</div>

<!--           -->

<div class="modal fade" id="myModal_friend" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>hastat add?</p>
        </div>
        <form action="" method="POST" class="form-horizontal">
          <button type="button" class="btn btn-danger del" name="delet_album" data-dismiss="modal">yes</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">no</button>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>