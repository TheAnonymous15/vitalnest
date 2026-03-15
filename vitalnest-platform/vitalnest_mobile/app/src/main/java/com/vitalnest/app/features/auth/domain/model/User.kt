package com.vitalnest.app.features.auth.domain.model

data class User(
    val id: String,
    val email: String,
    val firstName: String,
    val lastName: String,
    val phone: String?,
    val profileImageUrl: String?,
    val dateOfBirth: String?,
    val gender: Gender?,
    val idNumber: String?,
    val address: String?,
    val emergencyContactName: String?,
    val emergencyContactPhone: String?,
    val isEmailVerified: Boolean = false,
    val isPhoneVerified: Boolean = false,
    val createdAt: String?,
    val updatedAt: String?
) {
    val fullName: String get() = "$firstName $lastName"
    val initials: String get() = "${firstName.firstOrNull() ?: ""}${lastName.firstOrNull() ?: ""}".uppercase()
}

enum class Gender {
    MALE,
    FEMALE,
    OTHER
}

