const orderButton = document.getElementsByClassName("order-button")[0];

const userid = orderButton.dataset.userid;

const addressInput = document.getElementsByClassName("address-input")[0];

orderButton.addEventListener("click", function () {
	const address = addressInput.value;
	if (address == "") return;
	fetch("/gudbuk/placeOrder", {
		method: "POST",
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
		body: `userid=${userid}&address=${address}`
	})
		.then(res => res.json())
		.then(data => {
			console.log(data);
			window.location.href = `orderView?orderid=${data}`
		})
		.catch(err => console.log(err));
})
