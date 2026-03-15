package com.vitalnest.app.features.auth.presentation

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.vitalnest.app.core.datastore.UserPreferences
import com.vitalnest.app.core.network.NetworkResult
import com.vitalnest.app.core.utils.ValidationResult
import com.vitalnest.app.core.utils.Validators
import com.vitalnest.app.features.auth.domain.usecase.LoginUseCase
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.StateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class LoginViewModel @Inject constructor(
    private val loginUseCase: LoginUseCase,
    private val userPreferences: UserPreferences
) : ViewModel() {

    private val _uiState = MutableStateFlow(LoginUiState())
    val uiState: StateFlow<LoginUiState> = _uiState.asStateFlow()

    init {
        // Check for remembered email
        viewModelScope.launch {
            userPreferences.rememberMe.collect { remember ->
                if (remember) {
                    userPreferences.userEmail.collect { email ->
                        email?.let {
                            _uiState.update { state -> state.copy(email = it, rememberMe = true) }
                        }
                    }
                }
            }
        }
    }

    fun onEvent(event: LoginEvent) {
        when (event) {
            is LoginEvent.EmailChanged -> {
                _uiState.update { it.copy(email = event.email, emailError = null) }
            }
            is LoginEvent.PasswordChanged -> {
                _uiState.update { it.copy(password = event.password, passwordError = null) }
            }
            is LoginEvent.RememberMeChanged -> {
                _uiState.update { it.copy(rememberMe = event.remember) }
            }
            is LoginEvent.Login -> {
                login()
            }
            is LoginEvent.BiometricLogin -> {
                // Handle biometric login
            }
            is LoginEvent.ClearError -> {
                _uiState.update { it.copy(generalError = null) }
            }
        }
    }

    private fun login() {
        val state = _uiState.value

        // Validate inputs
        val emailValidation = Validators.validateEmail(state.email)
        val passwordValidation = Validators.validatePassword(state.password)

        if (emailValidation is ValidationResult.Error || passwordValidation is ValidationResult.Error) {
            _uiState.update {
                it.copy(
                    emailError = emailValidation.errorMessage,
                    passwordError = passwordValidation.errorMessage
                )
            }
            return
        }

        viewModelScope.launch {
            _uiState.update { it.copy(isLoading = true, generalError = null) }

            when (val result = loginUseCase(state.email.trim(), state.password)) {
                is NetworkResult.Success -> {
                    // Save remember me preference
                    if (state.rememberMe) {
                        userPreferences.setRememberMe(true)
                    }

                    _uiState.update {
                        it.copy(
                            isLoading = false,
                            loginSuccess = true,
                            user = result.data
                        )
                    }
                }
                is NetworkResult.Error -> {
                    _uiState.update {
                        it.copy(
                            isLoading = false,
                            generalError = result.message
                        )
                    }
                }
                is NetworkResult.Loading -> {
                    // Already handled
                }
            }
        }
    }
}

