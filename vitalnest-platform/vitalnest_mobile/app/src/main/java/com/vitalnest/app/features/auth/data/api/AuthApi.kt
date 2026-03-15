package com.vitalnest.app.features.auth.data.api

import com.vitalnest.app.features.auth.data.model.*
import retrofit2.http.Body
import retrofit2.http.GET
import retrofit2.http.POST

interface AuthApi {

    @POST("auth/login")
    suspend fun login(@Body request: LoginRequest): AuthResponse

    @POST("auth/register")
    suspend fun register(@Body request: RegisterRequest): AuthResponse

    @POST("auth/forgot-password")
    suspend fun forgotPassword(@Body request: ForgotPasswordRequest): MessageResponse

    @POST("auth/verify-otp")
    suspend fun verifyOtp(@Body request: VerifyOtpRequest): AuthResponse

    @POST("auth/resend-otp")
    suspend fun resendOtp(@Body request: ResendOtpRequest): MessageResponse

    @POST("auth/reset-password")
    suspend fun resetPassword(@Body request: ResetPasswordRequest): MessageResponse

    @POST("auth/logout")
    suspend fun logout(): MessageResponse

    @GET("auth/me")
    suspend fun getCurrentUser(): AuthResponse

    @POST("auth/refresh")
    suspend fun refreshToken(): AuthResponse
}

