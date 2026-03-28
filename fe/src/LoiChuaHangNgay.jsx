import { useState, useEffect, useRef, useCallback } from 'react';
import './LoiChua.css';

const RSS_URL =
  'https://api.rss2json.com/v1/api.json?rss_url=https://www.vaticannews.va/vi/loi-chua-hang-ngay.rss.xml';

// ── helpers ──────────────────────────────────────────────────────────────────

function fmtTime(seconds) {
  if (!isFinite(seconds) || seconds < 0) return '0:00';
  const m = Math.floor(seconds / 60);
  const s = Math.floor(seconds % 60).toString().padStart(2, '0');
  return `${m}:${s}`;
}

function itemDate(item) {
  // Parse actual liturgical date from title: "...ngày D tháng M YYYY"
  // This avoids timezone shifts from pubDate (which is the RSS publish timestamp).
  if (item.title) {
    const m = item.title.match(/ngày (\d+) tháng (\d+) (\d{4})/);
    if (m) return new Date(parseInt(m[3]), parseInt(m[2]) - 1, parseInt(m[1]));
  }
  return new Date(item.pubDate);
}

function ddmm(date) {
  return `${String(date.getDate()).padStart(2, '0')}/${String(date.getMonth() + 1).padStart(2, '0')}`;
}

