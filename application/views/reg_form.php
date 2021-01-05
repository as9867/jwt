

 <div class="container-fluid">
 	<div class="jumbotron text-center">
 	</div>
 
 	<div class="row">
 		<div class="col-md-2"></div>
 		<div class="col-md-8">

 			<form method="post" action="<?php  if(isset($editInfo)){
			echo base_url('Registration/edit/').$editInfo->id;}else{  echo base_url('Registration/add'); } ?>" enctype="multipart/form-data">
 				<?php
					if ($this->session->flashdata('myMsj')) {
						$message =  $this->session->flashdata('myMsj');
					?>
 					<disessv class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?> </div>
 				<?php } ?>
 				<div class="form-group row">
 					<div class="col-sm-1"> </div>
 					<label class="col-sm-3" for="name"> Name </label>
 					<div class="col-sm-4">
 						<input type="text" class="form-control" placeholder="Enter Name" name="userName" id="userName" value="<?php  if(isset($editInfo)){ echo $editInfo->name; }else{  echo set_value('userName'); }?>">
 					</div>
 					<?php echo form_error('userName'); ?>
 				</div>

 				<div class="form-group row">
 					<div class="col-sm-1"> </div>
 					<label class="col-sm-3" for="Email"> Email </label>
 					<div class="col-sm-4">
 						<input type="text" class="form-control" placeholder="Enter Email" name="emailId" id="emailId" value="<?php  if(isset($editInfo)){ echo $editInfo->email; }else{  echo set_value('emailId'); }?>" >
 					</div>
 					<?php echo form_error('emailId'); ?>
 				</div>

 				<div class="form-group row">
 					<div class="col-sm-1"> </div>
 					<label class="col-sm-3" for="name"> Phone No </label>
 					<div class="col-sm-4">
 						<input type="text" class="form-control" placeholder="Enter Phone No" name="phoneNo" id="phoneNo" value="<?php  if(isset($editInfo)){ echo $editInfo->phone_no; }else{  echo set_value('phoneNo'); }?>">
 					</div>
 					<?php echo form_error('phoneNo'); ?>
				 </div>
				 <div class="form-group row">
 					<div class="col-sm-1"> </div>
 					<label class="col-sm-3" for="name"> Role Type</label>
 					<div class="col-sm-4" id="role_type" name="role_type">
 						<select class="form-control" value="<?php  if(isset($editInfo)){ echo $editInfo->role_type; }else{  echo set_value('role_type'); }?>">
 						<option value="">Select Role</option>	
 						<option value="1" <?php if(isset($editInfo)){ if($editInfo->role_type == '1') { ?> selected="selected"<?php } }?>>Project manager</option>
 						<option value="2" <?php if(isset($editInfo)){ if($editInfo->role_type == '2') { ?> selected="selected"<?php } }?>>Task manager</option>
 						</select>
 					</div>
 					
				 </div>
				

 				<div class="form-group row">
 					<div class="col-sm-1"> </div>
 					<label class="col-sm-3" for="name"> Password </label>
 					<div class="col-sm-4">
 						<input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" value="<?php  if(isset($editInfo)){ echo $editInfo->password; }else{  echo set_value('password'); }?>" >
 					</div>
 					<?php echo form_error('password'); ?>
 				</div>

 				

 				<div class="form-group row">
 					<div class="col-sm-4"> </div>
 					<div class="col-sm-4">
						 <button  class="btn btn-primary" id="add"><?php echo $pageType;?></button>
						 <button class="btn btn-danger"><a href="<?php echo base_url('Registration/table/');?>" class="textCls">Back</a> </button> 
 					</div>
 				</div>

 			</form>
 		</div>
 	</div>
 </div>
 <script type="text/javascript">

 var token="<?php echo $this->session->userdata('token');?>";
 
$('#add').click(function(e){
	e.preventDefault();

    var userName = $("#userName").val();
    var emailId = $("#emailId").val();
    var phoneNo = $("#phoneNo").val();
    var password = $("#password").val();
    var role_type = $('#role_type').find(":selected").val();
    var id="<?php  if(isset($editInfo)){ echo $editInfo->id; }?>"


    $.ajax
    ({ 
        url: "http://localhost/jwt/Api/add",
        
        
        headers:{
    "Authorization": token // here you can add your token for authorization 
  },
  method: "POST",
  data: {"userName": userName,"emailId":emailId,"phoneNo":phoneNo,"password":password,"role_type":role_type,"id":id},
        success: function(result)
        {
           alert(result)
        }
    });
});

 </script>