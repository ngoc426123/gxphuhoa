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
      const catName = (item.cat && item.cat.length > 0) ? item.cat[0].name : '';
      const tmp = `<div class="catNewsRow">
                    <a class="catNewsRow-img" href="${item.link}" title="${item.title}">
                      <img src="${item.img}" alt="${item.title}">
                    </a>
                    <div class="catNewsRow-body">
                      <div class="catNewsRow-meta">
                        <span class="catNewsRow-cat">${catName}</span>
                        <span class="catNewsRow-date"><i class="far fa-clock"></i> ${item.date}</span>
                      </div>
                      <a class="catNewsRow-title" href="${item.link}">${item.title}</a>
                      <p class="catNewsRow-des">${item.des}</p>
                    </div>
                  </div>`;
      this.$listNews.append(tmp);
    });
  }
}