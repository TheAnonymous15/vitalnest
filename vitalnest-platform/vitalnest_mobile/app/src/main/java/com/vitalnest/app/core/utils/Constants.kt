package com.vitalnest.app.core.utils

object Constants {
    // API
    const val CONNECT_TIMEOUT = 30L
    const val READ_TIMEOUT = 30L
    const val WRITE_TIMEOUT = 30L

    // DataStore
    const val DATASTORE_NAME = "vitalnest_preferences"

    // Keys
    const val KEY_ACCESS_TOKEN = "access_token"
    const val KEY_REFRESH_TOKEN = "refresh_token"
    const val KEY_USER_ID = "user_id"
    const val KEY_IS_LOGGED_IN = "is_logged_in"
    const val KEY_BIOMETRIC_ENABLED = "biometric_enabled"
    const val KEY_REMEMBER_ME = "remember_me"

    // Validation
    const val MIN_PASSWORD_LENGTH = 8
    const val PHONE_NUMBER_LENGTH = 10
    const val OTP_LENGTH = 6

    // Pagination
    const val DEFAULT_PAGE_SIZE = 20

    // Date Formats
    const val DATE_FORMAT_API = "yyyy-MM-dd"
    const val DATE_FORMAT_DISPLAY = "MMM dd, yyyy"
    const val TIME_FORMAT_DISPLAY = "hh:mm a"
    const val DATETIME_FORMAT_DISPLAY = "MMM dd, yyyy hh:mm a"
}

