<?php
/**
 * Title: Course cards
 * Slug: southern-learn/course-cards
 * Categories: southern-learn
 */
?>
<!-- wp:group {"align":"full","anchor":"courses","className":"section section-mist","layout":{"type":"constrained","wideSize":"1200px"}} -->
<div class="wp-block-group alignfull section section-mist" id="courses">
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Popular courses</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Pick a course, learn at your own pace, and earn a certificate.</p>
<!-- /wp:paragraph -->
<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"course","order":"asc","orderby":"date","inherit":false},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide">
<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"course-card","layout":{"type":"default"}} -->
<div class="wp-block-group course-card">
<!-- wp:paragraph {"className":"chip","metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"course_duration"}}}}} -->
<p class="chip"></p>
<!-- /wp:paragraph -->
<!-- wp:post-title {"level":3,"isLink":true} /-->
<!-- wp:post-excerpt {"excerptLength":24} /-->
<!-- wp:read-more {"content":"View course details"} /-->
</div>
<!-- /wp:group -->
<!-- /wp:post-template -->
<!-- wp:query-no-results --><!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Courses will appear here once the Southern Courses plugin is active.</p><!-- /wp:paragraph --><!-- /wp:query-no-results -->
</div>
<!-- /wp:query -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/courses/' ) ); ?>">View all courses</a></div><!-- /wp:button --></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
