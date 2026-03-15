package com.vitalnest.app.core.utils

object Validators {

    fun validateEmail(email: String): ValidationResult {
        return when {
            email.isBlank() -> ValidationResult.Error("Email is required")
            !email.isValidEmail() -> ValidationResult.Error("Please enter a valid email address")
            else -> ValidationResult.Success
        }
    }

    fun validatePassword(password: String): ValidationResult {
        return when {
            password.isBlank() -> ValidationResult.Error("Password is required")
            password.length < Constants.MIN_PASSWORD_LENGTH ->
                ValidationResult.Error("Password must be at least ${Constants.MIN_PASSWORD_LENGTH} characters")
            !password.any { it.isDigit() } ->
                ValidationResult.Error("Password must contain at least one number")
            !password.any { it.isLetter() } ->
                ValidationResult.Error("Password must contain at least one letter")
            else -> ValidationResult.Success
        }
    }

    fun validateConfirmPassword(password: String, confirmPassword: String): ValidationResult {
        return when {
            confirmPassword.isBlank() -> ValidationResult.Error("Please confirm your password")
            password != confirmPassword -> ValidationResult.Error("Passwords do not match")
            else -> ValidationResult.Success
        }
    }

    fun validatePhone(phone: String): ValidationResult {
        return when {
            phone.isBlank() -> ValidationResult.Error("Phone number is required")
            !phone.isValidPhone() -> ValidationResult.Error("Please enter a valid Kenyan phone number")
            else -> ValidationResult.Success
        }
    }

    fun validateName(name: String, fieldName: String = "Name"): ValidationResult {
        return when {
            name.isBlank() -> ValidationResult.Error("$fieldName is required")
            name.length < 2 -> ValidationResult.Error("$fieldName must be at least 2 characters")
            !name.all { it.isLetter() || it.isWhitespace() } ->
                ValidationResult.Error("$fieldName can only contain letters")
            else -> ValidationResult.Success
        }
    }

    fun validateOtp(otp: String): ValidationResult {
        return when {
            otp.isBlank() -> ValidationResult.Error("OTP is required")
            otp.length != Constants.OTP_LENGTH ->
                ValidationResult.Error("OTP must be ${Constants.OTP_LENGTH} digits")
            !otp.all { it.isDigit() } -> ValidationResult.Error("OTP must contain only numbers")
            else -> ValidationResult.Success
        }
    }

    fun validateIdNumber(idNumber: String): ValidationResult {
        return when {
            idNumber.isBlank() -> ValidationResult.Error("ID number is required")
            idNumber.length !in 7..8 -> ValidationResult.Error("ID number must be 7-8 digits")
            !idNumber.all { it.isDigit() } -> ValidationResult.Error("ID number must contain only numbers")
            else -> ValidationResult.Success
        }
    }
}

sealed class ValidationResult {
    data object Success : ValidationResult()
    data class Error(val message: String) : ValidationResult()

    val isValid: Boolean get() = this is Success
    val errorMessage: String? get() = (this as? Error)?.message
}

