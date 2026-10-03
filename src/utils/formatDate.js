// 'YYYY-MM-DD HH:mm:ss' -> 'DD/MM/YYYY'
export const formatDate = (value) => {
  const [year, month, day] = (value || '').slice(0, 10).split('-');
  return day ? `${day}/${month}/${year}` : '';
};
