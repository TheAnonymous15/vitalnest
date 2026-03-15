package com.vitalnest.app.core.utils

import java.text.SimpleDateFormat
import java.util.Date
import java.util.Locale

// String Extensions
fun String.isValidEmail(): Boolean {
    return android.util.Patterns.EMAIL_ADDRESS.matcher(this).matches()
}

fun String.isValidPhone(): Boolean {
    val cleaned = this.replace(Regex("[^0-9]"), "")
    return cleaned.length == Constants.PHONE_NUMBER_LENGTH ||
           cleaned.length == 12 && cleaned.startsWith("254") ||
           cleaned.length == 13 && cleaned.startsWith("+254")
}

fun String.isValidPassword(): Boolean {
    return this.length >= Constants.MIN_PASSWORD_LENGTH &&
           this.any { it.isDigit() } &&
           this.any { it.isLetter() }
}

fun String.formatPhoneNumber(): String {
    val cleaned = this.replace(Regex("[^0-9]"), "")
    return when {
        cleaned.startsWith("254") -> "+$cleaned"
        cleaned.startsWith("0") -> "+254${cleaned.substring(1)}"
        cleaned.length == 9 -> "+254$cleaned"
        else -> this
    }
}

fun String.capitalizeWords(): String {
    return this.split(" ").joinToString(" ") { word ->
        word.lowercase().replaceFirstChar { it.uppercase() }
    }
}

// Date Extensions
fun Date.formatToString(pattern: String = Constants.DATE_FORMAT_DISPLAY): String {
    return SimpleDateFormat(pattern, Locale.getDefault()).format(this)
}

fun String.toDate(pattern: String = Constants.DATE_FORMAT_API): Date? {
    return try {
        SimpleDateFormat(pattern, Locale.getDefault()).parse(this)
    } catch (e: Exception) {
        null
    }
}

fun Date.toGreeting(): String {
    val hour = SimpleDateFormat("HH", Locale.getDefault()).format(this).toInt()
    return when (hour) {
        in 0..11 -> "Good Morning"
        in 12..16 -> "Good Afternoon"
        else -> "Good Evening"
    }
}

// Number Extensions
fun Int.toOrdinal(): String {
    return when {
        this % 100 in 11..13 -> "${this}th"
        this % 10 == 1 -> "${this}st"
        this % 10 == 2 -> "${this}nd"
        this % 10 == 3 -> "${this}rd"
        else -> "${this}th"
    }
}

fun Double.formatCurrency(): String {
    return "KES ${String.format(Locale.getDefault(), "%,.2f", this)}"
}

fun Int.formatCurrency(): String {
    return "KES ${String.format(Locale.getDefault(), "%,d", this)}"
}

