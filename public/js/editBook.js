document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.edit-form');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const title = document.getElementById('bookTitle').value.trim();
        const author = document.getElementById('bookAuthor').value.trim();
        const price = document.getElementById('bookPrice').value;
        const quantity = document.getElementById('bookQuantity').value;

        if (!title || !author || price === '' || quantity === '') {
            alert('Vui lòng điền đầy đủ các trường bắt buộc (*).');
            return;
        }

        const formData = new FormData(form);

        // Thay đổi URL này thành đúng Route xử lý Update trong backend của bạn
        const response = await fetch('edit', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Lỗi kết nối đến máy chủ: ' + response.status);
        }

        const data = await response.json();
        bookid = data.bookid
        if (data.success) {
            alert('Cập nhật thông tin sách thành công!');
            // Chuyển hướng Admin về lại trang danh sách cửa hàng
            window.location.href = `/gudbuk/admin-dashboard/store/edit?bookid=${bookid}`;
        } else {
            alert('Có lỗi xảy ra: ' + data.message);
        }
    });
});