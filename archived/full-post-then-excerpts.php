<?php if (have_posts()) : ?>
				<?php
				global $post;
				$the_newest = get_posts('numberposts=1');
				$the_newer = get_posts('numberposts=3&offset=1');
				$the_new = get_posts('numberposts=5&offset=4&order=DESC&orderby=post_date'); ?>
				
				<?php foreach($the_newest as $post) :
					setup_postdata($post);	?>
					<div class="post" id="post-<?php the_ID(); ?>">
						<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry">
							<?php the_content('<span>Read on &raquo;</span>'); ?>
						</div>
						<div class="postmeta">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments', 'Comment (1)', 'Comments (%)'); ?></div>
					</div>
				<?php endforeach; ?>

				<?php foreach($the_newer as $post) :
					setup_postdata($post);	?>
					<div class="post" id="post-<?php the_ID(); ?>">
						<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry">
							<?php the_excerpt('<span>Read on &raquo;</span>'); ?>
						</div>
						<div class="postmeta">Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments', 'Comment (1)', 'Comments (%)'); ?></div>
					</div>
				<?php endforeach; ?>

