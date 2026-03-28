import { itemDate, ddmm, DAY_ABBR } from '../utils/dateUtils';
import { extractAudio } from '../utils/rssParser';

export default function WeekStrip({ items, activeIdx, onSelect }) {
  const todayStr = new Date().toDateString();

  return (
    <div className="loiChuaHome-week">
      {items.map((item, idx) => {
        const date     = itemDate(item);
        const isToday  = date.toDateString() === todayStr;
        const hasAudio = !!extractAudio(item);
        const dow = date.getDay();
        const cls = [
          'loiChuaHome-day',
          activeIdx === idx ? 'is-active' : '',
          isToday ? 'is-today' : '',
          dow === 0 ? 'is-sunday' : dow === 6 ? 'is-saturday' : '',
        ].filter(Boolean).join(' ');
        return (
          <button key={item.guid || idx} className={cls} title={item.title}
            onClick={() => onSelect(idx)}>
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
  );
}
