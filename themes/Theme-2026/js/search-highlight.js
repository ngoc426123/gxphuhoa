(function ($) {
  'use strict';

  $(document).ready(function () {
    var $page = $('[data-search-page]');
    if (!$page.length) return;

    // Read keyword from the search input (already populated by PHP)
    var keyword = ($('[data-search-page] .searchPage-form__input').val() || '').trim();
    if (!keyword) return;

    // Split into individual terms, escape each for regex use
    var terms = keyword
      .split(/\s+/)
      .filter(function (t) { return t.length > 1; })
      .map(function (t) {
        return t.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
      });

    if (!terms.length) return;

    var pattern = new RegExp('(' + terms.join('|') + ')', 'gi');

    // Highlight titles
    $('[data-search-page] .catNewsRow-title').each(function () {
      var $el = $(this);
      $el.html($el.text().replace(pattern, '<mark>$1</mark>'));
    });

    // Highlight excerpts
    $('[data-search-page] [data-excerpt]').each(function () {
      var $el = $(this);
      $el.html($el.text().replace(pattern, '<mark>$1</mark>'));
    });
  });

}(jQuery));
