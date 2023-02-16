<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `service_list` where id = '{$_GET['id']}' and delete_flag = 0 ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
		echo "<script>alert('You dont have access for this page'); location.replace('./');</script>";
	}
}else{
	echo "<script>alert('You dont have access for this page'); location.replace('./');</script>";
}
?>
<style>
	#service-img{
		max-width:100%;
		max-height:35em;
		object-fit:scale-down;
		object-position:center center;
	}
</style>
<section class="py-3">
	<div class="container">
		<div class="content py-5 px-3 bg-gradient-teal">
			<h2><b>Service Details</b></h2>
		</div>
		<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
			<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
				<div class="card rounded-0">
					<div class="card-body">
						<div class="container-fluid">
							<center>
								<img src="<?= validate_image(isset($image_path) ? $image_path : '') ?>" alt="<?= isset($name) ? $name : '' ?>" class="img-thumbnail p-0 border" id="service-img">
							</center>
							<dl>
								<dt class="text-muted">Service</dt>
								<dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
								<dt class="text-muted">Description</dt>
								<dd class="pl-4"><?= isset($description) ? str_replace(["\n\r", "\n", "\r"],"<br>", htmlspecialchars_decode($description)) : '' ?></dd>
							</dl>
						</div>
					</div>
					<div class="card-footer py-1 text-center">
						<a class="btn btn-light btn-sm bg-gradient-light border rounded-0" href="./?p=services"><i class="fa fa-angle-left"></i> Back to List</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
    $(function(){
		$('#add_to_cart').click(function(){
			_conf("Are you sure to add this service to your cart?", "add_cart",[])
		})
    })
	function add_cart(){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=add_to_card",
			method:"POST",
			data:{service_id: "<?= isset($id) ? $id :'' ?>"},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else if(!!resp.msg){
					alert_toast(resp.msg,'error');
				}else{
					alert_toast("An error occured.",'error');
				}
				end_loader();
			}
		})
	}
</script>