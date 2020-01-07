<?php


/**
 * The main template file
 */
//error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', '1');
ini_set('html_errors', '1');
get_template_part('open');
get_template_part('header');
get_template_part('navigation');
// get_template_part('archive-content-workouts');
echo 
'<section id="main" class="uk-margin-small-top uk-margin-bottom">
	<div class="uk-container uk-container-center">
		<div class="uk-grid" data-uk-grid-margin >
			<div class="uk-width-1-1">
				<section id="content"> ';

					// if ( is_search() ) {
					// 	echo "<h1 class='uk-heading-large'>Search Results</h1>";
					// }elseif( is_home() ) {
					// 	echo "<h1 class='uk-heading-large g5-page-title'>Blog</h1>";
					// }
					 get_template_part('loop-workshops');

echo 
				'</section>
			</div>
		</div>
	</div>
</section>';

get_template_part('footer');
get_template_part('close');