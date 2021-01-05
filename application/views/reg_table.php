 
 <div class="container-fluid">
 	<div class="jumbotron text-center">
 	</div>

 	<div class="row">
 		<div class="col-md-2"></div>
 		<div class="col-md-8">
 			<div class="col-sm-2"><br>
 			 <button class="btn btn-primary"><a href="<?php echo base_url('Registration/add/');?>" class="textCls">Add</a> </button> 
 			 <br>
 			</div>
		<div class="col-sm-4">
						Select Role:
 						<select class="form-control" id="role_type" name="role_type">
 						<option value="">Select Role</option>	
 						<option value="1">Project manager</option>
 						<option value="2">Task manager</option>
 						</select>
 						<br>
 		</div>
 		<div class="col-sm-3">
						From Date:
 						<input type="date" name="frm_date" id="frm_date">
 						<br>
 		</div>
 		<div class="col-sm-3">
						To Date:
 						<input type="date" name="to_date" id="to_date">
 						<br>
 		</div>
 					
				

		 <?php
					if ($this->session->flashdata('myMsj')) {
						$message =  $this->session->flashdata('myMsj');
					?>
 					<div class="<?php echo $message['class'] ?>" id="msg"><?php echo $message['message']; ?> </div>
 				<?php } ?>
 				<script type="text/javascript">
 					 $('#msg').fadeOut(3000);
 				</script>
 			<table class="table table-bordered">
 				<thead>
 					<tr>
 						<th>Name</th> 
						 <th>Email</th>
						 <th>Phone</th>
						 <th>Role type</th>
						 <th>Action</th>
 					</tr>
 				</thead>
 				<tbody>
					 <?php  foreach($userList as $row){ ?>
 					<tr>
 						<td><?php echo $row->name;?></td>
 						<td><?php echo $row->email;?></td>
						 <td><?php echo $row->phone_no;?></td>  
						 <td>
							<?php if($row->role_type==1	){
							echo "Project Manager";
							}if($row->role_type==2){
								echo "Task Manager";
							} ?>

						 </td>  
						 <td> 
							<button class="btn btn-primary"><a href="<?php echo base_url('Registration/edit/').$row->id;?>" class="textCls">Edit</a> </button>
						    <button class="btn btn-danger"><a href="<?php echo base_url('Registration/delete/').$row->id;?>" class="textCls">Delete</a> </button>
						</td> 
					 </tr> 
					 <?php } ?>
 				</tbody>
 			</table>
 			<div style="text-align: right;">
			 <?php if (isset($links)) { ?>
                <?php echo $links ?>
            <?php } ?>
            </div>
 		</div>
 	</div>
 </div>
 <script type="text/javascript">
 	$("#role_type").change(function(){
 		var role_type=$(this).val();
 		var frm_date=$("#frm_date").val();
 		var to_date=$("#to_date").val();
 		if(frm_date==""){
 			alert("Please Select From Date")
 			return false;
 		}
 		if(to_date==""){
 			alert("Please Select To Date")
 			return false;
 		}
 		if(role_type==""){
 			alert("Please Select role type")
 			return false;
 		}
 		var base_url="<?php echo base_url()?>";

 		window.location.href=base_url+"Api/table?role_type="+role_type+"&frm_date="+frm_date+"&to_date="+to_date;



 	})
 </script>
