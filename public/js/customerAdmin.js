document.addEventListener('DOMContentLoaded', () => {
    // container cha chứa tất cả các card sách và nút thêm sách
    const bookContainer = document.querySelector('.customer-grid');

    bookContainer.addEventListener('click', async (event) => {
        const target = event.target;

        // Tìm element cha chứa ID của sách cho các chức năng Edit/Delete
        const card = target.closest('.customer-card');
        if (!card) return;

        const custimerId = card.getAttribute('data-customerid');

        if (target.classList.contains('btn-delete')) {
            if (confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
                await handleDelete(custimerId, card);
            }
        }
    });
});
async function handleDelete(id, elementToRemove) {
    try {
        const response = await fetch(`customer/delete`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `customerid=${id}`
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
function toggleCardExpand(headerElement) {
    const card = headerElement.closest('.customer-card');
    card.classList.toggle('expanded');
}