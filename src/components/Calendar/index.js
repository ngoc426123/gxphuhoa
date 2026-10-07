import { useMemo, useState } from "react";

import { weekdays } from "../../constants/date";
import CandleIcon from "../CandleIcon";

// STYLE
import "./style.css";

const COLS = 7; // 7 ngày/tuần, lưới bắt đầu từ Chúa Nhật

export default function Calendar(props) {
  // PROPS
  const { month, year, prayData, onClickDay } = props;

  // STATE
  const [weekday] = useState(weekdays);
  const today = useMemo(() => new Date(), []);
  const listdayData = useMemo(() => {
    let findFirstDay = false;
    let countDay = 0;
    const countDate = new Date(year, month, 0).getDate(); // số ngày thực của tháng hiện tại (new Date(year, month, 0) = ngày cuối của tháng `month`, vì Date dùng tháng 0-index)
    const firstDay = new Date(year, month - 1, 1).getDay();

    const cellCount = Math.ceil((firstDay + countDate) / COLS) * COLS; // 5 hoặc 6 hàng, tháng bắt đầu T6/T7 cần 6 hàng

    return Array.from(Array(cellCount).keys()).map(item => {
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

  // RENDER
  return (
    <div className="calendar">
      <div className="calendar__weekday">
        {weekday.map((wDay, index) => (
          <div key={index} className="calendar__weekday-day">{wDay}</div>
        ))}
      </div>
      <div className="calendar__days">
        {onTopData && onTopData.map((day, index) => {
          const isToday = day.day === today.getDate() && month === today.getMonth() + 1 && year === today.getFullYear();

          return (
          <div
            key={index}
            className={`calendar__day ${day.data ? '--need-pray' : ''} ${!day.day ? '--blank' : ''} ${isToday ? '--today' : ''}`}
            {...(isToday ? { 'aria-current': 'date' } : {})}
            {...(day.data
              ? {
                // Cho phép mở bằng bàn phím: Tab tới ô, Enter / Space để mở
                role: 'button',
                tabIndex: 0,
                'aria-label': `Ngày ${day.day}: ${day.data.length} linh hồn được cầu nguyện`,
                onClick: () => onClickDay(day.day, month),
                onKeyDown: (event) => {
                  if (event.key !== 'Enter' && event.key !== ' ') return;

                  event.preventDefault();
                  onClickDay(day.day, month);
                },
              }
              : {})
            }
          >
            <span className="calendar__day-name">
              {day?.day || ''}
              {/* Thứ trong tuần: chỉ hiện trên mobile (hàng tiêu đề thứ bị ẩn) */}
              {day.day && <span className="calendar__day-weekday"> · {weekday[index % COLS]}</span>}
            </span>
            {isToday && <span className="calendar__today-label">Hôm nay</span>}
            {day.data && (
              <div className="calendar__pray-badge" aria-hidden="true">
                <CandleIcon width={12} height={16} className="calendar__pray-flame" />
                <span className="calendar__pray-count">{day.data.length}</span>
              </div>
            )}
          </div>
          );
        })}
      </div>
    </div>
  )
}