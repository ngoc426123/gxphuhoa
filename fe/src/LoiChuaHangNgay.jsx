import { useState, useEffect } from 'react';
import './LoiChua.css';

import { itemDate } from './utils/dateUtils';
import { RSS_URL } from './utils/rssParser';
import WeekStrip from './components/WeekStrip';
import DayDetail from './components/DayDetail';

export default function LoiChuaHangNgay() {
  const [items, setItems]         = useState([]);
  const [loading, setLoading]     = useState(true);
  const [error, setError]         = useState(null);
  const [activeIdx, setActiveIdx] = useState(0);
  const [revealed, setRevealed]   = useState(false);

  useEffect(() => {
    let cancelled = false;
    setLoading(true); setError(null);

    fetch(RSS_URL)
      .then(r => { if (!r.ok) throw new Error(`HTTP ${r.status}`); return r.json(); })
      .then(data => {
        if (cancelled) return;
        if (data.status !== 'ok') throw new Error('RSS feed error: ' + (data.message || 'unknown'));
        const all = (data.items || []).slice().reverse().slice(0, 7);
        setItems(all);
        const todayStr = new Date().toDateString();
        const idx = all.findIndex(it => itemDate(it).toDateString() === todayStr);
        setActiveIdx(idx >= 0 ? idx : 0);
        setLoading(false);
      })
      .catch(err => {
        if (!cancelled) { setError(err.message || 'Không thể tải dữ liệu'); setLoading(false); }
      });

    return () => { cancelled = true; };
  }, []);

  function handleSelect(idx) {
    setActiveIdx(idx);
    setRevealed(true);
  }

  return (
    <div className="loiChuaHome" data-loi-chua-home>
      <div className="loiChuaHome-head">
        <div className="loiChuaHome-head-left">
          <span className="loiChuaHome-cross">✝</span>
          <h2 className="loiChuaHome-title">Lời Chúa Hàng Ngày</h2>
        </div>
        <a className="loiChuaHome-source"
          href="https://www.vaticannews.va/vi/loi-chua-hang-ngay.html"
          target="_blank" rel="noopener noreferrer">
          Vatican News&nbsp;<i className="fas fa-external-link-alt" />
        </a>
      </div>

      <div className="loiChuaHome-body" data-loi-chua-body>
        {loading && (
          <div className="loiChuaHome-loading">
            <i className="fas fa-spinner fa-spin" /> Đang tải…
          </div>
        )}

        {error && !loading && (
          <div className="loiChuaHome-error">
            <p>⚠ {error}</p>
            <a href="https://www.vaticannews.va/vi/loi-chua-hang-ngay.html" target="_blank" rel="noopener noreferrer">
              Truy cập Vatican News
            </a>
          </div>
        )}

        {!loading && !error && items.length > 0 && (
          <>
            <WeekStrip items={items} activeIdx={activeIdx} onSelect={handleSelect} />
            {!revealed && (
              <div className="loiChuaHome-hint">
                <i className="fas fa-hand-pointer" /> Chọn một ngày để xem Lời Chúa
              </div>
            )}
            {revealed && <DayDetail item={items[activeIdx]} />}
          </>
        )}

        {!loading && !error && items.length === 0 && (
          <div className="loiChuaHome-empty">
            <span>Không có dữ liệu.</span>
            <a href="https://www.vaticannews.va/vi/loi-chua-hang-ngay.html" target="_blank" rel="noopener noreferrer">
              Xem tại Vatican News
            </a>
          </div>
        )}
      </div>

      <div className="loiChuaHome-attribution">
        Nội dung được sử dụng với sự cho phép của{' '}
        <a href="https://www.vaticannews.va/vi.html" target="_blank" rel="noopener noreferrer">
          Vatican News Tiếng Việt
        </a>
        . Xin chân thành cảm ơn.
      </div>
    </div>
  );
}
