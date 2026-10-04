import { useRef } from 'react';

// Giữ chuột kéo ngang danh sách (cảm ứng đã tự cuộn được nên chỉ xử lý chuột)
export default function useDragScroll() {
  const trackRef = useRef(null);
  const drag = useRef({ active: false, moved: false, x: 0, left: 0 });

  const onMouseDown = (event) => {
    if (event.button !== 0) return;

    drag.current = { active: true, moved: false, x: event.pageX, left: trackRef.current.scrollLeft };
  };

  const onMouseMove = (event) => {
    if (!drag.current.active) return;

    const dx = event.pageX - drag.current.x;

    if (Math.abs(dx) > 5 && !drag.current.moved) {
      drag.current.moved = true;
      trackRef.current.classList.add('--dragging');
    }
    if (drag.current.moved) trackRef.current.scrollLeft = drag.current.left - dx;
  };

  const onMouseUp = () => {
    drag.current.active = false;
    trackRef.current.classList.remove('--dragging');
  };

  return { trackRef, onMouseDown, onMouseMove, onMouseUp };
}
