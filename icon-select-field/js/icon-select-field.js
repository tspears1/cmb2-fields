const dialogs = document.querySelectorAll('[data-icon-select]');
dialogs.forEach((dialog) => {
	const dialogId = dialog.getAttribute('data-icon-select');
	const dialogClose = document.querySelector(
		`[data-icon-select-close="${dialogId}"]`
	);
	const dialogSubmit = document.querySelector(
		`[data-icon-select-submit="${dialogId}"]`
	);
	const dialogTrigger = document.querySelector(
		`[data-icon-select-trigger="${dialogId}"]`
	);
	const dialogInput = document.querySelector(
		`[data-icon-select-input="${dialogId}"]`
	);

	const radios = dialog.querySelectorAll('input[type="radio"]');

	const findSelectedValue = () => {
		for (const radio of [...radios]) {
			if (radio.checked) {
				return radio.value;
			}
		}
	};

	dialogClose.addEventListener('click', (event) => {
		event.preventDefault();
		dialog.close();
	});

	dialogTrigger.addEventListener('click', (event) => {
		event.preventDefault();
		dialog.showModal();
	});

	dialogSubmit.addEventListener('click', (event) => {
		event.preventDefault();
		dialog.close();
		dialogInput.value = findSelectedValue();
	});
});
