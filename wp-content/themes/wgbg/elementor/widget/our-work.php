<?php
namespace MEPPlugin\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class GCOurWork extends Widget_Base {

	public function get_name() {
		return 'green-card-our-work';
	}

	public function get_title() {
		return __( 'Our Work (Case Study)', 'mage-eventpress' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'green-card-elementor-support' ];
	}

	protected function _register_controls() {

		/* =====================
		 * QUERY SETTINGS
		 * ===================== */
		$this->start_controls_section(
			'query_section',
			[
				'label' => __( 'Query', 'mage-eventpress' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Posts Per Page', 'mage-eventpress' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$template_dir = get_template_directory_uri();

		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$args = [
			'post_type'      => 'case_study',
			'posts_per_page' => $settings['posts_per_page'],
			'post_status'    => 'publish',
			'paged'          => $paged,
		];

		$query = new \WP_Query( $args );
		?>

		<section class="our-works">
			<div class="container">
				<div class="row">

					<?php if ( $query->have_posts() ) : ?>
						<?php while ( $query->have_posts() ) : $query->the_post();

							$post_id = get_the_ID();

							$card_image = get_the_post_thumbnail_url( $post_id, 'large' );
							if ( ! $card_image ) {
								$card_image = $template_dir . '/images/work.png';
							}

							$heading_prefix = get_post_meta( $post_id, '_cs_heading_prefix', true );
							$heading_main   = get_post_meta( $post_id, '_cs_heading_main', true );
							$intro_text     = get_post_meta( $post_id, '_cs_intro_text', true );
							$card_bg_image  = get_post_meta( $post_id, '_cs_card_bg_image', true );
							?>

							<div class="col-md-12 mb-4">
								<div class="work-inner"
									style="background-image: url('<?php echo esc_url( $card_bg_image ); ?>')">

									<div class="work-photo">
										<img src="<?php echo esc_url( $card_image ); ?>"
											alt="<?php the_title_attribute(); ?>">
									</div>

									<div class="content-copy">
										<h1>
											<?php if ( $heading_prefix ) : ?>
												<span><?php echo esc_html( $heading_prefix ); ?></span>
											<?php endif; ?>

											<?php echo esc_html( $heading_main ?: get_the_title() ); ?>
										</h1>

										<p>
											<?php
											if ( has_excerpt() ) {
												the_excerpt();
											} elseif ( $intro_text ) {
												echo esc_html( wp_trim_words( $intro_text, 30 ) );
											} else {
												echo esc_html( wp_trim_words( get_the_content(), 30 ) );
											}
											?>
										</p>

										<ul>
											<li><img src="<?php echo esc_url( $template_dir . '/images/wicon2.png' ); ?>" alt=""></li>
											<li><img src="<?php echo esc_url( $template_dir . '/images/wicon1.png' ); ?>" alt=""></li>
										</ul>

										<a href="<?php the_permalink(); ?>" class="btn btn-info">
											<?php esc_html_e( 'View Case Study', 'mage-eventpress' ); ?>
										</a>
									</div>

								</div>
							</div>

						<?php endwhile; ?>

						<!-- Pagination -->
						<div class="col-md-12">
							<nav class="pagination-wrapper">
								<?php
								echo paginate_links( [
									'total'   => $query->max_num_pages,
									'current' => $paged,
									'type'    => 'list',
									'prev_text' => '&laquo;',
									'next_text' => '&raquo;',
								] );
								?>
							</nav>
						</div>

						<?php wp_reset_postdata(); ?>

					<?php else : ?>
						<p><?php esc_html_e( 'No case studies found.', 'mage-eventpress' ); ?></p>
					<?php endif; ?>

				</div>
			</div>
		</section>

		<?php
	}
}
