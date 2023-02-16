<style>
    .service-img-holder{
        width:100%;
        height:12.5em;
        overflow:hidden;
    }
    .service-img{
        width:100%;
        height:100%;
        object-fit: cover;
        object-position: center center;
        transition: all .3s ease-in-out;
    }
    .service-item:hover .service-img{
        transform: scale(1.2)
    }
    #search:empty{
        font-style:italic;
    }
    #search{
        border-right:unset !important;
        border-top-right-radius:0px !important;
        border-bottom-right-radius:0px !important;
    }
    #search-icon{
        border-left:unset !important;
        border-top-left-radius:0px !important;
        border-bottom-left-radius:0px !important;
    }
    #search:focus{

    }
</style>
<section class="py-3">
	<div class="container">
		<div class="content bg-gradient-teal py-5 px-3">
			<h4 class="">Our Available Services</h4>
		</div>
		<div class="row mt-n3 justify-content-center">
            <div class="col-lg-10 col-md-11 col-sm-11 col-sm-11">
                <div class="card card-outline rounded-0">
                    <div class="card-body">
                        <div class="row justify-content-center mb-3">
                            <div class="col-lg-8 col-md-10 col-xs-12 col-sm-12">
                                <div class="input-group input-group-lg">
                                    <input type="search" id="search" class="form-control rounded-pill px-3" placeholder="Find Service by name or description">
                                    <span class="btn btn-outline border rounded-pill " id="search-icon" type="button"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-xl-4 row-md-6 col-sm-12 col-xs-12 gy-3 gx-3 align-items-center justify-content-center">
                            <?php 
                                $qry = $conn->query("SELECT * FROM `service_list` where delete_flag = 0 and `status` = 1 order by `name` asc");
                                while($row = $qry->fetch_assoc()):
                            ?>
                            <div class="col service-item">
                                <a class="card rounded-0 shadow service-item text-decoration-none text-reset" href="./?p=services/view_service&id=<?= $row['id'] ?>">
                                    <div class="position-relative">
                                        <div class="img-top position-relative service-img-holder">
                                            <img src="<?= validate_image($row['image_path']) ?>" alt="" class="service-img">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div style="line-height:1em">
                                            <div class="card-title w-100 mb-0"><?= $row['name'] ?></div>
                                            <div class="card-description w-100 truncate-3"><small class="text-muted"><?= strip_tags(htmlspecialchars_decode($row['description'])) ?></small></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<script>
    $(function(){
        $('#search').on('input change', function(){
            var _f = $(this).val().toLowerCase()
            $('.service-item').each(function(){
                var txt = $(this).text().toLowerCase()
                if(txt.includes(_f)){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
            })
        })
    })
</script>