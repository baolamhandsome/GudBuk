const cart = document.getElementById("cart-btn").parentElement;

cart.addEventListener("click", () => {
	fetch(`/gudbuk/user`, {
		method: 'GET',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	})
	.then(res => res.json())
	.then(data => {
		window.location.href = `cart?userid=${data}`
	})
	.catch(err => console.log(err));
});

const order = document.getElementById("order-btn").parentElement;

order.addEventListener("click", () => {
	fetch(`/gudbuk/user`, {
		method: 'GET',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	})
	.then(res => res.json())
	.then(data => {
		window.location.href = `orderList?userid=${data}`
	})
	.catch(err => console.log(err));
});

