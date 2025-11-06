document.addEventListener('DOMContentLoaded', () => {
	document.getElementById('imageInput').addEventListener('change', function(event) {
		const file = event.target.files[0]; // 1枚だけ扱う場合
		if (!file) return;

		const formData = new FormData();
		formData.append('image', file);

		fetch("/images/temp", {
			method: 'POST',
			headers: {
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			},
			body: formData
		})
		.then(res => res.json())
		.then(data => {
			// プレビュー表示など
		});
	});
});