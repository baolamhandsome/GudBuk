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

        // --- PHẦN BỔ SUNG: Lấy các category đã chọn ---
        const selectedCategories = document.querySelectorAll('.category-btn.category-selected');

        selectedCategories.forEach(btn => {
            // Nếu bạn có attribute data-id="1" trong HTML, hãy dùng: btn.dataset.id
            // Hiện tại theo cấu trúc của bạn, ta sẽ lấy textContent (tên category)
            const categoryId = btn.getAttribute('id');

            // Append vào formData dưới dạng mảng (categories[])
            formData.append('category[]', categoryId);
        });
        const response = await fetch('edit', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Lỗi kết nối đến máy chủ: ' + response.status);
        }

        const data = await response.json();
        const bookid = data.bookid;

        if (data.success) {
            alert('Cập nhật thông tin sách thành công!');
        } else {
            alert('Có lỗi xảy ra: ' + data.message);
        }
    });

    // Phần xử lý click nút category (giữ nguyên hoặc tối ưu)
    const categoryButtons = document.querySelectorAll('.category-btn');
    categoryButtons.forEach(button => {
        button.addEventListener('click', function () {
            this.classList.toggle('category-selected');
        });
    });
});