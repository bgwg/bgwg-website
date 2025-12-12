<footer class="footer">
    <div class="container">
      <div class="footer-top">
        <h4>Download Greencard</h4>
        <ul class="list-unstyled">
          <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/apple-white.png" alt=""> </a></li>
          <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/home-page/play-white.png" alt=""> </a></li>
        </ul>
      </div>
      <div class="footer-bottom">
        <div class="footer-logo">
          <img src="<?php echo get_template_directory_uri(); ?>/images/home-page/footer-logo.png" alt="">
          <p>© 2024 Greencard. All rights reserved.</p>
        </div>
        <div class="footer-nav">
          <?php wp_nav_menu(array('theme_location' => 'footer_menu','container_class' => 'collapse navbar-collapse navbar-responsive-collapse','menu_class' => 'nav-list list-unstyled','fallback_cb' => '','menu_id' => 'header_menu')); ?>
          <ul class="social-list list-unstyled">
            <li><a href=" https://www.facebook.com/profile.php?id=61569508073007&sk=about" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li><a href="https://www.instagram.com/paygreencard/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li><a href="https://x.com/paygreencard" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
    <!--Js resources-->
    <?php wp_footer(); ?>
</body>
</html>