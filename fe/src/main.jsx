import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import LoiChuaHangNgay from './LoiChuaHangNgay.jsx'

/**
 * Mount React on every [gxphuhoa-vaitcan-daily-gospel] shortcode container.
 * WordPress shortcode renders: <div id="gxphuhoa-daily-gospel-root"></div>
 * Multiple instances on the same page are supported.
 */
function mountAll() {
  const containers = document.querySelectorAll('.gxphuhoa-daily-gospel-root')
  containers.forEach((el) => {
    createRoot(el).render(
      <StrictMode>
        <LoiChuaHangNgay />
      </StrictMode>
    )
  })
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', mountAll)
} else {
  mountAll()
}

