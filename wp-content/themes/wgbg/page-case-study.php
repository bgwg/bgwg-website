<?php
/*
Template Name: Case Study
*/
get_header();
?>

<?php
while ( have_posts() ) :
	the_post();
	the_content(); // <-- ELEMENTOR OUTPUTS HERE
endwhile;
?>

<?php get_footer(); ?>
