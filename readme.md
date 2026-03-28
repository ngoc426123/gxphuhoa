## Tiêu đề
dự án này sẽ là một plugin của wordpress + source code react

## giới thiệu:
Plugin Lời Chúa Hằng Ngày sẽ hiển thị nội dung các bài đọc, đáp ca và lời Chúa hằng ngày, được sự cho phép của RSS vatican tiếng việt, lấy nội dung lời chúa trong một tuần để hiển thị, từ thứ 2 đến chúa nhật.

## hoạt động:
Plugin này sẽ gọi một link RSS từ vatican new tiếng việt để lấy nội dung lời chúa hằng ngày trong xuyên suốt tuần, nội dung sẽ có string và audio
Plugin tạo một shortcode để sử dụng mọi nơi trong trang web, có thể chèn vào bài viết hoặc đặt trực tiếp trong source, shortcort này sẽ render một custom html element, và custom html element này sẽ được sử dụng làm root chính cho reactjs.

### tên shortcode
Shortcode của plugin sẽ có tên là [gxphuhoa-vaitcan-daily-gospel]

### link RSS
link RSS lấy nội dung là
https://api.rss2json.com/v1/api.json?rss_url=https://www.vaticannews.va/vi/loi-chua-hang-ngay.rss.xml

đây là link có json format được convert bởi rss2json.com

### cách thức lập trình - Dành cho develop
Source sẽ gồm 2 phần và được đặt chung một folder
- FE: 1 là source reactjs
  . source này sẽ render phần layout và các chức năng đựơc hiển thị ngoài trang.
  . Layout của component này ngoài trang chủ sẽ lấy từ file layout.pug nằm ngang hàng.
  . Style của component này sẽ lấy từ file style.scss, hãy dùng react mà không cần scss, chuyển sáng dùng css.
  . sẽ call api từ link RSS ở trên để lấy dữ liệu lời chúa hằng ngày, hiển thị text là các đoạn bài đọc và audio link, nếu có.
  . câu lệnh build ở source này sẽ là folder cuối cùng để người dùng có thể upload lên và sử dụng như một plugin bình thường, bao gồm cả file JS, CSS, index của plugin.
- Plugin: là plugin của wordpress: Plugin này sẽ có chức năng tạo shortcode với tên ở trên, enqueue các script và style được build ở source FE.
