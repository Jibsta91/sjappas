<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 6.7
 */

use BestListing\wpWax\ThemeSupport;
use BestListing\wpWax\Helper as ThemeHelper;
use \Directorist\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="directorist-wrapper directorist-author-profile-content">

	<div class="<?php Helper::directorist_container_fluid(); ?>">

		<div class="<?php Helper::directorist_row(); ?> directorist-mb-40">

			<div class="<?php Helper::directorist_column( 'lg-8' ); ?>">
				<?php
				$author->header_template();
				$author->about_template();
				?>
			</div>

			<div class="<?php Helper::directorist_column( 'lg-4' ); ?>">

				<?php ThemeHelper::get_template_part( 'directorist/custom/author-sidebar', ThemeSupport::get_author_args( $author ) ); ?>

			</div>

			<div class="<?php Helper::directorist_column( 'lg-12' ); ?>">

				<?php $author->author_listings_template(); ?>

			</div>

		</div>

	</div>

</div>
