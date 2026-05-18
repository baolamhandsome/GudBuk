document.addEventListener('DOMContentLoaded', () => {
    // 1. Lấy thực thể Container cha chứa toàn bộ các card sách
    const booksGrid = document.querySelector('.books-grid');

    if (!booksGrid) return; // kiểm tra an toàn nếu không tìm thấy element

    // 2. Sử dụng kỹ thuật Event Delegation (Ủy nhiệm sự kiện)
    booksGrid.addEventListener('click', (event) => {
        // Tìm thẻ .book-card gần nhất tính từ vị trí con trỏ chuột vừa click trúng
        const bookCard = event.target.closest('.book-card');

        // Nếu click trúng khoảng không nằm ngoài các card sách thì bỏ qua
        if (!bookCard) return;

        // 3. Đọc mã định danh bookid từ bộ thuộc tính data-* (dataset)
        const bookId = bookCard.dataset.bookid;

        if (bookId) {
            // 4. Thực hiện điều hướng an toàn bằng phương thức GET chuẩn RESTful API
            // URL này sẽ khớp với Router/Controller hiển thị trang chi tiết sách của bạn
            window.location.href = `/gudbuk/book?bookid=${encodeURIComponent(bookId)}`;
        }
    });
});