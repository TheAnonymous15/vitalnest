package com.vitalnest.app.features.auth.presentation

import com.vitalnest.app.features.auth.domain.model.User

data class LoginUiState(
    val email: String = "",
    val password: String = "",
    val rememberMe: Boolean = false,
    val isLoading: Boolean = false,
    val emailError: String? = null,
    val passwordError: String? = null,
    val generalError: String? = null,
    val loginSuccess: Boolean = false,
    val user: User? = null
)

sealed class LoginEvent {
    data class EmailChanged(val email: String) : LoginEvent()
    data class PasswordChanged(val password: String) : LoginEvent()
    data class RememberMeChanged(val remember: Boolean) : LoginEvent()
    data object Login : LoginEvent()
    data object BiometricLogin : LoginEvent()
    data object ClearError : LoginEvent()
}

