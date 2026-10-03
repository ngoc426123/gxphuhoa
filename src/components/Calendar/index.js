import { useEffect, useMemo, useRef, useState } from "react";
import gsap from "gsap";

import { weekdays } from "../../constants/date";

// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";

// STYLE
import "./style.css";

const COLS = 7; // số cột trên desktop (flex-basis 14.285714% ~ 7 cột/hàng)

export default function Calendar(props) {
  // PROPS
  const { month, year, prayData, onClickDay } = props;

  // REF
  const _daysRef = useRef(null);

  // STATE
  const [weekday] = useState(weekdays);
  const listdayData = useMemo(() => {
    let findFirstDay = false;
    let countDay = 0;
    const countDate = new Date(year, month, 0).getDate(); // số ngày thực của tháng hiện tại (new Date(year, month, 0) = ngày cuối của tháng `month`, vì Date dùng tháng 0-index)
    const firstDay = new Date(year, month - 1, 1).getDay();

    return Array.from(Array(35).keys()).map(item => {
      if (!findFirstDay) {
        if (item === firstDay) {
          findFirstDay = true;
        } else {
          return {};
        }
      }

      if (countDay < countDate) {
        countDay++;
        return { day: countDay };
      }

      return {};
    });
  }, [month, year]);
  const onTopData = useMemo(() => {
    return listdayData.map(item => {
      const filterCal = prayData.filter(it => it.day === item.day)[0];

      return { ...item, ...filterCal };
    });
  }, [listdayData, prayData]);

  // SIDE EFFECT
  // Avatar hiện lần lượt từ hàng dưới cùng lên hàng trên cùng mỗi khi có data mới (load lần đầu hoặc đổi tháng)
  useEffect(() => {
    const container = _daysRef.current;

    if (!container) return;

    const cells = container.querySelectorAll('.calendar__day.--need-pray');

    if (!cells.length) return;

    const rows = Array.from(cells).map(cell => Math.floor(Number(cell.dataset.index) / COLS));
    const maxRow = Math.max(...rows);

    const ctx = gsap.context(() => {
      gsap.fromTo(cells,
        { autoAlpha: 0, y: 18, scale: 0.92 },
        {
          autoAlpha: 1,
          y: 0,
          scale: 1,
          duration: 0.5,
          ease: 'power2.out',
          stagger: (i, target) => {
            const row = Math.floor(Number(target.dataset.index) / COLS);

            return (maxRow - row) * 0.12;
          },
        }
      );
    }, container);

    return () => ctx.revert();
  }, [onTopData]);

  // RENDER
  return (
    <div className="calendar">
      <div className="calendar__weekday">
        {weekday.map((wDay, index) => (
          <div key={index} className="calendar__weekday-day">{wDay}</div>
        ))}
      </div>
      <div className="calendar__days" ref={_daysRef}>
        {onTopData && onTopData.map((day, index) => (
          <div
            key={index}
            data-index={index}
            className={`calendar__day ${day.data ? '--need-pray' : ''} ${!day.day ? '--blank' : ''}`}
            {...(day.data
              ? { onClick: () => onClickDay(day.day, month) }
              : {})
            }
          >
            <span className="calendar__day-name">{day?.day || ''}</span>
            {day.data && (
              <div className="calendar__peace-list">
                {day.data.map(item => (
                  <div key={item.positionID} className="calendar__peace-item">
                    <img src={item.img || Unknown_person_img} alt=""/>
                  </div>
                ))}
              </div>
            )}
          </div>
        ))}
      </div>
    </div>
  )
}