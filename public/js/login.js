/*
+ async để chờ fetch
+ preventDefault ngăn refresh khi submit mà gửi AJAX req
+ Sau đó fetch tới url sao cho khớp với router + api đã cài sẵn
*/
document.getElementById('loginForm').addEventListener('submit', async (e) => {

    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const response = await fetch('/gudbuk/login', {
        method: 'POST',
        body: new FormData(document.getElementById('loginForm'))
    });

    const data = await response.json();
    if (data.success) {
        if (data.isAdmin) {
            window.location.href = 'http://localhost/gudbuk/admin-dashboard';
        }
        else {
            window.location.href = 'http://localhost/gudbuk/home';
        }
    } else {
        alert(data.message);
    }
});