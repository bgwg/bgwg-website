<footer class="footer">
  <div class="container">
    <div class="footer-bottom">
      <div class="row">

        <!-- LOGO & TAGLINE -->
        <div class="col-md-5 col-sm-4">
          <div class="footer-logo">
            <?php
            $footer_logo_id = get_theme_mod('gc_footer_logo');

            if ($footer_logo_id) :
                $footer_logo_url = wp_get_attachment_url($footer_logo_id);
                if ($footer_logo_url) :
            ?>
                <img src="<?php echo esc_url($footer_logo_url); ?>" alt="<?php bloginfo('name'); ?>">
            <?php
                endif;
            endif;
            ?>



            <?php if ($tagline = get_theme_mod('gc_footer_tagline')) : ?>
              <p><?php echo esc_html($tagline); ?></p>
            <?php endif; ?>
          </div>
        </div>

        <!-- NAVIGATION -->
        <div class="col-md-2 col-sm-2">
          <div class="footer-nav">
            <p class="footer-title">Navigation</p>
            <?php
              wp_nav_menu([
                'theme_location' => 'footer_menu',
                'menu_class'     => 'nav-list list-unstyled',
                'container'      => false,
              ]);
            ?>
          </div>
        </div>

        <!-- LICENSE -->
        <div class="col-md-2 col-sm-2">
          <div class="footer-nav">
            <p class="footer-title">License</p>
            <?php
              wp_nav_menu([
                'theme_location' => 'footer_license',
                'menu_class'     => 'list-unstyled',
                'container'      => false,
              ]);
            ?>
          </div>
        </div>

        <!-- CONTACT -->
        <div class="col-md-3 col-sm-4">
          <div class="footer-nav">
            <p class="footer-title">Contact</p>
            <ul class="list-unstyled">

              <?php if ($address = get_theme_mod('gc_footer_address')) : ?>
                <li>
                  <i class="fa-solid fa-location-dot"></i>
                  <p><?php echo nl2br(esc_html($address)); ?></p>
                </li>
              <?php endif; ?>

              <?php if ($email = get_theme_mod('gc_footer_email')) : ?>
                <li>
                  <i class="fa-regular fa-envelope"></i>
                  <a href="mailto:<?php echo esc_attr($email); ?>">
                    <?php echo esc_html($email); ?>
                  </a>
                </li>
              <?php endif; ?>

              <?php if ($phone = get_theme_mod('gc_footer_phone')) : ?>
                <li>
                  <i class="fa-solid fa-phone"></i>
                  <a href="tel:<?php echo esc_attr($phone); ?>">
                    <?php echo esc_html($phone); ?>
                  </a>
                </li>
              <?php endif; ?>

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
  
  
  <!-- <footer class="footer">
    <div class="container">
      <div class="footer-bottom">
        <div class="row">
          <div class="col-md-5 col-sm-4">
            <div class="footer-logo">
              <img src="<?php //echo get_template_directory_uri(); ?>/images/footer-logo.png" alt="">
              <p>BGWG Monster Media — Bold Experiences. Big Results.</p>
            </div>
          </div>
          <div class="col-md-2 col-sm-2">
            <div class="footer-nav">
              <p class="footer-title">Navigation</p>
              <?php //wp_nav_menu(array('theme_location' => 'footer_menu','container_class' => '','menu_class' => 'nav-list list-unstyled','fallback_cb' => '','menu_id' => 'footer_menu')); ?>
              
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
                  <p>26391 Crown Valley Pkwy, Set. 240 Mission Viejo, CA 92691</p>
                </li>
                <li><i class="fa-regular fa-envelope"></i><a href="#">hello@bigwigmonster.com</a></li>
                <li><i class="fa-solid fa-phone"></i><a href="#">(949) 407-5088</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
    <?php //wp_footer(); ?>
</body>
</html>
 -->
