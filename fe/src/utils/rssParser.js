export const RSS_URL =
  'https://api.rss2json.com/v1/api.json?rss_url=https://www.vaticannews.va/vi/loi-chua-hang-ngay.rss.xml';

export function extractAudio(item) {
  if (item.enclosure && item.enclosure.link) return item.enclosure.link;
  return null;
}

/**
 * Parse the Vatican News RSS description HTML into structured sections.
 * Sections are identified by bold <b> headings that match known liturgical labels.
 */
export function parseSections(html) {
  if (!html) return { sections: [], preambleHtml: '' };

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
  const preamble = [];
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
    } else {
      // Collect preamble paragraphs that appear before the first section heading
      if (el.textContent.replace(/[\s\u00a0]/g, '').length > 0) {
        preamble.push(el.outerHTML);
      }
    }
  }
  if (current) sections.push(current);

  // Extract summary: first <i>/<em> in the first paragraph of each section
  sections.forEach(s => {
    const d = document.createElement('div');
    d.innerHTML = s.contentHtml;
    const firstP = d.querySelector('p');
    if (firstP) {
      const italic = firstP.querySelector('i, em');
      if (italic && italic.textContent.trim().length > 10) {
        s.summary = italic.textContent.trim();
      }
    }
  });

  return { sections, preambleHtml: preamble.join('') };
}
