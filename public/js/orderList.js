const orderButton = document.getElementsByClassName("order-container");
console.log(orderButton);

for (var index = 0; index < orderButton.length; index++) {
	const button = orderButton.item(index);
	const orderid = button.dataset.orderid;
	button.addEventListener("click", () => {
		window.location.href = `orderView?orderid=${orderid}`;
	});
}
