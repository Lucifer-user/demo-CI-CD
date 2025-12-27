// SALA Admin - Fixed JavaScript
document.addEventListener('DOMContentLoaded', function () {
    console.log('SALA Admin initialized');

    // Initialize all functionality
    initializeSidebarNavigation();
    initializeSearch();
    initializeFilters();
    initializeSubmenu();

    // Check URL hash for section
    const hash = window.location.hash.replace('#', '');
    if (hash && document.getElementById(`section-${hash}`)) {
        showSection(hash);
        // Set active nav item
        const navLink = document.querySelector(`.nav-link[data-section="${hash}"]`);
        if (navLink) {
            document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('active'));
            const navItem = navLink.closest('.nav-item');
            navItem.classList.add('active');
            if (navItem.querySelector('.sub-menu')) {
                navItem.classList.add('submenu-open');
            }
        }
    } else if (document.getElementById('section-products')) {
        showSection('products');
        const productsItem = document.querySelector('.nav-link[data-section="products"]')?.closest('.nav-item');
        if (productsItem && productsItem.querySelector('.sub-menu')) {
            productsItem.classList.add('submenu-open');
        }
    } else {
        const firstSection = document.querySelector('.section-content');
        if (firstSection) {
            firstSection.classList.add('active');
        }
        const currentUrl = window.location.href;
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.href === currentUrl) {
                const navItem = link.closest('.nav-item');
                navItem.classList.add('active');
                if (navItem.querySelector('.sub-menu')) {
                    navItem.classList.add('submenu-open');
                }
            }
        });
    }
});

function initializeSidebarNavigation() {
    const navLinks = document.querySelectorAll('.nav-link[data-section]');

    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            // Get section name
            const sectionName = this.getAttribute('data-section');

            // Check if section exists on this page
            const targetSection = document.getElementById(`section-${sectionName}`);

            if (targetSection) {
                e.preventDefault();
                // Remove active class from all nav items
                document.querySelectorAll('.nav-item').forEach(item => {
                    item.classList.remove('active');
                });

                // Add active class to clicked nav item
                this.closest('.nav-item').classList.add('active');

                showSection(sectionName);
            }
            // If section doesn't exist, let the link navigate normally (to the href)
        });
    });
}


function initializeSubmenu() {
    // Tìm các nav-item có chứa sub-menu
    const menuItems = document.querySelectorAll('.nav-item');

    menuItems.forEach(item => {
        const link = item.querySelector('.nav-link');
        const submenu = item.querySelector('.sub-menu');

        // Chỉ chạy nếu mục đó thực sự có menu con
        if (link && submenu) {
            link.addEventListener('click', function (e) {
                // Nếu bấm vào link, ta vừa cho chuyển tab (theo logic cũ)
                // VỪA toggle class để mở menu
                
                // Toggle class mở menu
                item.classList.toggle('submenu-open');
                
                // Lưu ý: Không dùng e.preventDefault() ở đây nếu bạn muốn nó vẫn chuyển sang tab Products
                // Nếu bạn chỉ muốn nó mở menu mà KHÔNG chuyển tab, hãy bỏ comment dòng dưới:
                // e.preventDefault(); 
            });
        }
    });

    // Mở sẵn menu con nếu đang ở trang active (giữ trạng thái mở khi load lại)
    const activeItem = document.querySelector('.nav-item.active');
    if (activeItem && activeItem.querySelector('.sub-menu')) {
        activeItem.classList.add('submenu-open');
    }
}

// Show specific section
function showSection(sectionName) {
    console.log('Showing section:', sectionName);

    // Hide all sections
    document.querySelectorAll('.section-content').forEach(section => {
        section.classList.remove('active');
    });

    // Show target section
    const targetSection = document.getElementById(`section-${sectionName}`);
    if (targetSection) {
        targetSection.classList.add('active');
        console.log('Section found and activated');
    } else {
        console.error('Section not found:', `section-${sectionName}`);
    }
}

// Search functionality
function initializeSearch() {
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function (e) {
            performSearch(e.target.value);
        });
    }
}

