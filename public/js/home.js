const deleteButtonList = document.getElementsByClassName("book-card");

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