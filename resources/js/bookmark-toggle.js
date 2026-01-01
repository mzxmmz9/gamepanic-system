document.querySelectorAll('.bookmark-toggle').forEach(button => {
	button.addEventListener('click', async (e) => {
		e.preventDefault();

		const clicked = e.currentTarget;
		const postId = clicked.dataset.postId;
		const isBookmarked = clicked.dataset.bookmarked === 'true';

		const response = await fetch(`/bookmarks/toggle/${postId}`, {
			method: 'POST',
			headers: {
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
				'Accept': 'application/json',
			},
		});

		if (response.ok) {
			clicked.dataset.bookmarked = (!isBookmarked).toString();
			clicked.textContent = !isBookmarked ? 'ブックマーク解除' : 'ブックマーク';
		} else {
			alert('通信エラーが発生しました');
		}
	});
});