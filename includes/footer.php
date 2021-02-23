<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5 class="footer-head">Social Media</h5>
                <ul class="footer-list">
                    <?php
                        $query=mysqli_query($conn, "select * from social_media order by name asc");
                        while ($row=mysqli_fetch_array($query)) {
                    ?>
                        <li class="social-media-link">
                            <a href="<?php echo htmlentities($row['url']); ?>" 
                                title="<?php echo htmlentities($row['name']); ?>" target="_blank">
                                <img src="<?php echo $logoDir; ?>/social_media-image/<?php echo htmlentities($row['image']); ?>" /> 
                                <?php echo htmlentities($row['name']); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="footer-head">Quick Links</h5>
                <ul class="footer-list">
                    <li><a href="/" title="Home Page">Home</a></li>
                    <li><a href="portfolio" title="Portfolio Page">Portfolio</a></li>
                    <li><a href="contact" title="Contact Page">Contact</a></li>
                    <li><a href="about" title="About Page">About</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="footer-head">Location</h5>
                <ul class="footer-list">
                    <?php if(isset($phoneData) || isset($mobileData)) { ?>
                        <li>
                            <i class="fa fa-phone"></i> 
                            <?php 
                                echo htmlentities($phoneData); 
                                if ($mobileData != '') {
                                    echo ' / '.htmlentities($mobileData);
                                } 
                            ?>
                        </li>
                    <?php } ?>
                    <?php if(isset($emailData)) { ?>
                        <li>
                            <a href="mailto:<?php echo htmlentities($emailData); ?>">
                                <i class="fa fa-envelope-o"></i> <?php echo htmlentities($emailData); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="bg-dark p-3 text-light <?php echo !empty($designed_byData) || !empty($developed_byData) ? 'copy-right-footer' : 'text-center'; ?>">
        <div class="container">
            <span>
                <?php 
                    if(!empty($designed_byData)) { ?>
                        Designed by:
                        <a href="<?php echo htmlentities($designed_by_urlData); ?>" target="_blank"><?php echo htmlentities($designed_byData); ?></a>
                    <?php }

                    echo !empty($designed_byData) && !empty($developed_byData) ? '<br/>' : '';

                    if(!empty($developed_byData)) { ?>
                        Developed by: 
                        <a href="<?php echo htmlentities($developed_by_urlData); ?>" target="_blank"><?php echo htmlentities($developed_byData); ?></a>
                    <?php }
                ?>
            </span>
            <span><hr/>A.R.Bhatta &copy; <?php echo date('Y'); ?>.</span>
        </div>
    </div>
</footer>
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('.datatable-1').dataTable();
    $('.dataTables_paginate').addClass("btn-group datatable-pagination");
    $('.dataTables_paginate > a').wrapInner('<span />');
    $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
    $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
});
</script>
<script type="text/javascript">
    function redirectTo($url) {
        window.open($url, '_blank');
    }
    function redirectToSelf($url) {
        window.open($url, '_self');
    }
</script>
</body>

</html>