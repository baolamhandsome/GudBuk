const deleteButtonList = document.getElementsByClassName("book-remove");

for (let index = 0; index < deleteButtonList.length; index++) {
	const button = deleteButtonList.item(index);
	const cart_book_id = button.dataset.cartbookid;
	button.addEventListener("click", function () {
		fetch(`/gudbuk/cart/remove`, {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body: `cart_book_id=${cart_book_id}`
		})
			.then(res => res.json())
			.then(data => {
				console.log(data);
				this.parentElement.parentElement.remove();
			})
			.catch(err => console.log(err));
	});
}

const decreaseButtonList = document.getElementsByClassName("quantity-decrease");

for (let index = 0; index < decreaseButtonList.length; index++) {
	const button = decreaseButtonList.item(index);
	const cart_book_id = button.dataset.cartbookid;
	button.addEventListener("click", function () {
		const parentDiv = button.parentElement;
		const quantityDiv = parentDiv.querySelector(".quantity-display");
		const quantity = Math.max(parseInt(quantityDiv.textContent) - 1, 1);
		fetch(`/gudbuk/cart/modify`, {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body: `cart_book_id=${cart_book_id}&quantity=${quantity}`
		})
			.then(res => res.json())
			.then(data => {
				console.log(data);
				quantityDiv.textContent = quantity;
			})
			.catch(err => console.log(err));
	});
}

const increaseButtonList = document.getElementsByClassName("quantity-increase");

for (let index = 0; index < increaseButtonList.length; index++) {
	const button = increaseButtonList.item(index);
	const cart_book_id = button.dataset.cartbookid;
	button.addEventListener("click", function () {
		const parentDiv = button.parentElement;
		const quantityDiv = parentDiv.querySelector(".quantity-display");
		const quantity = parseInt(quantityDiv.textContent) + 1;
		fetch(`/gudbuk/cart/modify`, {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body: `cart_book_id=${cart_book_id}&quantity=${quantity}`
		})
			.then(res => res.json())
			.then(data => {
				console.log(data);
				quantityDiv.textContent = quantity;
			})
			.catch(err => console.log(err));
	});
}

const checkboxList = document.getElementsByClassName("book-tick");

for (let index = 0; index < checkboxList.length; index++) {
	const button = checkboxList.item(index);
	const cart_book_id = button.dataset.cartbookid;
	button.addEventListener("change", function () {
		const checked = button.checked ? 1 : 0;
		fetch(`/gudbuk/cart/check`, {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body: `cart_book_id=${cart_book_id}&checked=${checked}`
		})
			.then(res => res.json())
			.then(data => {
				console.log(data);
			})
			.catch(err => console.log(err));
	})
}

const orderButton = document.getElementsByClassName("order-button")[0];

const userid = orderButton.dataset.userid;

orderButton.addEventListener("click", function () {
	if (userid != "") {
		window.location.href = `orderPreview?userid=${userid}`;
	}
})
