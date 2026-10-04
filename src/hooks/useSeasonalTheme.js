import { useEffect, useMemo } from 'react';

const SOULS_MONTH_INDEX = 10; // Date.getMonth() 0-index: 10 = Tháng Mười Một

export default function useSeasonalTheme() {
  const isSoulsMonth = useMemo(() => new Date().getMonth() === SOULS_MONTH_INDEX, []);

  useEffect(() => {
    if (!isSoulsMonth) return;

    document.body.classList.add('pfu-theme-souls-month');

    return () => document.body.classList.remove('pfu-theme-souls-month');
  }, [isSoulsMonth]);

  return { isSoulsMonth };
}
