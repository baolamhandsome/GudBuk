// Minimal Register Form JavaScript
class MinimalRegisterForm {
    constructor() {
        this.form = document.getElementById('registerForm');
        this.emailInput = document.getElementById('email');
        this.nameInput = document.getElementById('name');
        this.phoneInput = document.getElementById('phone');
        this.addressInput = document.getElementById('address');
        this.passwordInput = document.getElementById('password');
        this.passwordConfirmInput = document.getElementById('password_confirm');
        this.termsCheckbox = document.getElementById('terms');
        this.passwordToggle = document.getElementById('passwordToggle');
        this.passwordConfirmToggle = document.getElementById('passwordConfirmToggle');
        this.submitButton = this.form.querySelector('.register-btn');
        this.successMessage = document.getElementById('successMessage');
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.setupPasswordToggles();
    }
    
    bindEvents() {
        this.form.addEventListener('submit', () => this.handleSubmit());
        
        // Email validation
        //set blur / foccusout event for email input
        this.emailInput.addEventListener('blur', () => this.validateEmail('email'));
        this.emailInput.addEventListener('input', () => this.clearError('email'));
        
        // Name validation
        this.nameInput.addEventListener('blur', () => this.validateName('name'));
        this.nameInput.addEventListener('input', () => this.clearError('name'));
        
        // Password validation
        this.passwordInput.addEventListener('blur', () => this.validatePassword());
        this.passwordInput.addEventListener('input', () => this.clearError('password'));
        
        // Password confirm validation
        this.passwordConfirmInput.addEventListener('blur', () => this.validatePasswordConfirm());
        this.passwordConfirmInput.addEventListener('input', () => this.clearError('password_confirm'));
        
        // Terms validation
        this.termsCheckbox.addEventListener('change', () => this.clearCheckboxError('terms'));
    }
    
    setupPasswordToggles() {
        this.passwordToggle.addEventListener('click', () => {
            this.togglePasswordVisibility(this.passwordInput, this.passwordToggle);
        });
        
        this.passwordConfirmToggle.addEventListener('click', () => {
            this.togglePasswordVisibility(this.passwordConfirmInput, this.passwordConfirmToggle);
        });
    }
    
    togglePasswordVisibility(input, button) {
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;
        
        const icon = button.querySelector('.toggle-icon');
        icon.classList.toggle('show-password', type === 'text');
    }
    
    validateEmail() {
        const email = this.emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!email) {
            this.showError('email', 'Email is required');
            return false;
        }
        
        if (!emailRegex.test(email)) {
            this.showError('email', 'Please enter a valid email address');
            return false;
        }
        
        this.clearError('email');
        return true;
    }
    
    validateName() {
        const name = this.nameInput.value.trim();
        
        if (!name) {
            this.showError('name', 'Full name is required');
            return false;
        }
        
        if (name.length < 2) {
            this.showError('name', 'Name must be at least 2 characters');
            return false;
        }
        
        this.clearError('name');
        return true;
    }
    
    validatePassword() {
        const password = this.passwordInput.value;
        
        if (!password) {
            this.showError('password', 'Password is required');
            return false;
        }
        
        if (password.length < 6) {
            this.showError('password', 'Password must be at least 6 characters');
            return false;
        }
        
        this.clearError('password');
        return true;
    }
    
    validatePasswordConfirm() {
        const password = this.passwordInput.value;
        const passwordConfirm = this.passwordConfirmInput.value;
        
        if (!passwordConfirm) {
            this.showError('password_confirm', 'Please confirm your password');
            return false;
        }
        
        if (password !== passwordConfirm) {
            this.showError('password_confirm', 'Passwords do not match');
            return false;
        }
        
        this.clearError('password_confirm');
        return true;
    }
    
    validateTerms() {
        if (!this.termsCheckbox.checked) {
            this.showCheckboxError('terms', 'You must agree to the terms and conditions');
            return false;
        }
        
        this.clearCheckboxError('terms');
        return true;
    }
    
    showError(field, message) {
        const input = document.getElementById(field);
        const formGroup = input.closest('.form-group');
        const errorElement = document.getElementById(`${field}Error`);
        
        formGroup.classList.add('error');
        errorElement.textContent = message;
        errorElement.classList.add('show');
    }
    
    clearError(field) {
        const input = document.getElementById(field);
        const formGroup = input.closest('.form-group');
        const errorElement = document.getElementById(`${field}Error`);
        
        formGroup.classList.remove('error');
        errorElement.classList.remove('show');
        setTimeout(() => {
            errorElement.textContent = '';
        }, 200);
    }
    
    showCheckboxError(field, message) {
        const checkboxGroup = document.getElementById(field).closest('.checkbox-group');
        const errorElement = document.getElementById(`${field}Error`);
        
        checkboxGroup.classList.add('error');
        errorElement.textContent = message;
        errorElement.classList.add('show');
    }
    
    clearCheckboxError(field) {
        const checkbox = document.getElementById(field);
        const checkboxGroup = checkbox.closest('.checkbox-group');
        const errorElement = document.getElementById(`${field}Error`);
        
        checkboxGroup.classList.remove('error');
        errorElement.classList.remove('show');
        setTimeout(() => {
            errorElement.textContent = '';
        }, 200);
    }
    
    async handleSubmit() {
        e.preventDefault();
        
        // Validate all required fields
        const isEmailValid = this.validateEmail('email');
        const isNameValid = this.validateName('name');
        const isPasswordValid = this.validatePassword();
        const isPasswordConfirmValid = this.validatePasswordConfirm();
        const isTermsValid = this.validateTerms();
        
        if (!isEmailValid || !isNameValid || !isPasswordValid || !isPasswordConfirmValid || !isTermsValid) {
            return;
        }
        
        this.setLoading(true);
        
        try {
            // Simulate API call
            await new Promise(resolve => setTimeout(resolve, 1500));
            
            // Show success state
            this.showSuccess();
        } catch (error) {
            this.showError('email', 'Registration failed. Please try again.');
        } finally {
            this.setLoading(false);
        }
    }
    
    setLoading(loading) {
        this.submitButton.classList.toggle('loading', loading);
        this.submitButton.disabled = loading;
    }
    
    showSuccess() {
        this.form.style.display = 'none';
        this.successMessage.classList.add('show');
        
        // Simulate redirect after 2 seconds
        setTimeout(() => {
            console.log('Redirecting to login page...');
            window.location.href = '/GudBuk/login';
        }, 2000);
    }
}

// Initialize the form when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new MinimalRegisterForm();
});