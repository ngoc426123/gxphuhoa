<?php
$category = get_the_terms($post->ID,'category');
$category = $category ? $category[0]-> name : '';
?>
<div class="single-fixed">
	<div class="wrapper">
		<div class="left">
			<div class="lg hidden-sm hidden-xs"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt=""></div>
			<div class="cat hidden-sm hidden-xs"><?php echo $category ?></div>
			<div class="title"><?php the_title(); ?></div>
		</div>
		<div class="social" data-share>
			<ul>
				<li><a class="share-facebook" data-share-facebook style="background-color: #3b5998"><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600,hl=vi');return false;"  style="background-color: #dc4e41;" title=""><i class="fa fa-google"></i></a></li>
				<li><a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>" style="background-color: #1da1f2;"><i class="fa fa-twitter"></i></a></li>
				<li><a href="" title="" style="background-color: #cb2027;"><i class="fa fa-pinterest-p"></i></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
		<div class="the-wrap">
			<div class="the-title"><h1><?php the_title(); ?></h1></div>
			<div class="the-date"><span><?php echo $category ?></span> - <?php the_date("M d/m/Y"); ?></div>
		</div>
		<div class="the-content">
			<?php the_content(); ?>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		<?php
		get_sidebar('single');
		?>
	</div>
</div>