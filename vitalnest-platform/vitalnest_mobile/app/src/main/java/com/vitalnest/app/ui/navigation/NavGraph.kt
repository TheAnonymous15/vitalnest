package com.vitalnest.app.ui.navigation

import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.navigation.NavHostController
import androidx.navigation.NavType
import androidx.navigation.compose.NavHost
import androidx.navigation.compose.composable
import androidx.navigation.navArgument
import com.vitalnest.app.features.auth.presentation.ForgotPasswordScreen
import com.vitalnest.app.features.auth.presentation.LoginScreen
import com.vitalnest.app.features.auth.presentation.OtpVerificationScreen
import com.vitalnest.app.features.auth.presentation.RegisterScreen
import com.vitalnest.app.features.auth.presentation.SplashScreen
import com.vitalnest.app.features.dashboard.presentation.DashboardScreen
import com.vitalnest.app.features.appointments.presentation.AppointmentsScreen
import com.vitalnest.app.features.appointments.presentation.BookAppointmentScreen
import com.vitalnest.app.features.health.presentation.HealthScreen
import com.vitalnest.app.features.messaging.presentation.MessagesScreen
import com.vitalnest.app.features.profile.presentation.ProfileScreen
import com.vitalnest.app.features.profile.presentation.EditProfileScreen
import com.vitalnest.app.features.profile.presentation.SettingsScreen
import com.vitalnest.app.features.subscription.presentation.CurrentPlanScreen
import com.vitalnest.app.features.subscription.presentation.PackagesScreen

@Composable
fun NavGraph(
    navController: NavHostController,
    startDestination: String,
    modifier: Modifier = Modifier
) {
    NavHost(
        navController = navController,
        startDestination = startDestination,
        modifier = modifier
    ) {
        // Splash Screen
        composable(Screen.Splash.route) {
            SplashScreen(
                onSplashComplete = {
                    navController.navigate(Screen.Login.route) {
                        popUpTo(Screen.Splash.route) { inclusive = true }
                    }
                }
            )
        }

        // Auth Screens
        composable(Screen.Login.route) {
            LoginScreen(
                onNavigateToRegister = {
                    navController.navigate(Screen.Register.route)
                },
                onNavigateToForgotPassword = {
                    navController.navigate(Screen.ForgotPassword.route)
                },
                onLoginSuccess = {
                    navController.navigate(Screen.Dashboard.route) {
                        popUpTo(Screen.Login.route) { inclusive = true }
                    }
                }
            )
        }

        composable(Screen.Register.route) {
            RegisterScreen(
                onNavigateToLogin = {
                    navController.popBackStack()
                },
                onRegisterSuccess = { email ->
                    navController.navigate(Screen.OtpVerification.createRoute(email))
                }
            )
        }

        composable(Screen.ForgotPassword.route) {
            ForgotPasswordScreen(
                onNavigateBack = {
                    navController.popBackStack()
                },
                onOtpSent = { email ->
                    navController.navigate(Screen.OtpVerification.createRoute(email))
                }
            )
        }

        composable(
            route = Screen.OtpVerification.route,
            arguments = listOf(navArgument("email") { type = NavType.StringType })
        ) { backStackEntry ->
            val email = backStackEntry.arguments?.getString("email") ?: ""
            OtpVerificationScreen(
                email = email,
                onNavigateBack = {
                    navController.popBackStack()
                },
                onVerificationSuccess = {
                    navController.navigate(Screen.Dashboard.route) {
                        popUpTo(Screen.Login.route) { inclusive = true }
                    }
                }
            )
        }

        // Main Screens (Bottom Nav)
        composable(Screen.Dashboard.route) {
            DashboardScreen(
                onNavigateToAppointments = {
                    navController.navigate(Screen.Appointments.route)
                },
                onNavigateToHealth = {
                    navController.navigate(Screen.Health.route)
                },
                onNavigateToCurrentPlan = {
                    navController.navigate(Screen.CurrentPlan.route)
                },
                onNavigateToBookAppointment = {
                    navController.navigate(Screen.BookAppointment.route)
                },
                onNavigateToNotifications = {
                    navController.navigate(Screen.Notifications.route)
                }
            )
        }

        composable(Screen.Appointments.route) {
            AppointmentsScreen(
                onNavigateToBookAppointment = {
                    navController.navigate(Screen.BookAppointment.route)
                },
                onNavigateToAppointmentDetail = { appointmentId ->
                    navController.navigate(Screen.AppointmentDetail.createRoute(appointmentId))
                }
            )
        }

        composable(Screen.BookAppointment.route) {
            BookAppointmentScreen(
                onNavigateBack = {
                    navController.popBackStack()
                },
                onBookingSuccess = {
                    navController.popBackStack()
                }
            )
        }

        composable(Screen.Health.route) {
            HealthScreen(
                onNavigateToVitals = {
                    navController.navigate(Screen.Vitals.route)
                },
                onNavigateToMedications = {
                    navController.navigate(Screen.Medications.route)
                },
                onNavigateToLabResults = {
                    navController.navigate(Screen.LabResults.route)
                },
                onNavigateToMedicalRecords = {
                    navController.navigate(Screen.MedicalRecords.route)
                }
            )
        }

        composable(Screen.Messages.route) {
            MessagesScreen(
                onNavigateToChat = { conversationId ->
                    navController.navigate(Screen.Chat.createRoute(conversationId))
                }
            )
        }

        composable(Screen.Profile.route) {
            ProfileScreen(
                onNavigateToEditProfile = {
                    navController.navigate(Screen.EditProfile.route)
                },
                onNavigateToSettings = {
                    navController.navigate(Screen.Settings.route)
                },
                onNavigateToCurrentPlan = {
                    navController.navigate(Screen.CurrentPlan.route)
                },
                onNavigateToInsurance = {
                    navController.navigate(Screen.Insurance.route)
                },
                onLogout = {
                    navController.navigate(Screen.Login.route) {
                        popUpTo(0) { inclusive = true }
                    }
                }
            )
        }

        composable(Screen.EditProfile.route) {
            EditProfileScreen(
                onNavigateBack = {
                    navController.popBackStack()
                }
            )
        }

        composable(Screen.Settings.route) {
            SettingsScreen(
                onNavigateBack = {
                    navController.popBackStack()
                },
                onNavigateToChangePassword = {
                    navController.navigate(Screen.ChangePassword.route)
                },
                onNavigateToNotificationSettings = {
                    navController.navigate(Screen.NotificationSettings.route)
                }
            )
        }

        // Subscription Screens
        composable(Screen.CurrentPlan.route) {
            CurrentPlanScreen(
                onNavigateBack = {
                    navController.popBackStack()
                },
                onNavigateToPackages = {
                    navController.navigate(Screen.Packages.route)
                },
                onNavigateToBillingHistory = {
                    navController.navigate(Screen.BillingHistory.route)
                }
            )
        }

        composable(Screen.Packages.route) {
            PackagesScreen(
                onNavigateBack = {
                    navController.popBackStack()
                },
                onNavigateToPackageDetail = { packageId ->
                    navController.navigate(Screen.PackageDetail.createRoute(packageId))
                }
            )
        }

        // Notifications
        composable(Screen.Notifications.route) {
            // NotificationsScreen - to be implemented
        }
    }
}

