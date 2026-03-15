package com.vitalnest.app.features.auth.domain.repository

import com.vitalnest.app.core.network.NetworkResult
import com.vitalnest.app.features.auth.domain.model.User

interface AuthRepository {
    suspend fun login(email: String, password: String): NetworkResult<User>
    suspend fun register(
        firstName: String,
        lastName: String,
        email: String,
        phone: String,
        password: String
    ): NetworkResult<User>
    suspend fun forgotPassword(email: String): NetworkResult<String>
    suspend fun verifyOtp(email: String, otp: String): NetworkResult<User>
    suspend fun resendOtp(email: String): NetworkResult<String>
    suspend fun resetPassword(token: String, newPassword: String): NetworkResult<String>
    suspend fun logout(): NetworkResult<Unit>
    suspend fun getCurrentUser(): NetworkResult<User>
    suspend fun isLoggedIn(): Boolean
}

