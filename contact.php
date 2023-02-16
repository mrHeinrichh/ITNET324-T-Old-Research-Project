<style>
    .carousel-item>img{
        object-fit:cover !important;
    }
    #carouselExampleControls .carousel-inner{
        height:25em !important;
    }
</style>
<div class="container">
    <div class="content">
        <div id="carouselExampleControls" class="carousel slide bg-dark" data-ride="carousel">
            <div class="carousel-inner">
                <?php 
                    $upload_path = "uploads/banner";
                    if(is_dir(base_app.$upload_path)): 
                    $file= scandir(base_app.$upload_path);
                    $_i = 0;
                        foreach($file as $img):
                            if(in_array($img,array('.','..')))
                                continue;
                    $_i++;
                        
                ?>
                <div class="carousel-item h-100 <?php echo $_i == 1 ? "active" : '' ?>">
                    <img src="<?php echo validate_image($upload_path.'/'.$img) ?>" class="d-block w-100  h-100" alt="<?php echo $img ?>">
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="row mt-lg-n4 mt-md-n4 justify-content-center">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 mb-3">
            <div class="card rounded-0">
                <div class="card-body">
                    <h3 class="text-center"><b>Contact Us</b></h3>
                    <center><hr style="height:2px;width:5em;opacity:1" class="bg-primary"></center>
                    <dl>
                        <dt class="text-muted">Email</dt>
                        <dd class="pl-3"><?= $_settings->info('email') ?></dd>
                        <dt class="text-muted">Telephone #</dt>
                        <dd class="pl-3"><?= $_settings->info('phone') ?></dd>
                        <dt class="text-muted">Mobile #</dt>
                        <dd class="pl-3"><?= $_settings->info('mobile') ?></dd>
                        <dt class="text-muted">Address</dt>
                        <dd class="pl-3"><?= $_settings->info('address') ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
            <div class="card rounded-0">
                <div class="card-body">
                    <h3 class="text-center"><b>Send Us a Message</b></h3>
                    <center><hr style="height:2px;width:5em;opacity:1" class="bg-primary"></center>
                    <form id="inquiry-form">
                        <input type="hidden" name="id" value="">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="fullname" class="control-label">Fullname <small class="text-danger">*</small></label>
                                    <input type="text" name="fullname" id="fullname" class="form-control form-control-sm rounded-0" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="contact" class="control-label">Contact # <small class="text-danger">*</small></label>
                                    <input type="text" name="contact" id="contact" class="form-control form-control-sm rounded-0" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm rounded-0">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="subject" class="control-label">Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control form-control-sm rounded-0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="message" class="control-label">Message</label>
                                    <textarea rows="3" name="message" id="message" class="form-control form-control-sm rounded-0"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                <button class="btn btn-primary border-0 btn-block rounded-pill btn-lg bg-gradient-teal"><i class="fa fa-paper-plane"></i> Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#inquiry-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_inquiry",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload()
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").scrollTop(0);
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
    })
</script>
