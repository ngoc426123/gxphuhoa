import { useState, useEffect, useRef, useCallback } from 'react';
import { fmtTime } from '../utils/dateUtils';

export default function AudioPlayer({ src }) {
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

  const onTimeUpdate = useCallback(() => {
    if (audioRef.current) setCurrent(audioRef.current.currentTime);
  }, []);
  const onLoadedMeta = useCallback(() => {
    if (audioRef.current) setDuration(audioRef.current.duration);
  }, []);
  const onEnded = useCallback(() => setPlaying(false), []);

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
