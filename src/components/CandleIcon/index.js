// Biểu tượng ngọn nến dùng chung: header, badge lịch, empty-state
export default function CandleIcon(props) {
  const { width = 14, height = 20, ...rest } = props;

  return (
    <svg viewBox="0 0 24 32" width={width} height={height} aria-hidden="true" {...rest}>
      <path
        d="M12 2c3 4-2 6-2 10a4 4 0 0 0 8 0c0-2-1-3-1-3s2 2 2 6a7 7 0 1 1-14 0c0-6 5-8 7-13z"
        fill="currentColor"
      />
      <rect x="10" y="22" width="4" height="8" rx="1" fill="currentColor" opacity="0.6" />
    </svg>
  );
}
