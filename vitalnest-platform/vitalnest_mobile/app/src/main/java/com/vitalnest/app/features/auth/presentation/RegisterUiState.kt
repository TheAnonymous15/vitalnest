package com.vitalnest.app.features.auth.presentation

import com.vitalnest.app.features.auth.domain.model.User

data class RegisterUiState(
    val firstName: String = "",
    val lastName: String = "",
    val email: String = "",
    val phone: String = "",
    val password: String = "",
    val confirmPassword: String = "",
    val acceptTerms: Boolean = false,
    val isLoading: Boolean = false,
    val firstNameError: String? = null,
    val lastNameError: String? = null,
    val emailError: String? = null,
    val phoneError: String? = null,
    val passwordError: String? = null,
    val confirmPasswordError: String? = null,
    val generalError: String? = null,
    val registerSuccess: Boolean = false,
    val user: User? = null
)

sealed class RegisterEvent {
    data class FirstNameChanged(val firstName: String) : RegisterEvent()
    data class LastNameChanged(val lastName: String) : RegisterEvent()
    data class EmailChanged(val email: String) : RegisterEvent()
    data class PhoneChanged(val phone: String) : RegisterEvent()
    data class PasswordChanged(val password: String) : RegisterEvent()
    data class ConfirmPasswordChanged(val confirmPassword: String) : RegisterEvent()
    data class AcceptTermsChanged(val accept: Boolean) : RegisterEvent()
    data object Register : RegisterEvent()
    data object ClearError : RegisterEvent()
}