function performSearch(query) {
    const activeSection = document.querySelector('.section-content.active');
    if (!activeSection) return;

    const tableBody = activeSection.querySelector('tbody');
    if (!tableBody) return;

    const rows = tableBody.querySelectorAll('tr');
    const searchTerm = query.toLowerCase().trim();

    rows.forEach(row => {
        const textContent = row.textContent.toLowerCase();
        if (textContent.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Filter functionality
function initializeFilters() {
    const filterTabs = document.querySelectorAll('.filter-tab');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            // Remove active class from all tabs in the same container
            const container = this.closest('.filter-tabs');
            container.querySelectorAll('.filter-tab').forEach(t => {
                t.classList.remove('active');
            });

            // Add active class to clicked tab
            this.classList.add('active');

            // Apply filter
            const filterType = this.getAttribute('data-filter') || this.textContent.trim().split(' ')[0];
            applyFilter(filterType);
        });
    });
}

function applyFilter(filterType) {
    const activeSection = document.querySelector('.section-content.active');
    if (!activeSection) return;

    const tableBody = activeSection.querySelector('tbody');
    if (!tableBody) return;

    const rows = tableBody.querySelectorAll('tr');

    rows.forEach(row => {
        let shouldShow = true;

        if (activeSection.id === 'section-orders') {
            shouldShow = filterOrders(row, filterType);
        } else if (activeSection.id === 'section-products') {
            shouldShow = filterProducts(row, filterType);
        } else if (activeSection.id === 'section-reviews') {
            shouldShow = filterReviews(row, filterType);
        }

        row.style.display = shouldShow ? '' : 'none';
    });
}

function filterOrders(row, filterType) {
    if (filterType === 'all') return true;

    const statusCell = row.querySelector('.status-badge');
    if (!statusCell) return true;

    const statusClass = Array.from(statusCell.classList).find(cls => cls.startsWith('status-'));
    if (!statusClass) return true;

    const status = statusClass.replace('status-', '');
    return status === filterType;
}

function filterProducts(row, filterType) {
    const statusCell = row.querySelector('.status-badge');
    if (!statusCell) return true;

    const status = statusCell.textContent.trim();

    switch (filterType) {
        case 'Tất':
            return true;
        case 'Còn':
            return status === 'Còn hàng';
        case 'Hết':
            return status === 'Hết hàng';
        default:
            return true;
    }
}

function filterReviews(row, filterType) {
    const ratingCell = row.querySelector('.rating');
    if (!ratingCell) return true;

    const stars = ratingCell.querySelectorAll('.star').length;

    switch (filterType) {
        case 'Tất cả':
            return true;
        case '5 sao':
            return stars === 5;
        case '4 sao':
            return stars === 4;
        case 'Thấp':
            return stars <= 3;
        default:
            return true;
    }
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    const colors = {
        info: 'linear-gradient(135deg, #60A5FA 0%, #3B82F6 100%)',
        success: 'linear-gradient(135deg, #81FBB8 0%, #28C76F 100%)',
        warning: 'linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%)',
        error: 'linear-gradient(135deg, #F87171 0%, #EF4444 100%)'
    };

    notification.style.cssText = `
        position: fixed;
        top: 2rem;
        right: 2rem;
        background: ${colors[type]};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        z-index: 10000;
        font-weight: 500;
        max-width: 350px;
        animation: slideInRight 0.3s ease-out, slideOutRight 0.3s ease-in 2.7s;
    `;

    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 3000);
}

// Add notification animations to stylesheet
if (!document.getElementById('notification-animation')) {
    const style = document.createElement('style');
    style.id = 'notification-animation';
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
}

// Floating button
const floatingBtn = document.querySelector('.floating-btn');
if (floatingBtn) {
    floatingBtn.addEventListener('click', function () {
        this.style.transition = 'transform 0.3s ease';
        this.style.transform = 'rotate(360deg) scale(1.1)';

        setTimeout(() => {
            this.style.transform = '';
        }, 300);

        showNotification('Menu hành động nhanh', 'info');
    });
}

//Đăng xuất
function toggleDropdown() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
}

// Close dropdown when clicking outside
window.onclick = function (event) {
    if (!event.target.matches('.dropdown-icon')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        const dropdown = document.getElementById('userDropdown');
        if (dropdown && dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        }
    }
}