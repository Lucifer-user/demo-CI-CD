

// Dropdown Menu Handler
class DropdownHandler {
    constructor() {
        this.dropdowns = document.querySelectorAll('.nav-dropdown');
        this.init();
    }

    init() {
        this.dropdowns.forEach(dropdown => {
            const btn = dropdown.querySelector('.dropdown-btn');
            const menu = dropdown.querySelector('.dropdown-menu');

            if (btn && menu) {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.toggleDropdown(dropdown);
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!dropdown.contains(e.target)) {
                        this.closeDropdown(dropdown);
                    }
                });

                // Close on menu item click
                menu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        this.closeDropdown(dropdown);
                    });
                });
            }
        });
    }

    toggleDropdown(dropdown) {
        const menu = dropdown.querySelector('.dropdown-menu');
        const isOpen = menu.style.display === 'block';
        
        // Close all other dropdowns
        this.dropdowns.forEach(d => {
            if (d !== dropdown) {
                this.closeDropdown(d);
            }
        });

        if (isOpen) {
            this.closeDropdown(dropdown);
        } else {
            this.openDropdown(dropdown);
        }
    }

    openDropdown(dropdown) {
        const menu = dropdown.querySelector('.dropdown-menu');
        menu.style.display = 'block';
    }

    closeDropdown(dropdown) {
        const menu = dropdown.querySelector('.dropdown-menu');
        menu.style.display = 'none';
    }
}

// Details Section Handler
class DetailsHandler {
    constructor() {
        this.details = document.querySelectorAll('.details-section');
        this.init();
    }

    init() {
        this.details.forEach(detail => {
            const summary = detail.querySelector('.details-summary');
            
            if (summary) {
                summary.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.toggleDetails(detail);
                });
            }
        });
    }

    toggleDetails(detail) {
        if (detail.hasAttribute('open')) {
            detail.removeAttribute('open');
        } else {
            detail.setAttribute('open', '');
        }
    }
}

// Form Handler
class FormHandler {
    constructor() {
        this.form = document.querySelector('.checkout-form');
        this.emailInput = document.querySelector('input[type="email"]');
        this.init();
    }

    init() {
        if (this.form) {
            this.form.addEventListener('submit', (e) => {
                e.preventDefault();
                this.handleSubmit();
            });
        }

        // Add input validation
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                this.validateInput(input);
            });
        });
    }

    validateInput(input) {
        if (input.type === 'email') {
            const isValid = this.isValidEmail(input.value);
            if (input.value && !isValid) {
                input.style.borderColor = '#ee2b5b';
            } else {
                input.style.borderColor = '';
            }
        }
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    handleSubmit() {
        const email = this.emailInput.value;
        
        if (!email) {
            alert('Vui lòng nhập địa chỉ email');
            return;
        }

        if (!this.isValidEmail(email)) {
            alert('Vui lòng nhập địa chỉ email hợp lệ');
            return;
        }

        // Get form data
        const formData = this.getFormData();
        console.log('Form Data:', formData);
        
        // Here you would typically send data to server
        alert('Tiếp tục đến bước vận chuyển');
    }

    getFormData() {
        const inputs = document.querySelectorAll('.form-input');
        const data = {};
        
        inputs.forEach((input, index) => {
            if (input.value) {
                data[`field_${index}`] = input.value;
            }
        });

        return data;
    }
}

// Promo Code Handler
class PromoHandler {
    constructor() {
        this.promoInput = document.querySelector('.promo-section .form-input');
        this.applyBtn = document.querySelector('.promo-section .btn-secondary');
        this.init();
    }

    init() {
        if (this.applyBtn) {
            this.applyBtn.addEventListener('click', () => {
                this.applyPromo();
            });
        }

        if (this.promoInput) {
            this.promoInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    this.applyPromo();
                }
            });
        }
    }

    applyPromo() {
        const code = this.promoInput.value.trim();
        
        if (!code) {
            alert('Vui lòng nhập mã giảm giá');
            return;
        }

        // Simulate promo validation
        console.log('Applying promo code:', code);
        alert(`Mã giảm giá "${code}" đã được áp dụng`);
        
        // Here you would typically validate the code with server
    }
}

// Button Handler
class ButtonHandler {
    constructor() {
        this.buttons = document.querySelectorAll('.btn');
        this.init();
    }

    init() {
        this.buttons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (btn.classList.contains('btn-primary')) {
                    this.handlePrimaryButton(e);
                }
            });
        });
    }

    handlePrimaryButton(e) {
        e.preventDefault();
        const formHandler = new FormHandler();
        formHandler.handleSubmit();
    }
}

// Icon Button Handler
class IconButtonHandler {
    constructor() {
        this.buttons = document.querySelectorAll('.icon-btn');
        this.init();
    }

    init() {
        this.buttons.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                this.handleIconClick(index);
            });
        });
    }

    handleIconClick(index) {
        if (index === 0) {
            // Person icon - go to profile
            console.log('Navigate to profile');
        } else if (index === 1) {
            // Shopping bag icon - go to cart
            console.log('Navigate to cart');
        }
    }
}

// Breadcrumb Handler
class BreadcrumbHandler {
    constructor() {
        this.links = document.querySelectorAll('.breadcrumb-link');
        this.init();
    }

    init() {
        this.links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const text = link.textContent;
                console.log('Navigate to:', text);
            });
        });
    }
}

// Initialize all handlers when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize UI handlers
    new DropdownHandler();
    new DetailsHandler();
    new FormHandler();
    new PromoHandler();
    new ButtonHandler();
    new IconButtonHandler();
    new BreadcrumbHandler();

    console.log('Payment page initialized');
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
