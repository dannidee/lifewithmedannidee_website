<?php 
global $base_url;

?>

<footer id="colophon" class="site-footer">
    <div id="footer-top">
        <div class="container">
            <div class="widget clearfix">
                <?php print render($page['footer_top']);?>
            </div>
        </div>
    </div>
    <div id="footer-middle">
        <div class="container">
            <div class="row">
                <?php print render($page['footer_middle']);?>
            </div>
        </div>
    </div>
    <div id="footer-bottom">
        <div class="container">
            <div class="copyright">
                <?php print theme_get_setting('footer_copyright_message','glim'); ?>
            </div>
        </div>
    </div>
</footer>