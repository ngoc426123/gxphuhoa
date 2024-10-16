jQuery('document').ready(() => {
	const now = new Date();
	const yearEnd = now.getFullYear();
	const yearStart = 1790;

  jQuery('#pray-for-us-yearofbirth')
    .add('#pray-for-us-yearofdead')
    .datetimepicker({
			yearStart,
			yearEnd,
      timepicker: false,
      format: 'd/m/Y',
    });

  const $ID = jQuery('#pray-for-us-ID');
  const $shelf = jQuery('#pray-for-us-shelf');
  const $row = jQuery('#pray-for-us-row');
  const $number = jQuery('#pray-for-us-number');
  
	$shelf
		.add($row)
		.add($number)
		.off('change.PrayForUs')
		.on('change.PrayForUs', () => {
			const ID = getIDFromData();

			$ID.val(ID);
		});

	function getIDFromData() {
		const shelfValue = $shelf.val();
		const rowValue = $row.val();
		const numberValue = $number.val();

		return `${shelfValue}${paddingNumber(rowValue, 2)}${paddingNumber(numberValue, 3)}`;
	}

	function paddingNumber(number, count) {
		let num = number.toString();

		while (num.length < count) num = 0 + num;

		return num;
	}
});