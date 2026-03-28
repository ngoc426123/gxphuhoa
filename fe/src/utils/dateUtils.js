export const DAY_ABBR = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
export const DAY_FULL = ['Chúa nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];

export function itemDate(item) {
  // Parse actual liturgical date from title: "...ngày D tháng M YYYY"
  // This avoids timezone shifts from pubDate (which is the RSS publish timestamp).
  if (item.title) {
    const m = item.title.match(/ngày (\d+) tháng (\d+) (\d{4})/);
    if (m) return new Date(parseInt(m[3]), parseInt(m[2]) - 1, parseInt(m[1]));
  }
  return new Date(item.pubDate);
}

export function ddmm(date) {
  return `${String(date.getDate()).padStart(2, '0')}/${String(date.getMonth() + 1).padStart(2, '0')}`;
}

export function fullDateLabel(date) {
  return `${DAY_FULL[date.getDay()]}, ${date.getDate()} tháng ${date.getMonth() + 1}, ${date.getFullYear()}`;
}

export function fmtTime(seconds) {
  if (!isFinite(seconds) || seconds < 0) return '0:00';
  const m = Math.floor(seconds / 60);
  const s = Math.floor(seconds % 60).toString().padStart(2, '0');
  return `${m}:${s}`;
}
