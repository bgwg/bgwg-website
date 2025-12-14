  <footer class="footer">
    <div class="container">
      <div class="footer-bottom">
        <div class="row">
          <div class="col-md-5 col-sm-4">
            <div class="footer-logo">
              <img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.png" alt="">
              <p>BGWG Monster Media — Bold Experiences. Big Results.</p>
            </div>
          </div>
          <div class="col-md-2 col-sm-2">
            <div class="footer-nav">
              <p class="footer-title">Navigation</p>
              <?php wp_nav_menu(array('theme_location' => 'footer_menu','container_class' => '','menu_class' => 'nav-list list-unstyled','fallback_cb' => '','menu_id' => 'footer_menu')); ?>
              <!-- <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Our Work</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Services</a></li>
              </ul> -->
            </div>
          </div>
          <div class="col-md-2 col-sm-2">
            <div class="footer-nav">
              <p class="footer-title">License</p>
              <ul>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Copyright</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-3 col-sm-4">
            <div class="footer-nav">
              <p class="footer-title">Contact</p>
              <ul>
                <li>
                  <i class="fa-solid fa-location-dot"></i>
                  <p>26391 Crown Valley Parkway Suite 240 Mission Viejo, CA 92691</p>
                </li>
                <li><i class="fa-regular fa-envelope"></i><a href="#">hello@bigwigmonster.com</a></li>
                <li><i class="fa-solid fa-phone"></i><a href="#">123345567899</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
    <?php wp_footer(); ?>
</body>
</html>

