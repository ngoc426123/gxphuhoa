<div class="wrapper">
    <div class="row">
    	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    		<div class="the-title"><h1><?php the_title(); ?></h1></div>
    		<div class="the-date-share">
                <div class="ds_date"><?php the_date("M d/m/Y"); ?></div>
                <div class="ds_share">
                    <ul>
                        <li><a class="share-facebook" href="" title="" style="background-color: #3b5998;"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600,hl=vi');return false;" title="" style="background-color: #dc4e41;"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>" title="" style="background-color: #1da1f2;"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="" title="" style="background-color: #cb2027;"><i class="fa fa-pinterest-p"></i></a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="the-content desc">
            <?php
            the_content();
            ?>
            </div>
            <div class="the-other">
            	<div class="title"><h2>CÁC TIN CŨ HƠN</h2></div>
            	<div class="content">
            		<ul>
            		<?php
    				$args = array(
    					'post__not_in' => array($post->ID),
    					'category__in'     => $cate_id,
    					'posts_per_page'         => 6,
    				);
    				$the_query = new WP_Query($args);
    				if($the_query->have_posts()):
    				while ($the_query->have_posts()):
    					$the_query->the_post();
    					get_template_part("content/content-newsother");
    				endwhile;
    				endif;
    				wp_reset_postdata();
    				?>
                    </ul>
            	</div>
            </div>
    	</div>
    	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
    	<?php
    	get_sidebar();
    	?>
    	</div>
    </div>
</div>