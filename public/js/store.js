document.addEventListener('DOMContentLoaded', () => {
    //container cha chứa tất cả các card sách
    const bookContainer = document.querySelector('.store-grid');

    bookContainer.addEventListener('click', async (event) => {
        const target = event.target;

        // Tìm element cha chứa ID của sách
        const card = target.closest('.book-card');
        if (!card) return;

        const bookId = card.getAttribute('data-bookid');

        // Xử lý nút EDIT
        if (target.classList.contains('btn-edit')) {
            handleEdit(bookId);
        }

        // Xử lý nút DELETE
        if (target.classList.contains('btn-delete')) {
            if (confirm('Bạn có chắc chắn muốn xóa cuốn sách này?')) {
                await handleDelete(bookId, card);
            }
        }
    });
});

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
            elementToRemove.remove(); // Xóa khỏi giao diện mà không cần reload trang
        } else {
            const errorData = await response.json();
            alert(`Lỗi: ${errorData.message || 'Không thể xóa'}`);
        }
    } catch (error) {
        console.error('Lỗi kết nối:', error);
        alert('Đã xảy ra lỗi khi kết nối tới server.');
    }
}