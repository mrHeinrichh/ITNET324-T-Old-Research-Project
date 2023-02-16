<?php 
if(isset($_GET['id']) && $_GET['id'] > 0){
    $conn->query("UPDATE `quote_list` set `status` = 1 where id = '{$_GET['id']}'");
    $qry = $conn->query("SELECT *  from `quote_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k))
                $$k = $v;
        }
    }
    if(isset($id)){
        $services = $conn->query("SELECT s.`name` FROM `quote_services` qs inner join service_list s on qs.service_id = s.id where qs.quote_id = '{$id}'");
        $service_arr = implode(", ", array_column($services->fetch_all(MYSQLI_ASSOC),'name'));
    }
}
?>
<style>
    .course_logo{
        width:100%;
        height:100%;
        object-fit:cover;
        object-position:center center;
    }
</style>
<div class="content bg-gradient-teal py-5 px-4">
    <h3 class="font-weight-bolder">Quote Request Details</h3>
</div>
<div class="row mt-n5 justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
        <div class="card card-outline card-dark rounded-0 shadow">
            <div class="card-body">
                <div class="container-fluid" id="printout">
                    <fieldset>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="" class="control-label text-muted">Requested by</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($fullname) ? $fullname : '' ?></div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="" class="control-label text-muted">Contact #</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($contact) ? $contact : '' ?></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="" class="control-label text-muted">Email</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($email) && !empty($email) ? $email : 'N/A' ?></div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="" class="control-label text-muted">Schedule Date</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($schedule) && !empty($schedule) ? date("F d, Y", strtotime($schedule)) : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="" class="control-label text-muted">Service(s)</label>
                                <div class="pl-4"><?= isset($service_arr) && !empty($service_arr) ? $service_arr : '' ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="" class="control-label text-muted">Address</label>
                                <div class="pl-4"><?= isset($address) ? (str_replace(["\n\r", "\n", "\r"], '<br>', htmlspecialchars_decode($address))) : '' ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="" class="control-label text-muted">Other Information</label>
                                <div class="pl-4"><?= isset($remarks) && !empty($remarks) ? (str_replace(["\n\r", "\n", "\r"], '<br>', htmlspecialchars_decode($remarks))) : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label for="" class="control-label text-muted">Admin Remarks</label>
                                <div class="pl-4"><?= isset($admin_remarks) && !empty($admin_remarks) ? (str_replace(["\n\r", "\n", "\r"], '<br>', htmlspecialchars_decode($admin_remarks))) : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="" class="control-label text-muted">Date Requested</label>
                                <div class="pl-4 font-weight-bolder"><?= isset($date_created) ? date("F d, Y", strtotime($date_created)) : '' ?></div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="card-footer py-1 text-center">
                <button id="delete_quote" class="btn btn-danger btn-flat bg-gradient-danger btn-sm" type="button"><i class="fa fa-trash"></i> Delete</button>
                <button id="manage_remarks" class="btn btn-primary border-0 btn-flat bg-gradient-teal btn-sm" type="button"><i class="fa fa-pen"></i> Manage Remarks</button>
                <button id="print" class="btn btn-success btn-flat bg-gradient-success btn-sm" type="button"><i class="fa fa-print"></i> Print</button>
                <a class="btn btn-light btn-flat bg-gradient-light border btn-sm" href="./?page=quotes"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
    </div>
</div>
<noscript id="print-header">
    <div>
        <div class="d-flex w-100 align-items-center">
            <div class="col-2 text-center">
                <img src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="rounded-circle border" style="width: 5em;height: 5em;object-fit:cover;object-position:center center">
            </div>
            <div class="col-8">
                <div style="line-height:1em">
                    <div class="text-center font-weight-bold"><large><?= $_settings->info('name') ?></large></div>
                    <div class="text-center font-weight-bold"><large>Quote Request Details</large></div>
                </div>
            </div>
        </div>
       
        <hr>
    </div>
</noscript>
<script>
     function print_t(){
        var h = $('head').clone()
        var p = $('#printout').clone()
        var ph = $($('noscript#print-header').html()).clone()
        h.find('title').text("order Details - Print View")
        var nw = window.open("", "_blank", "width="+($(window).width() * .8)+",left="+($(window).width() * .1)+",height="+($(window).height() * .8)+",top="+($(window).height() * .1))
            nw.document.querySelector('head').innerHTML = h.html()
            nw.document.querySelector('body').innerHTML = ph[0].outerHTML
            nw.document.querySelector('body').innerHTML += p[0].outerHTML
            nw.document.close()
            start_loader()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    nw.close()
                    end_loader()
                }, 200);
            }, 300);
    }
    $(function(){
        $('#print').click(function(){
            print_t()
        })
        $('#delete_quote').click(function(){
			_conf("Are you sure to delete this quote permanently?","delete_quote",['<?= isset($id) ? $id : '' ?>'])
		})
        $('#manage_remarks').click(function(){
			uni_modal("Manage Remark","quotes/manage_remark.php?id=<?= isset($id) ? $id : '' ?>")
		})
    })
    function delete_quote($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_quote",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace("./?page=quotes");
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>