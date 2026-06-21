document.addEventListener('DOMContentLoaded', () => {
    // container cha chứa tất cả các card sách và nút thêm sách
    const bookContainer = document.querySelector('.store-grid');

    bookContainer.addEventListener('click', async (event) => {
        const target = event.target;

        // 1. Xử lý nút "THÊM SÁCH" (Nằm ngoài các card)
        if (target.classList.contains('btn-add-book')) {
            handleAddBook();
            return; // Dừng lại vì nút này không thuộc .book-card
        }

        // Tìm element cha chứa ID của sách cho các chức năng Edit/Delete
        const card = target.closest('.book-card');
        if (!card) return;

        const bookId = card.getAttribute('data-bookid');

        // 2. Xử lý nút EDIT
        if (target.classList.contains('btn-edit')) {
            handleEdit(bookId);
        }

        // 3. Xử lý nút DELETE
        if (target.classList.contains('btn-delete')) {
            if (confirm('Bạn có chắc chắn muốn xóa cuốn sách này?')) {
                await handleDelete(bookId, card);
            }
        }
    });
});

// Hàm điều hướng tới trang thêm sách
function handleAddBook() {
    window.location.href = './store/add';
}

function handleEdit(id) {
    window.location.href = `./store/edit?bookid=${id}`;
}

async function handleDelete(id, elementToRemove) {
    try {
        const response = await fetch(`store/delete`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `bookid=${id}`
        });

        if (response.ok) {
            alert('Xóa thành công!');
            elementToRemove.remove();
        } else {
            const errorData = await response.json();
            alert(`Lỗi: ${errorData.message || 'Không thể xóa'}`);
        }
    } catch (error) {
        console.error('Lỗi kết nối:', error);
        alert('Đã xảy ra lỗi khi kết nối tới server.');
    }
}