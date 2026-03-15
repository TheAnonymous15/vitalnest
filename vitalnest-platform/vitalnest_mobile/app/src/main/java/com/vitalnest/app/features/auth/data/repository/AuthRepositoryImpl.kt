package com.vitalnest.app.features.auth.data.repository

import com.vitalnest.app.core.datastore.UserPreferences
import com.vitalnest.app.core.network.NetworkResult
import com.vitalnest.app.core.network.safeApiCall
import com.vitalnest.app.features.auth.data.api.AuthApi
import com.vitalnest.app.features.auth.data.model.*
import com.vitalnest.app.features.auth.domain.model.User
import com.vitalnest.app.features.auth.domain.repository.AuthRepository
import kotlinx.coroutines.flow.first
import javax.inject.Inject
import javax.inject.Singleton

@Singleton
class AuthRepositoryImpl @Inject constructor(
    private val authApi: AuthApi,
    private val userPreferences: UserPreferences
) : AuthRepository {

    override suspend fun login(email: String, password: String): NetworkResult<User> {
        val result = safeApiCall {
            authApi.login(LoginRequest(email, password))
        }

        return when (result) {
            is NetworkResult.Success -> {
                val response = result.data
                if (response.success && response.data != null) {
                    val authData = response.data
                    val user = authData.user?.toDomain()

                    if (user != null && authData.accessToken != null) {
                        // Save tokens and user info
                        userPreferences.saveAuthTokens(
                            accessToken = authData.accessToken,
                            refreshToken = authData.refreshToken ?: ""
                        )
                        userPreferences.saveUserInfo(
                            userId = user.id,
                            email = user.email,
                            name = user.fullName,
                            phone = user.phone
                        )
                        NetworkResult.Success(user)
                    } else {
                        NetworkResult.Error("Invalid response from server")
                    }
                } else {
                    NetworkResult.Error(response.message ?: "Login failed")
                }
            }
            is NetworkResult.Error -> NetworkResult.Error(result.message, result.code)
            is NetworkResult.Loading -> NetworkResult.Loading
        }
    }

    override suspend fun register(
        firstName: String,
        lastName: String,
        email: String,
        phone: String,
        password: String
    ): NetworkResult<User> {
        val result = safeApiCall {
            authApi.register(
                RegisterRequest(
                    firstName = firstName,
                    lastName = lastName,
                    email = email,
                    phone = phone,
                    password = password,
                    passwordConfirmation = password
                )
            )
        }

        return when (result) {
            is NetworkResult.Success -> {
                val response = result.data
                if (response.success && response.data?.user != null) {
                    NetworkResult.Success(response.data.user.toDomain())
                } else {
                    NetworkResult.Error(response.message ?: "Registration failed")
                }
            }
            is NetworkResult.Error -> NetworkResult.Error(result.message, result.code)
            is NetworkResult.Loading -> NetworkResult.Loading
        }
    }

    override suspend fun forgotPassword(email: String): NetworkResult<String> {
        val result = safeApiCall {
            authApi.forgotPassword(ForgotPasswordRequest(email))
        }

        return when (result) {
            is NetworkResult.Success -> {
                if (result.data.success) {
                    NetworkResult.Success(result.data.message)
                } else {
                    NetworkResult.Error(result.data.message)
                }
            }
            is NetworkResult.Error -> NetworkResult.Error(result.message, result.code)
            is NetworkResult.Loading -> NetworkResult.Loading
        }
    }

    override suspend fun verifyOtp(email: String, otp: String): NetworkResult<User> {
        val result = safeApiCall {
            authApi.verifyOtp(VerifyOtpRequest(email, otp))
        }

        return when (result) {
            is NetworkResult.Success -> {
                val response = result.data
                if (response.success && response.data != null) {
                    val authData = response.data
                    val user = authData.user?.toDomain()

                    if (user != null && authData.accessToken != null) {
                        userPreferences.saveAuthTokens(
                            accessToken = authData.accessToken,
                            refreshToken = authData.refreshToken ?: ""
                        )
                        userPreferences.saveUserInfo(
                            userId = user.id,
                            email = user.email,
                            name = user.fullName,
                            phone = user.phone
                        )
                        NetworkResult.Success(user)
                    } else {
                        NetworkResult.Error("Invalid response from server")
                    }
                } else {
                    NetworkResult.Error(response.message ?: "OTP verification failed")
                }
            }
            is NetworkResult.Error -> NetworkResult.Error(result.message, result.code)
            is NetworkResult.Loading -> NetworkResult.Loading
        }
    }

    override suspend fun resendOtp(email: String): NetworkResult<String> {
        val result = safeApiCall {
            authApi.resendOtp(ResendOtpRequest(email))
        }

        return when (result) {
            is NetworkResult.Success -> {
                if (result.data.success) {
                    NetworkResult.Success(result.data.message)
                } else {
                    NetworkResult.Error(result.data.message)
                }
            }
            is NetworkResult.Error -> NetworkResult.Error(result.message, result.code)
            is NetworkResult.Loading -> NetworkResult.Loading
        }
    }

    override suspend fun resetPassword(token: String, newPassword: String): NetworkResult<String> {
        val result = safeApiCall {
            authApi.resetPassword(
                ResetPasswordRequest(
                    token = token,
                    password = newPassword,
                    passwordConfirmation = newPassword
                )
            )
        }

        return when (result) {
            is NetworkResult.Success -> {
                if (result.data.success) {
                    NetworkResult.Success(result.data.message)
                } else {
                    NetworkResult.Error(result.data.message)
                }
            }
            is NetworkResult.Error -> NetworkResult.Error(result.message, result.code)
            is NetworkResult.Loading -> NetworkResult.Loading
        }
    }

    override suspend fun logout(): NetworkResult<Unit> {
        return try {
            safeApiCall { authApi.logout() }
            userPreferences.clearUserData()
            NetworkResult.Success(Unit)
        } catch (e: Exception) {
            // Clear local data even if API call fails
            userPreferences.clearUserData()
            NetworkResult.Success(Unit)
        }
    }

    override suspend fun getCurrentUser(): NetworkResult<User> {
        val result = safeApiCall {
            authApi.getCurrentUser()
        }

        return when (result) {
            is NetworkResult.Success -> {
                val response = result.data
                if (response.success && response.data?.user != null) {
                    NetworkResult.Success(response.data.user.toDomain())
                } else {
                    NetworkResult.Error(response.message ?: "Failed to get user info")
                }
            }
            is NetworkResult.Error -> NetworkResult.Error(result.message, result.code)
            is NetworkResult.Loading -> NetworkResult.Loading
        }
    }

    override suspend fun isLoggedIn(): Boolean {
        return userPreferences.isLoggedIn.first()
    }
}

