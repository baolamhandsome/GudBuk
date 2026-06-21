document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.form-grid');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value;

        if (!name || !email || phone === '') {
            alert('Vui lòng điền đầy đủ các trường bắt buộc (*).');
            return;
        }

        const formData = new FormData(form);


        // Xoá các message cũ trước mỗi lần submit
        flash = document.getElementById('flash-message');

        flash.textContent = '';
        flash.className = '';
        flash.style.display = 'none';

        document.getElementById('name-error').textContent = '';
        document.getElementById('email-error').textContent = '';
        document.getElementById('phone-error').textContent = '';

        // Thay đổi URL này thành đúng Route xử lý Update trong backend của bạn
        const response = await fetch('/gudbuk/profile', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Lỗi kết nối đến máy chủ: ' + response.status);
        }

        const data = await response.json();
        flash = document.getElementById('flash-message');

        if (data.success) {
            flash.style.display = 'block';
            flash.className = 'alert alert-success';
            flash.textContent = data.message;
        } else {
            if (data.errors.name) {
                document.getElementById('name-error').textContent = data.errors.name;
            }

            if (data.errors.email) {
                document.getElementById('email-error').textContent = data.errors.email;
            }

            if (data.errors.phone) {
                document.getElementById('phone-error').textContent = data.errors.phone;
            }
        }
    });
});