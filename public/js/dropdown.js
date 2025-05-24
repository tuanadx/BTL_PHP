document.addEventListener('DOMContentLoaded', function() {
    // Sử dụng event delegation để xử lý click trên toàn document
    document.addEventListener('click', function(e) {
        // Kiểm tra nếu click vào user-toggle
        if (e.target.closest('.user-toggle')) {
            e.preventDefault();
            e.stopPropagation();
            
            // Tìm dropdown container gần nhất
            const userDropdown = e.target.closest('.user-dropdown');
            if (!userDropdown) return;
            
            // Toggle active class
            const isActive = userDropdown.classList.contains('active');
            
            // Đóng tất cả dropdown khác
            document.querySelectorAll('.user-dropdown.active').forEach(dropdown => {
                if (dropdown !== userDropdown) {
                    dropdown.classList.remove('active');
                    const otherChevron = dropdown.querySelector('.fa-chevron-down');
                    if (otherChevron) {
                        otherChevron.style.transform = 'rotate(0deg)';
                    }
                }
            });
            
            // Toggle dropdown hiện tại
            userDropdown.classList.toggle('active');
            
            // Xoay icon mũi tên
            const chevron = userDropdown.querySelector('.fa-chevron-down');
            if (chevron) {
                chevron.style.transform = isActive ? 'rotate(0deg)' : 'rotate(180deg)';
            }
        } else if (!e.target.closest('.user-dropdown')) {
            // Nếu click ra ngoài dropdown, đóng tất cả dropdown
            document.querySelectorAll('.user-dropdown.active').forEach(dropdown => {
                dropdown.classList.remove('active');
                const chevron = dropdown.querySelector('.fa-chevron-down');
                if (chevron) {
                    chevron.style.transform = 'rotate(0deg)';
                }
            });
        }
    });

    // Xử lý phím Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.user-dropdown.active').forEach(dropdown => {
                dropdown.classList.remove('active');
                const chevron = dropdown.querySelector('.fa-chevron-down');
                if (chevron) {
                    chevron.style.transform = 'rotate(0deg)';
                }
            });
        }
    });
}); 