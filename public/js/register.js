/*
+ async để chờ fetch
+ preventDefault ngăn refresh khi submit mà gửi AJAX req
+ Sau đó fetch tới url sao cho khớp với router + api đã cài sẵn
*/
document.getElementById('registerForm').addEventListener('submit', async (e) => {

    e.preventDefault();

    const email = document.getElementById('email').value;
    const fullname = document.getElementById('name').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;
    // const address = document.getElementById('address').value;
    const password_confirm = document.getElementById('password_confirm').value;

    // Tạo một REQ gửi bẳng AJAX
    const response = await fetch('/gudbuk/register', {
        method: 'POST',
        body: new FormData(document.getElementById('registerForm'))
    });

    const data = await response.json();

    if (data.success) {
        window.location.href = 'http://localhost/gudbuk/login';
    } else {
        alert(data.message);
    }



}); 