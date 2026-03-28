import { useState } from 'react';

export default function SectionAccordion({ section, defaultOpen }) {
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
