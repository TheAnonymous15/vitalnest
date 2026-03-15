package com.vitalnest.app.features.auth.data.model

import com.google.gson.annotations.SerializedName
import com.vitalnest.app.features.auth.domain.model.Gender
import com.vitalnest.app.features.auth.domain.model.User

data class AuthResponse(
    @SerializedName("success")
    val success: Boolean,
    @SerializedName("message")
    val message: String?,
    @SerializedName("data")
    val data: AuthData?
)

data class AuthData(
    @SerializedName("user")
    val user: UserDto?,
    @SerializedName("access_token")
    val accessToken: String?,
    @SerializedName("refresh_token")
    val refreshToken: String?,
    @SerializedName("token_type")
    val tokenType: String?,
    @SerializedName("expires_in")
    val expiresIn: Long?
)

data class UserDto(
    @SerializedName("id")
    val id: String,
    @SerializedName("email")
    val email: String,
    @SerializedName("first_name")
    val firstName: String,
    @SerializedName("last_name")
    val lastName: String,
    @SerializedName("phone")
    val phone: String?,
    @SerializedName("profile_image_url")
    val profileImageUrl: String?,
    @SerializedName("date_of_birth")
    val dateOfBirth: String?,
    @SerializedName("gender")
    val gender: String?,
    @SerializedName("id_number")
    val idNumber: String?,
    @SerializedName("address")
    val address: String?,
    @SerializedName("emergency_contact_name")
    val emergencyContactName: String?,
    @SerializedName("emergency_contact_phone")
    val emergencyContactPhone: String?,
    @SerializedName("email_verified")
    val isEmailVerified: Boolean?,
    @SerializedName("phone_verified")
    val isPhoneVerified: Boolean?,
    @SerializedName("created_at")
    val createdAt: String?,
    @SerializedName("updated_at")
    val updatedAt: String?
) {
    fun toDomain(): User {
        return User(
            id = id,
            email = email,
            firstName = firstName,
            lastName = lastName,
            phone = phone,
            profileImageUrl = profileImageUrl,
            dateOfBirth = dateOfBirth,
            gender = gender?.let {
                when (it.uppercase()) {
                    "MALE" -> Gender.MALE
                    "FEMALE" -> Gender.FEMALE
                    else -> Gender.OTHER
                }
            },
            idNumber = idNumber,
            address = address,
            emergencyContactName = emergencyContactName,
            emergencyContactPhone = emergencyContactPhone,
            isEmailVerified = isEmailVerified ?: false,
            isPhoneVerified = isPhoneVerified ?: false,
            createdAt = createdAt,
            updatedAt = updatedAt
        )
    }
}

data class MessageResponse(
    @SerializedName("success")
    val success: Boolean,
    @SerializedName("message")
    val message: String
)