const DAY_ABBR = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
const DAY_FULL = ['Chúa nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];

function fullDateLabel(date) {
  return `${DAY_FULL[date.getDay()]}, ${date.getDate()} tháng ${date.getMonth() + 1}, ${date.getFullYear()}`;
}

function extractAudio(item) {
  if (item.enclosure && item.enclosure.link) return item.enclosure.link;
  return null;
}

// ── Description parser ────────────────────────────────────────────────────────

/**
 * Parse the Vatican News RSS description HTML into structured sections.
 * Sections are identified by bold <b> headings that match known liturgical labels.
 */
function parseSections(html) {
  if (!html) return [];

  const div = document.createElement('div');
  div.innerHTML = html;

  const READING_RE  = /^bài đọc/i;
  const PSALM_RE    = /^đáp ca/i;
  const ALLELUIA_RE = /^tung hô/i;
  const GOSPEL_RE   = /✠|^tin mừng chúa/i;

  function detectType(text) {
    if (PSALM_RE.test(text))    return 'psalm';
    if (ALLELUIA_RE.test(text)) return 'alleluia';
    if (GOSPEL_RE.test(text))   return 'gospel';
    if (READING_RE.test(text))  return 'reading';
    return null;
  }

  const ICON = { reading: '📖', psalm: '♩', alleluia: '🎵', gospel: '✠' };

  const sections = [];
  let current = null;

  for (const el of Array.from(div.children)) {
    // Skip feedback/form paragraphs
    if (/góp ý|link form|forms\.gle/i.test(el.textContent)) continue;

    const bEl = el.querySelector('b');
    const bText = bEl ? bEl.textContent.replace(/\s+/g, ' ').trim() : '';
    const type = detectType(bText);

    if (type) {
      if (current) sections.push(current);
      // Reference text = paragraph text minus the bold part
      const ref = el.textContent.replace(bEl.textContent, '').replace(/\s+/g, ' ').trim();
      current = { type, icon: ICON[type], title: bText, reference: ref, contentHtml: '', summary: '' };
    } else if (current) {
      current.contentHtml += el.outerHTML;
    }
  }
  if (current) sections.push(current);

  // Extract summary: first standalone <i> paragraph in reading/psalm/gospel sections
  sections.forEach(s => {
    const d = document.createElement('div');
    d.innerHTML = s.contentHtml;
    const firstP = d.querySelector('p');
    if (firstP) {
      const italic = firstP.querySelector('i, em');
      // Use italic if it's most of the paragraph's text
      if (italic && italic.textContent.trim().length > 10) {
        s.summary = italic.textContent.trim();
      }
    }
  });

  return sections;
}

// ── Section accordion ─────────────────────────────────────────────────────────

function SectionAccordion({ section, defaultOpen }) {
  const [open, setOpen] = useState(!!defaultOpen);

  return (
    <div className={`loiChuaSection loiChuaSection--${section.type}${open ? ' is-open' : ''}`}>
      <button
        className="loiChuaSection-head"
        onClick={() => setOpen(v => !v)}
        aria-expanded={open}
      >
        <span className="loiChuaSection-icon">{section.icon}</span>
        <span className="loiChuaSection-info">
          <span className="loiChuaSection-title">{section.title}</span>
          {section.reference && (
            <span className="loiChuaSection-ref">{section.reference}</span>
          )}
          {!open && section.summary && (
            <span className="loiChuaSection-summary">{section.summary}</span>
          )}
        </span>
        <i className={`fas fa-chevron-${open ? 'up' : 'down'} loiChuaSection-chevron`} />
      </button>
      {open && (
        <div
          className="loiChuaSection-body"
          /* Content is from Vatican News RSS — server-rendered HTML with
             only text markup tags (<p>,<b>,<i>,<br>,<sup>). No scripts. */
          dangerouslySetInnerHTML={{ __html: section.contentHtml }}
        />
      )}
    </div>
  );
}

// ── Audio Player ──────────────────────────────────────────────────────────────

function AudioPlayer({ src }) {
  const audioRef = useRef(null);
  const [playing, setPlaying] = useState(false);
  const [current, setCurrent] = useState(0);
  const [duration, setDuration] = useState(0);

  useEffect(() => { setPlaying(false); setCurrent(0); setDuration(0); }, [src]);

  const togglePlay = useCallback(() => {
    const audio = audioRef.current;
    if (!audio) return;
    if (playing) { audio.pause(); setPlaying(false); }
    else { audio.play().catch(() => {}); setPlaying(true); }
  }, [playing]);

  const onTimeUpdate   = useCallback(() => { if (audioRef.current) setCurrent(audioRef.current.currentTime); }, []);
  const onLoadedMeta   = useCallback(() => { if (audioRef.current) setDuration(audioRef.current.duration); }, []);
  const onEnded        = useCallback(() => setPlaying(false), []);

  const onRange = useCallback((e) => {
    const audio = audioRef.current;
    if (!audio || !duration) return;
    audio.currentTime = (parseFloat(e.target.value) / 100) * duration;
    setCurrent(audio.currentTime);
  }, [duration]);

  const fillPct = duration > 0 ? (current / duration) * 100 : 0;

  return (
    <div className="loiChuaHome-player">
      {/* eslint-disable-next-line jsx-a11y/media-has-caption */}
      <audio ref={audioRef} preload="none" src={src}
        onTimeUpdate={onTimeUpdate} onLoadedMetadata={onLoadedMeta} onEnded={onEnded} />
      <button className="loiChuaHome-player-btn" onClick={togglePlay} aria-label="Phát/Dừng">
        <i className={playing ? 'fas fa-pause' : 'fas fa-play'} />
      </button>
      <div className="loiChuaHome-player-track">
        <div className="loiChuaHome-player-bar">
          <div className="loiChuaHome-player-fill" style={{ width: `${fillPct}%` }} />
        </div>
        <input type="range" className="loiChuaHome-player-range"
          min="0" max="100" step="0.1" value={fillPct}
          onChange={onRange} aria-label="Thanh thời gian" />
      </div>
      <span className="loiChuaHome-player-time">{fmtTime(current)}</span>
      <span className="loiChuaHome-player-total">&nbsp;/ {duration > 0 ? fmtTime(duration) : '--:--'}</span>
    </div>
  );
}

// ── Day detail panel ──────────────────────────────────────────────────────────

function DayDetail({ item }) {
  if (!item) return null;
  const date     = itemDate(item);
  const audioSrc = extractAudio(item);
  const sections = parseSections(item.description || item.content);

  const y = date.getFullYear();
  const m = String(date.getMonth() + 1).padStart(2, '0');
  const d = String(date.getDate()).padStart(2, '0');
  const ctaHref = `https://www.vaticannews.va/vi/loi-chua-hang-ngay/${y}/${m}/${d}.html`;

  return (
    <div className="loiChuaHome-detail">
      <div className="loiChuaHome-detail-top">
        <p className="loiChuaHome-liturgy">{item.title}</p>
        <p className="loiChuaHome-date-label">{fullDateLabel(date)}</p>
      </div>

      {sections.length > 0 && (
        <div className="loiChuaHome-sections">
          {sections.map((s, i) => (
            <SectionAccordion
              key={i}
              section={s}
              defaultOpen={s.type === 'gospel'}
            />
          ))}
        </div>
      )}

      {audioSrc && <AudioPlayer src={audioSrc} />}

      <a className="loiChuaHome-cta" href={ctaHref} target="_blank" rel="noopener noreferrer">
        Đọc bài đọc đầy đủ&nbsp;<i className="fas fa-external-link-alt" />
      </a>
    </div>
  );
}

// ── Main component ────────────────────────────────────────────────────────────

export default function LoiChuaHangNgay() {
  const [items, setItems]       = useState([]);
  const [loading, setLoading]   = useState(true);
  const [error, setError]       = useState(null);
  const [activeIdx, setActiveIdx] = useState(0);
  const [revealed, setRevealed] = useState(false);

  useEffect(() => {
    let cancelled = false;
    setLoading(true); setError(null);

    fetch(RSS_URL)
      .then(r => { if (!r.ok) throw new Error(`HTTP ${r.status}`); return r.json(); })
      .then(data => {
        if (cancelled) return;
        if (data.status !== 'ok') throw new Error('RSS feed error: ' + (data.message || 'unknown'));
        const all = (data.items || []).slice(0, 7)
          .sort((a, b) => {
            const ta = itemDate(a).getTime();
            const tb = itemDate(b).getTime();
            if (isNaN(ta) || isNaN(tb)) return 0;
            return ta - tb; // oldest → newest, always
          });
        setItems(all);
        const todayStr = new Date().toDateString();
        const idx = all.findIndex(it => itemDate(it).toDateString() === todayStr);
        setActiveIdx(idx >= 0 ? idx : 0);
        setLoading(false);
      })
      .catch(err => { if (!cancelled) { setError(err.message || 'Không thể tải dữ liệu'); setLoading(false); } });

    return () => { cancelled = true; };
  }, []);

  const todayStr = new Date().toDateString();

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
            <div className="loiChuaHome-week">
              {items.map((item, idx) => {
                const date    = itemDate(item);
                const isToday = date.toDateString() === todayStr;
                const hasAudio = !!extractAudio(item);
                const cls = ['loiChuaHome-day', activeIdx === idx ? 'is-active' : '', isToday ? 'is-today' : '']
                  .filter(Boolean).join(' ');
                return (
                  <button key={item.guid || idx} className={cls} title={item.title}
                    onClick={() => { setActiveIdx(idx); setRevealed(true); }}>
                    <span className="loiChuaHome-day-name">{DAY_ABBR[date.getDay()]}</span>
                    <span className="loiChuaHome-day-date">{ddmm(date)}</span>
                    <span className={`loiChuaHome-day-audio${hasAudio ? '' : ' is-empty'}`}>
                      {hasAudio ? <i className="fas fa-headphones" /> : '-'}
                    </span>
                    <span className="loiChuaHome-day-dot" />
                  </button>
                );
              })}
            </div>
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
    </div>
  );
}

