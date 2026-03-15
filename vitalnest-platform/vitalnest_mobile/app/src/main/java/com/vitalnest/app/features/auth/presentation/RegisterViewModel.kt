package com.vitalnest.app.features.auth.presentation

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.vitalnest.app.core.network.NetworkResult
import com.vitalnest.app.core.utils.ValidationResult
import com.vitalnest.app.core.utils.Validators
import com.vitalnest.app.core.utils.formatPhoneNumber
import com.vitalnest.app.features.auth.domain.usecase.RegisterUseCase
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.StateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class RegisterViewModel @Inject constructor(
    private val registerUseCase: RegisterUseCase
) : ViewModel() {

    private val _uiState = MutableStateFlow(RegisterUiState())
    val uiState: StateFlow<RegisterUiState> = _uiState.asStateFlow()

    fun onEvent(event: RegisterEvent) {
        when (event) {
            is RegisterEvent.FirstNameChanged -> {
                _uiState.update { it.copy(firstName = event.firstName, firstNameError = null) }
            }
            is RegisterEvent.LastNameChanged -> {
                _uiState.update { it.copy(lastName = event.lastName, lastNameError = null) }
            }
            is RegisterEvent.EmailChanged -> {
                _uiState.update { it.copy(email = event.email, emailError = null) }
            }
            is RegisterEvent.PhoneChanged -> {
                _uiState.update { it.copy(phone = event.phone, phoneError = null) }
            }
            is RegisterEvent.PasswordChanged -> {
                _uiState.update { it.copy(password = event.password, passwordError = null) }
            }
            is RegisterEvent.ConfirmPasswordChanged -> {
                _uiState.update { it.copy(confirmPassword = event.confirmPassword, confirmPasswordError = null) }
            }
            is RegisterEvent.AcceptTermsChanged -> {
                _uiState.update { it.copy(acceptTerms = event.accept) }
            }
            is RegisterEvent.Register -> {
                register()
            }
            is RegisterEvent.ClearError -> {
                _uiState.update { it.copy(generalError = null) }
            }
        }
    }

    private fun register() {
        val state = _uiState.value

        // Validate all fields
        val firstNameValidation = Validators.validateName(state.firstName, "First name")
        val lastNameValidation = Validators.validateName(state.lastName, "Last name")
        val emailValidation = Validators.validateEmail(state.email)
        val phoneValidation = Validators.validatePhone(state.phone)
        val passwordValidation = Validators.validatePassword(state.password)
        val confirmPasswordValidation = Validators.validateConfirmPassword(state.password, state.confirmPassword)

        val hasErrors = listOf(
            firstNameValidation,
            lastNameValidation,
            emailValidation,
            phoneValidation,
            passwordValidation,
            confirmPasswordValidation
        ).any { it is ValidationResult.Error }

        if (hasErrors) {
            _uiState.update {
                it.copy(
                    firstNameError = firstNameValidation.errorMessage,
                    lastNameError = lastNameValidation.errorMessage,
                    emailError = emailValidation.errorMessage,
                    phoneError = phoneValidation.errorMessage,
                    passwordError = passwordValidation.errorMessage,
                    confirmPasswordError = confirmPasswordValidation.errorMessage
                )
            }
            return
        }

        if (!state.acceptTerms) {
            _uiState.update { it.copy(generalError = "Please accept the Terms & Conditions") }
            return
        }

        viewModelScope.launch {
            _uiState.update { it.copy(isLoading = true, generalError = null) }

            val formattedPhone = state.phone.formatPhoneNumber()

            when (val result = registerUseCase(
                firstName = state.firstName.trim(),
                lastName = state.lastName.trim(),
                email = state.email.trim(),
                phone = formattedPhone,
                password = state.password
            )) {
                is NetworkResult.Success -> {
                    _uiState.update {
                        it.copy(
                            isLoading = false,
                            registerSuccess = true,
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

