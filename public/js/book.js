const addCartButton = document.getElementsByClassName("add-cart-btn")[0];

const bookid = addCartButton.dataset.bookid;

addCartButton.addEventListener("click", () => {
	fetch(`/gudbuk/user`, {
		method: 'GET',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	})
		.then(res => res.json())
		.then(data => {
			fetch(`/gudbuk/cart/add`, {
				method: 'POST',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				body: `bookid=${bookid}&userid=${data}`
			})
				.then(res => res.json())
				.then(data => {
					alert("Đã thêm vào thành công!");
				})
				.catch(err => console.log(err));
		})
		.catch(err => console.log(err));

});
