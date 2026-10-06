import { useEffect, useMemo, useRef, useState } from "react";
import Modal from 'react-modal';
import PraySlider from '../../components/PraySlider';

// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";
import Close_icon from '../../assets/images/close.svg';

// STYLE
import "./style.css";

const SEARCH_THROTTLE = 300;

// Bỏ dấu tiếng Việt để gõ "nguyen" vẫn tìm được "Nguyễn"
const normalize = (text) => (text || '')
  .normalize('NFD')
  .replace(/[\u0300-\u036f]/g, '')
  .replace(/đ/gi, 'd')
  .toLowerCase()
  .trim();

export default function ScreenShelf() {
  const _shelf = useRef(null);
  const _throttle = useRef({ last: 0, timer: null });
  const _drag = useRef({ active: false, moved: false, x: 0, left: 0 });

  // STATE
  const [shelfSize] = useState([
    {
      shelfName: 'A',
      desc: '(kệ sát tường bên trái)',
      row: 12,
      number: 10,
    },
    {
      shelfName: 'B',
      desc: '(kệ chính diện)',
      row: 12,
      number: 25,
    },
    {
      shelfName: 'C',
      desc: '(kệ sát tường bên phải)',
      row: 12,
      number: 10,
    },
  ]);
  const [prayData, setPrayData] = useState([]);
  const [openModal, setOpenModal] = useState(false);
  const [praySliderData, setPraySliderData] = useState([]);
  const [keyword, setKeyword] = useState('');
  const matchedIDs = useMemo(() => {
    const search = normalize(keyword);

    if (!search) return null;

    return new Set(prayData.filter(pray => normalize(pray.name).includes(search)).map(pray => pray.ID));
  }, [keyword, prayData]);

  // METHOD
  const getPrayForUs = async () => {
    try {
      const apiUrl = (window.PRAY_FOR_US?.api || process.env.REACT_APP_API) + '/getall';
      const options = {
        method: 'GET'
      }
      const response = await fetch(apiUrl, options);
      const data = await response.json();

      setPrayData(data);
    } catch (error) {
      console.error(error);
    }
  }

  const onClickPray = (ID) => {
    setPraySliderData(() => prayData.filter(item => item.ID === ID));
    setOpenModal(true);
  }

  // Throttle: cập nhật tối đa 1 lần / SEARCH_THROTTLE ms, lần gõ cuối luôn được áp dụng
  const onChangeSearch = (event) => {
    const { value } = event.target;
    const throttle = _throttle.current;
    const wait = Math.max(SEARCH_THROTTLE - (Date.now() - throttle.last), 0);

    clearTimeout(throttle.timer);
    throttle.timer = setTimeout(() => {
      throttle.last = Date.now();
      setKeyword(value);
    }, wait);
  };

  // Giữ chuột kéo ngang kệ (cảm ứng đã tự cuộn được nên chỉ xử lý chuột)
  const onMouseDownShelf = (event) => {
    if (event.button !== 0) return;

    _drag.current = { active: true, moved: false, x: event.pageX, left: _shelf.current.scrollLeft };
  };

  const onMouseMoveShelf = (event) => {
    const drag = _drag.current;

    if (!drag.active) return;

    const dx = event.pageX - drag.x;

    if (Math.abs(dx) > 5 && !drag.moved) {
      drag.moved = true;
      _shelf.current.classList.add('--dragging');
    }
    if (drag.moved) _shelf.current.scrollLeft = drag.left - dx;
  };

  const onMouseUpShelf = () => {
    _drag.current.active = false;
    _shelf.current.classList.remove('--dragging');
  };

  // Vừa kéo xong thì không tính là click mở modal
  const onClickCaptureShelf = (event) => {
    if (!_drag.current.moved) return;

    _drag.current.moved = false;
    event.stopPropagation();
  };

  const handleEventClosePopup = () => {
    setOpenModal(false);
    setPraySliderData([])
  };

  // SIDE EFFECT
  useEffect(() => {
    getPrayForUs();
    const $ele = _shelf.current;

    if (!$ele) return;

    const width = $ele.clientWidth;
    const scrollWidth = $ele.scrollWidth;
    const defaultScroll = (scrollWidth - width) / 2;

    $ele.scroll({ left: defaultScroll })
  }, []);

  useEffect(() => {
    const throttle = _throttle.current;

    return () => clearTimeout(throttle.timer);
  }, []);

  // Kệ cuộn ngang: đưa ô tìm thấy đầu tiên vào tầm nhìn
  useEffect(() => {
    _shelf.current?.querySelector('.--matched')?.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
  }, [matchedIDs]);

  // RENDER
  return (
    <>
      <div className="screen-shelf-search">
        <input
          type="search"
          className="screen-shelf-search__input"
          placeholder="Tìm theo họ tên người đã mất..."
          aria-label="Tìm theo họ tên người đã mất"
          onChange={onChangeSearch}
        />
        {matchedIDs && (
          <div className="screen-shelf-search__result" aria-live="polite">
            {matchedIDs.size ? `Tìm thấy ${matchedIDs.size} người` : 'Không tìm thấy người nào'}
          </div>
        )}
      </div>
      <div className={`screen-shelf ${matchedIDs ? '--searching' : ''}`} 
        ref={_shelf}
        onMouseDown={onMouseDownShelf}
        onMouseMove={onMouseMoveShelf}
        onMouseUp={onMouseUpShelf}
        onMouseLeave={onMouseUpShelf}
        onClickCapture={onClickCaptureShelf}
        onDragStart={(event) => event.preventDefault()}
      >
        {shelfSize.map((shelf) => (
          <div key={shelf.shelfName} className="screen-shelf__shelf">
            <div className="screen-shelf__shelf-head">
              <div className="screen-shelf__shelf-title">Kệ {shelf.shelfName}</div>
              <div className="screen-shelf__shelf-sub-title">{shelf.desc}</div>
            </div>
            <div className="screen-shelf__shelf-body">
              {[...Array(shelf.row)].map((_, rowIndex) => (
                <div key={`row-${rowIndex}`} className="screen-shelf__shelf-row">
                  {[...Array(shelf.number)].map((_, numberIndex) => {
                    const findPray = prayData.filter(pray => 
                      pray.shelf === shelf.shelfName && +pray.row === (rowIndex + 1) && +pray.number === (numberIndex + 1)
                    )[0];

                    return (
                      <div
                        key={`number-${numberIndex}`}
                        className={`screen-shelf__shelf-cell ${findPray ? '--has-pray' : ''} ${findPray && matchedIDs?.has(findPray.ID) ? '--matched' : ''}`}
                        {...(findPray ? { title: findPray.name } : {})}
                        data-position={`${rowIndex + 1}|${numberIndex + 1}`}
                        {...(findPray 
                          ? { onClick: () => onClickPray(findPray.ID) } 
                          : {})
                        }
                      >
                        {findPray && <img src={findPray.img || Unknown_person_img} alt=""/>}
                      </div>
                    )
                  })}
                </div>
              ))}
            </div>
          </div>
        ))}
      </div>
      <Modal
        isOpen={openModal}
        className='houdini-modal'
        overlayClassName='houdini-modal-overlay'
      >
        <button className='houdini-modal-close' onClick={handleEventClosePopup}>
          <img src={Close_icon} alt=''/>
        </button>
        <PraySlider data={praySliderData} />
      </Modal>
    </>
  )
}