import $http from 'axios';

@Plugin({
  options: {
    pluginName: 'Category',
    dataListNews: '[data-list-news]',
    dataLoadMore: '[data-load-more]',
  }
})
export default class Category {
  init() {
    this.initDom();
    this.initEvent();
  }

  initDom () {
    const {
      dataListNews,
      dataLoadMore
    } = this.options;

    this.$listNews = this.$element.find(dataListNews);
    this.$loadMore = this.$element.find(dataLoadMore);
  }

  initEvent () {
    const {
      pluginName
    } = this.options;

    // CLICK LOAD MORE
    this.$loadMore
      .off(`click.${pluginName}`)
      .on(`click.${pluginName}`, (event) => this.loadMore(event));
  }

  async loadMore (event) {
    event.preventDefault();
    $(window).trigger('open-loading');

    const cate = parseInt(this.$loadMore.attr('data-cate'));
    const perpage = parseInt(this.$loadMore.attr('data-perpage'));
    const offset = parseInt(this.$loadMore.attr('data-offset'));
    const nettOffset = offset + perpage;
    const url = window.api.posts;
    const params = { perpage, cate, offset };
    const method = 'get';
    const _data = await $http({ method, params, url });

    if ( _data.data.length > 0 ) {
      this.renderItem(_data.data);
      this.$loadMore.attr('data-offset', nettOffset);
    } else {
      this.$loadMore.remove();
    }

    $(window).trigger('close-loading');
  }

  renderItem (data) {
    data.forEach(item => {
      const tmp = `<div class="news v2">
                    <div class="img">
                      <a href="${item.link}" title="${item.title}" style="background-image:url(${item.img});"></a>
                    </div>
                    <div class="caption">
                      <div class="date">${item.date}</div>
                      <div class="cat">${item.cat}</div>
                      <div class="tend"><a href="${item.link}" title="${item.title}">${item.title}</a>
                      </div>
                      <div class="des">${item.des}</div>
                    </div>
                  </div>`;
      this.$listNews.append(tmp);
    });
  }
}