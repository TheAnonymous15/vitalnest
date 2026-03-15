package com.vitalnest.app.features.auth.presentation

import androidx.compose.foundation.background
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.*
import androidx.compose.foundation.rememberScrollState
import androidx.compose.foundation.verticalScroll
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.automirrored.filled.ArrowBack
import androidx.compose.material.icons.filled.*
import androidx.compose.material3.*
import androidx.compose.runtime.*
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Brush
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.text.input.ImeAction
import androidx.compose.ui.text.input.KeyboardType
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import com.vitalnest.app.ui.components.ErrorDialog
import com.vitalnest.app.ui.components.VitalButton
import com.vitalnest.app.ui.components.VitalTextField
import com.vitalnest.app.ui.theme.*

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun RegisterScreen(
    onNavigateToLogin: () -> Unit,
    onRegisterSuccess: (String) -> Unit,
    viewModel: RegisterViewModel = hiltViewModel()
) {
    val uiState by viewModel.uiState.collectAsStateWithLifecycle()

    // Handle successful registration
    LaunchedEffect(uiState.registerSuccess) {
        if (uiState.registerSuccess) {
            onRegisterSuccess(uiState.email)
        }
    }

    // Show error dialog
    if (uiState.generalError != null) {
        ErrorDialog(
            message = uiState.generalError!!,
            onDismiss = { viewModel.onEvent(RegisterEvent.ClearError) }
        )
    }

    Box(
        modifier = Modifier
            .fillMaxSize()
            .background(
                brush = Brush.verticalGradient(
                    colors = listOf(DarkBackground, MediumBackground)
                )
            )
    ) {
        Column(
            modifier = Modifier
                .fillMaxSize()
                .verticalScroll(rememberScrollState())
        ) {
            // Top Bar
            TopAppBar(
                title = { },
                navigationIcon = {
                    IconButton(onClick = onNavigateToLogin) {
                        Icon(
                            imageVector = Icons.AutoMirrored.Filled.ArrowBack,
                            contentDescription = "Back",
                            tint = TextPrimary
                        )
                    }
                },
                colors = TopAppBarDefaults.topAppBarColors(
                    containerColor = androidx.compose.ui.graphics.Color.Transparent
                )
            )

            Column(
                modifier = Modifier
                    .fillMaxWidth()
                    .padding(horizontal = 24.dp),
                horizontalAlignment = Alignment.CenterHorizontally
            ) {
                // Header
                Text(
                    text = "Create Account",
                    style = MaterialTheme.typography.headlineMedium,
                    color = TextPrimary,
                    fontWeight = FontWeight.Bold
                )

                Spacer(modifier = Modifier.height(8.dp))

                Text(
                    text = "Join VitalNest and take control of your health",
                    style = MaterialTheme.typography.bodyMedium,
                    color = TextSecondary
                )

                Spacer(modifier = Modifier.height(32.dp))

                // First Name
                VitalTextField(
                    value = uiState.firstName,
                    onValueChange = { viewModel.onEvent(RegisterEvent.FirstNameChanged(it)) },
                    label = "First Name",
                    placeholder = "Enter your first name",
                    leadingIcon = Icons.Default.Person,
                    imeAction = ImeAction.Next,
                    isError = uiState.firstNameError != null,
                    errorMessage = uiState.firstNameError,
                    enabled = !uiState.isLoading
                )

                Spacer(modifier = Modifier.height(16.dp))

                // Last Name
                VitalTextField(
                    value = uiState.lastName,
                    onValueChange = { viewModel.onEvent(RegisterEvent.LastNameChanged(it)) },
                    label = "Last Name",
                    placeholder = "Enter your last name",
                    leadingIcon = Icons.Default.Person,
                    imeAction = ImeAction.Next,
                    isError = uiState.lastNameError != null,
                    errorMessage = uiState.lastNameError,
                    enabled = !uiState.isLoading
                )

                Spacer(modifier = Modifier.height(16.dp))

                // Email
                VitalTextField(
                    value = uiState.email,
                    onValueChange = { viewModel.onEvent(RegisterEvent.EmailChanged(it)) },
                    label = "Email",
                    placeholder = "Enter your email",
                    leadingIcon = Icons.Default.Email,
                    keyboardType = KeyboardType.Email,
                    imeAction = ImeAction.Next,
                    isError = uiState.emailError != null,
                    errorMessage = uiState.emailError,
                    enabled = !uiState.isLoading
                )

                Spacer(modifier = Modifier.height(16.dp))

                // Phone
                VitalTextField(
                    value = uiState.phone,
                    onValueChange = { viewModel.onEvent(RegisterEvent.PhoneChanged(it)) },
                    label = "Phone Number",
                    placeholder = "e.g., 0712345678",
                    leadingIcon = Icons.Default.Phone,
                    keyboardType = KeyboardType.Phone,
                    imeAction = ImeAction.Next,
                    isError = uiState.phoneError != null,
                    errorMessage = uiState.phoneError,
                    enabled = !uiState.isLoading
                )

                Spacer(modifier = Modifier.height(16.dp))

                // Password
                VitalTextField(
                    value = uiState.password,
                    onValueChange = { viewModel.onEvent(RegisterEvent.PasswordChanged(it)) },
                    label = "Password",
                    placeholder = "Create a strong password",
                    leadingIcon = Icons.Default.Lock,
                    isPassword = true,
                    imeAction = ImeAction.Next,
                    isError = uiState.passwordError != null,
                    errorMessage = uiState.passwordError,
                    enabled = !uiState.isLoading
                )

                Spacer(modifier = Modifier.height(16.dp))

                // Confirm Password
                VitalTextField(
                    value = uiState.confirmPassword,
                    onValueChange = { viewModel.onEvent(RegisterEvent.ConfirmPasswordChanged(it)) },
                    label = "Confirm Password",
                    placeholder = "Re-enter your password",
                    leadingIcon = Icons.Default.Lock,
                    isPassword = true,
                    imeAction = ImeAction.Done,
                    isError = uiState.confirmPasswordError != null,
                    errorMessage = uiState.confirmPasswordError,
                    enabled = !uiState.isLoading,
                    onImeAction = { viewModel.onEvent(RegisterEvent.Register) }
                )

                Spacer(modifier = Modifier.height(16.dp))

                // Terms and Conditions
                Row(
                    modifier = Modifier
                        .fillMaxWidth()
                        .clickable(enabled = !uiState.isLoading) {
                            viewModel.onEvent(RegisterEvent.AcceptTermsChanged(!uiState.acceptTerms))
                        },
                    verticalAlignment = Alignment.CenterVertically
                ) {
                    Checkbox(
                        checked = uiState.acceptTerms,
                        onCheckedChange = { viewModel.onEvent(RegisterEvent.AcceptTermsChanged(it)) },
                        enabled = !uiState.isLoading,
                        colors = CheckboxDefaults.colors(
                            checkedColor = VitalTeal,
                            uncheckedColor = TextMuted
                        )
                    )
                    Text(
                        text = "I agree to the ",
                        style = MaterialTheme.typography.bodySmall,
                        color = TextSecondary
                    )
                    Text(
                        text = "Terms & Conditions",
                        style = MaterialTheme.typography.bodySmall,
                        color = VitalTeal,
                        fontWeight = FontWeight.Medium
                    )
                    Text(
                        text = " and ",
                        style = MaterialTheme.typography.bodySmall,
                        color = TextSecondary
                    )
                    Text(
                        text = "Privacy Policy",
                        style = MaterialTheme.typography.bodySmall,
                        color = VitalTeal,
                        fontWeight = FontWeight.Medium
                    )
                }

                Spacer(modifier = Modifier.height(24.dp))

                // Register Button
                VitalButton(
                    text = "Create Account",
                    onClick = { viewModel.onEvent(RegisterEvent.Register) },
                    isLoading = uiState.isLoading,
                    enabled = !uiState.isLoading
                )

                Spacer(modifier = Modifier.height(24.dp))

                // Login Link
                Row(
                    horizontalArrangement = Arrangement.Center,
                    verticalAlignment = Alignment.CenterVertically
                ) {
                    Text(
                        text = "Already have an account? ",
                        style = MaterialTheme.typography.bodyMedium,
                        color = TextSecondary
                    )
                    TextButton(
                        onClick = onNavigateToLogin,
                        enabled = !uiState.isLoading
                    ) {
                        Text(
                            text = "Sign In",
                            style = MaterialTheme.typography.bodyMedium,
                            color = VitalTeal,
                            fontWeight = FontWeight.SemiBold
                        )
                    }
                }

                Spacer(modifier = Modifier.height(32.dp))
            }
        }
    }
}

