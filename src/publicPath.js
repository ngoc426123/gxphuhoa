// Plugin truyền URL thư mục app/ để webpack load đúng ảnh/chunk; không có (npm start) thì giữ mặc định
if (window.PRAY_FOR_US && window.PRAY_FOR_US.publicPath) {
  // eslint-disable-next-line no-undef
  __webpack_public_path__ = window.PRAY_FOR_US.publicPath;
}
