package com.vitalnest.app.ui.navigation

/**
 * Sealed class representing all screens in the app
 */
sealed class Screen(val route: String) {
    // Auth Screens
    data object Splash : Screen("splash")
    data object Login : Screen("login")
    data object Register : Screen("register")
    data object ForgotPassword : Screen("forgot_password")
    data object OtpVerification : Screen("otp_verification/{email}") {
        fun createRoute(email: String) = "otp_verification/$email"
    }
    data object ResetPassword : Screen("reset_password/{token}") {
        fun createRoute(token: String) = "reset_password/$token"
    }

    // Main Screens (Bottom Nav)
    data object Dashboard : Screen("dashboard")
    data object Appointments : Screen("appointments")
    data object Health : Screen("health")
    data object Messages : Screen("messages")
    data object Profile : Screen("profile")

    // Appointment Screens
    data object BookAppointment : Screen("book_appointment")
    data object AppointmentDetail : Screen("appointment_detail/{appointmentId}") {
        fun createRoute(appointmentId: String) = "appointment_detail/$appointmentId"
    }
    data object RescheduleAppointment : Screen("reschedule_appointment/{appointmentId}") {
        fun createRoute(appointmentId: String) = "reschedule_appointment/$appointmentId"
    }

    // Health Screens
    data object Vitals : Screen("vitals")
    data object VitalDetail : Screen("vital_detail/{vitalType}") {
        fun createRoute(vitalType: String) = "vital_detail/$vitalType"
    }
    data object Medications : Screen("medications")
    data object MedicationDetail : Screen("medication_detail/{medicationId}") {
        fun createRoute(medicationId: String) = "medication_detail/$medicationId"
    }
    data object LabResults : Screen("lab_results")
    data object LabResultDetail : Screen("lab_result_detail/{resultId}") {
        fun createRoute(resultId: String) = "lab_result_detail/$resultId"
    }
    data object MedicalRecords : Screen("medical_records")

    // Subscription Screens
    data object CurrentPlan : Screen("current_plan")
    data object Packages : Screen("packages")
    data object PackageDetail : Screen("package_detail/{packageId}") {
        fun createRoute(packageId: String) = "package_detail/$packageId"
    }
    data object BillingHistory : Screen("billing_history")
    data object PaymentMethods : Screen("payment_methods")
    data object Payment : Screen("payment/{packageId}") {
        fun createRoute(packageId: String) = "payment/$packageId"
    }

    // Profile Screens
    data object EditProfile : Screen("edit_profile")
    data object Settings : Screen("settings")
    data object EmergencyContacts : Screen("emergency_contacts")
    data object MedicalHistory : Screen("medical_history")
    data object Allergies : Screen("allergies")
    data object ChangePassword : Screen("change_password")
    data object NotificationSettings : Screen("notification_settings")

    // Insurance Screens
    data object Insurance : Screen("insurance")
    data object AddInsurance : Screen("add_insurance")
    data object InsuranceDetail : Screen("insurance_detail/{insuranceId}") {
        fun createRoute(insuranceId: String) = "insurance_detail/$insuranceId"
    }

    // Notifications
    data object Notifications : Screen("notifications")

    // Messaging
    data object Chat : Screen("chat/{conversationId}") {
        fun createRoute(conversationId: String) = "chat/$conversationId"
    }
}

/**
 * Navigation routes grouped by feature
 */
object NavRoutes {
    const val AUTH_GRAPH = "auth_graph"
    const val MAIN_GRAPH = "main_graph"
    const val APPOINTMENTS_GRAPH = "appointments_graph"
    const val HEALTH_GRAPH = "health_graph"
    const val SUBSCRIPTION_GRAPH = "subscription_graph"
    const val PROFILE_GRAPH = "profile_graph"
}

