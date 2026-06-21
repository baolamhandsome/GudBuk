const categoryButtons = document.querySelectorAll('.nav-item');

categoryButtons.forEach(button => {
    button.addEventListener('click', function () {
        // 1. Sử dụng toggle để "sáng lên" khi click và "tắt đi" khi click lại
        const isSelected = this.classList.toggle('nav-active');
    });
});
