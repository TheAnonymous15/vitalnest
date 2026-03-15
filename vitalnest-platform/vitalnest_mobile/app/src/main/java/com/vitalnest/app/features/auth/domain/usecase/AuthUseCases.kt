package com.vitalnest.app.features.auth.domain.usecase

import com.vitalnest.app.core.network.NetworkResult
import com.vitalnest.app.features.auth.domain.model.User
import com.vitalnest.app.features.auth.domain.repository.AuthRepository
import javax.inject.Inject

class LoginUseCase @Inject constructor(
    private val authRepository: AuthRepository
) {
    suspend operator fun invoke(email: String, password: String): NetworkResult<User> {
        return authRepository.login(email, password)
    }
}

class RegisterUseCase @Inject constructor(
    private val authRepository: AuthRepository
) {
    suspend operator fun invoke(
        firstName: String,
        lastName: String,
        email: String,
        phone: String,
        password: String
    ): NetworkResult<User> {
        return authRepository.register(firstName, lastName, email, phone, password)
    }
}

class ForgotPasswordUseCase @Inject constructor(
    private val authRepository: AuthRepository
) {
    suspend operator fun invoke(email: String): NetworkResult<String> {
        return authRepository.forgotPassword(email)
    }
}

class VerifyOtpUseCase @Inject constructor(
    private val authRepository: AuthRepository
) {
    suspend operator fun invoke(email: String, otp: String): NetworkResult<User> {
        return authRepository.verifyOtp(email, otp)
    }
}

class ResendOtpUseCase @Inject constructor(
    private val authRepository: AuthRepository
) {
    suspend operator fun invoke(email: String): NetworkResult<String> {
        return authRepository.resendOtp(email)
    }
}

class LogoutUseCase @Inject constructor(
    private val authRepository: AuthRepository
) {
    suspend operator fun invoke(): NetworkResult<Unit> {
        return authRepository.logout()
    }
}

class GetCurrentUserUseCase @Inject constructor(
    private val authRepository: AuthRepository
) {
    suspend operator fun invoke(): NetworkResult<User> {
        return authRepository.getCurrentUser()
    }
}

class CheckAuthStateUseCase @Inject constructor(
    private val authRepository: AuthRepository
) {
    suspend operator fun invoke(): Boolean {
        return authRepository.isLoggedIn()
    }
}

