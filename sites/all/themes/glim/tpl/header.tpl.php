<?php 
global $base_url;

?>
<header id="masthead" class="site-header">
    <div id="header-top">
        <div class="container">
            <div class="row">
                <div class="header-search">
                    <div class="search default">
                        <?php

                            $block = module_invoke('search', 'block_view', 'search');

                            print render($block); 

                        ?>
                    </div>
                </div>
                <?php print render($page['header_top']);?>
            </div>
        </div>
    </div>
    <div id="header-middle">
        <div class="container">
            <div class="row">
                <nav id="nav-left" class="site-navigation top-navigation">
                    <div class="menu-wrapper">
                        <?php print render($page['main_menu']);?>
                    </div>
                </nav>
                <div id="site-logo">
                    <a href="<?php print $base_url; ?>" class="site-logo">
                        <img alt="logo" src="<?php print $logo; ?>">
                    </a>
                </div>
                <nav id="nav-right" class="site-navigation top-navigation menu-right">
                    <div class="menu-wrapper">
                        <?php print render($page['main_menu_2']);?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="menucontent overlapblackbg"></div>
    <div class="menuexpandermain slideRight">
        <a id="navToggle" class="animated-arrow slideLeft"><span></span></a>
        <span id="menu-marker">Menu</span>
    </div>
    <div id="mobile-menu">
        <nav class="top-menu slideLeft clearfix">
            <div class="menu-wrapper">
                <div class="container">
                    <div class="row" id="mobile-menu-wrap">
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>