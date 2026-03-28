import { itemDate, fullDateLabel } from '../utils/dateUtils';
import { extractAudio, parseSections } from '../utils/rssParser';
import SectionAccordion from './SectionAccordion';
import AudioPlayer from './AudioPlayer';

export default function DayDetail({ item }) {
  if (!item) return null;
  const date     = itemDate(item);
  const audioSrc = extractAudio(item);
  const rawHtml  = item.description || item.content || '';
  const { sections, preambleHtml } = parseSections(rawHtml);

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

      {preambleHtml && (
        <div className="loiChuaHome-preamble" dangerouslySetInnerHTML={{ __html: preambleHtml }} />
      )}

      {sections.length > 0 ? (
        <div className="loiChuaHome-sections">
          {sections.map((s, i) => (
            <SectionAccordion
              key={i}
              section={s}
              defaultOpen={s.type === 'gospel'}
            />
          ))}
        </div>
      ) : rawHtml ? (
        /* Fallback: Vatican News changed their HTML format — show raw content */
        <div
          className="loiChuaHome-raw"
          dangerouslySetInnerHTML={{ __html: rawHtml }}
        />
      ) : null}

      {audioSrc && <AudioPlayer src={audioSrc} />}

      <a className="loiChuaHome-cta" href={ctaHref} target="_blank" rel="noopener noreferrer">
        Đọc bài đọc đầy đủ&nbsp;<i className="fas fa-external-link-alt" />
      </a>
    </div>
  );
}
