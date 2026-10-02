<?php
$wpcf_arr = [
  "wpcf-father-position",
  "wpcf-father-background",
];

foreach($wpcf_arr as $value) {
  $position = '';
  $wpcf_value[$value] = get_post_meta(get_the_ID(), $value, true);

  switch ($wpcf_value["wpcf-father-position"]) {
    case '1':
      $position = "Cha khách";
      break;
    case '2':
      $position = "Chánh xứ";
      break;
    case '3':
      $position = "Nguyên chánh xứ";
      break;
    default:
      $position = "Chưa xác định";
  }
};
?>
<div class="the-fathers__item" data-fathers-item data-keywork="<?php the_title() ?>">
  <div class="the-fathers__image"><img src="<?php echo get_thumb() ?>" alt="Linh mục 1"/>
  </div>
  <div class="the-fathers__info">
    <div class="the-fathers__name"><?php the_title() ?></div>
    <div class="the-fathers__place"><?php echo $wpcf_value["wpcf-father-background"] ?></div>
  </div>
  <div class="the-fathers__position"><?php echo $position ?></div>
</div>