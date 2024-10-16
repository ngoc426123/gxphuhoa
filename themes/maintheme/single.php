<?php
get_header();
?>
<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "NewsArticle",
  "mainEntityOfPage":{ 
    "@type":"WebPage",
    "@id":"<?php echo the_permalink(); ?>"
  },
  "headline": "<?php echo the_title(); ?>",
  "description": "<?php echo the_excerpt(); ?>",
  "image": {
    "@type": "ImageObject",
    "url": "<?php echo get_thumb() ?>",  
    "width" : 720,
    "height" : 480 
  },
  "datePublished": "<?php echo get_the_date("Y-m-d H:i") ?>",
  "dateModified": "<?php echo get_the_date("Y-m-d H:i") ?>",
  "author": { 
    "@type": "Person",
    "name": "<?php echo home_url(); ?>"
  },
  "publisher": {
    "@type": "Organization",
    "name": "<?php echo home_url(); ?>",
    "logo": { 
      "@type": "ImageObject",
      "url": "<?php echo TEMPL_DIR ?>/images/logo.png"
    }
  }
}
</script>
<?php
if(have_posts()):
  while(have_posts()):
    the_post();
    $id=get_the_id();
    $luotxem=get_post_meta( $id, 'wpcf-luot-xem',true);
    $luotxem++;
    update_post_meta( $id,'wpcf-luot-xem', $luotxem);
  endwhile;
endif;
?>
<?php
if(in_category(142) OR in_category(185)){
  include TEMPLATEPATH."/single-audio.php";
}
else{
  include TEMPLATEPATH."/single-normal.php";
}
?>
<?php
get_footer();
?>