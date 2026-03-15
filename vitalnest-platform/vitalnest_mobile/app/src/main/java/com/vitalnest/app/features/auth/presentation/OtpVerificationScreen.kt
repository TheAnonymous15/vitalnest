package com.vitalnest.app.features.auth.presentation

import androidx.compose.foundation.background
import androidx.compose.foundation.border
import androidx.compose.foundation.layout.*
import androidx.compose.foundation.rememberScrollState
import androidx.compose.foundation.text.BasicTextField
import androidx.compose.foundation.text.KeyboardOptions
import androidx.compose.foundation.verticalScroll
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.automirrored.filled.ArrowBack
import androidx.compose.material.icons.filled.Security
import androidx.compose.material3.*
import androidx.compose.runtime.*
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.focus.FocusRequester
import androidx.compose.ui.focus.focusRequester
import androidx.compose.ui.graphics.Brush
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.text.TextStyle
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.text.input.KeyboardType
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp
import com.vitalnest.app.ui.components.VitalButton
import com.vitalnest.app.ui.theme.*
import kotlinx.coroutines.delay

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun OtpVerificationScreen(
    email: String,
    onNavigateBack: () -> Unit,
    onVerificationSuccess: () -> Unit
) {
    var otpValue by remember { mutableStateOf("") }
    var isLoading by remember { mutableStateOf(false) }
    var error by remember { mutableStateOf<String?>(null) }
    var resendTimer by remember { mutableStateOf(60) }
    var canResend by remember { mutableStateOf(false) }

    val focusRequester = remember { FocusRequester() }

    // Timer for resend
    LaunchedEffect(resendTimer) {
        if (resendTimer > 0) {
            delay(1000)
            resendTimer--
        } else {
            canResend = true
        }
    }

    // Auto-focus on OTP field
    LaunchedEffect(Unit) {
        focusRequester.requestFocus()
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
                    IconButton(onClick = onNavigateBack) {
                        Icon(
                            imageVector = Icons.AutoMirrored.Filled.ArrowBack,
                            contentDescription = "Back",
                            tint = TextPrimary
                        )
                    }
                },
                colors = TopAppBarDefaults.topAppBarColors(
                    containerColor = Color.Transparent
                )
            )

            Column(
                modifier = Modifier
                    .fillMaxWidth()
                    .padding(horizontal = 24.dp),
                horizontalAlignment = Alignment.CenterHorizontally
            ) {
                Spacer(modifier = Modifier.height(40.dp))

                // Icon
                Box(
                    modifier = Modifier
                        .size(80.dp)
                        .background(
                            color = VitalTeal.copy(alpha = 0.1f),
                            shape = MaterialTheme.shapes.large
                        ),
                    contentAlignment = Alignment.Center
                ) {
                    Icon(
                        imageVector = Icons.Default.Security,
                        contentDescription = null,
                        modifier = Modifier.size(40.dp),
                        tint = VitalTeal
                    )
                }

                Spacer(modifier = Modifier.height(24.dp))

                // Header
                Text(
                    text = "Verify Your Email",
                    style = MaterialTheme.typography.headlineMedium,
                    color = TextPrimary,
                    fontWeight = FontWeight.Bold
                )

                Spacer(modifier = Modifier.height(8.dp))

                Text(
                    text = "We've sent a 6-digit verification code to",
                    style = MaterialTheme.typography.bodyMedium,
                    color = TextSecondary,
                    textAlign = TextAlign.Center
                )

                Text(
                    text = email,
                    style = MaterialTheme.typography.bodyMedium,
                    color = VitalTeal,
                    fontWeight = FontWeight.Medium
                )

                Spacer(modifier = Modifier.height(40.dp))

                // OTP Input
                BasicTextField(
                    value = otpValue,
                    onValueChange = { value ->
                        if (value.length <= 6 && value.all { it.isDigit() }) {
                            otpValue = value
                            error = null

                            // Auto-submit when 6 digits entered
                            if (value.length == 6) {
                                isLoading = true
                                // Verify OTP - simulate success for now
                                onVerificationSuccess()
                            }
                        }
                    },
                    keyboardOptions = KeyboardOptions(keyboardType = KeyboardType.NumberPassword),
                    modifier = Modifier.focusRequester(focusRequester),
                    decorationBox = {
                        Row(
                            horizontalArrangement = Arrangement.spacedBy(8.dp),
                            verticalAlignment = Alignment.CenterVertically
                        ) {
                            repeat(6) { index ->
                                val char = otpValue.getOrNull(index)?.toString() ?: ""
                                val isFocused = otpValue.length == index

                                Box(
                                    modifier = Modifier
                                        .size(50.dp)
                                        .background(
                                            color = if (char.isNotEmpty()) VitalTeal.copy(alpha = 0.1f)
                                                   else LightBackground,
                                            shape = MaterialTheme.shapes.medium
                                        )
                                        .border(
                                            width = if (isFocused) 2.dp else 1.dp,
                                            color = when {
                                                error != null -> Error
                                                isFocused -> VitalTeal
                                                char.isNotEmpty() -> VitalTeal
                                                else -> TextMuted.copy(alpha = 0.3f)
                                            },
                                            shape = MaterialTheme.shapes.medium
                                        ),
                                    contentAlignment = Alignment.Center
                                ) {
                                    Text(
                                        text = char,
                                        style = TextStyle(
                                            fontSize = 24.sp,
                                            fontWeight = FontWeight.Bold,
                                            color = TextPrimary
                                        )
                                    )
                                }
                            }
                        }
                    }
                )

                // Error message
                error?.let { errorMessage ->
                    Spacer(modifier = Modifier.height(16.dp))
                    Text(
                        text = errorMessage,
                        style = MaterialTheme.typography.bodySmall,
                        color = Error
                    )
                }

                Spacer(modifier = Modifier.height(32.dp))

                // Verify Button
                VitalButton(
                    text = "Verify",
                    onClick = {
                        if (otpValue.length != 6) {
                            error = "Please enter the complete 6-digit code"
                        } else {
                            isLoading = true
                            onVerificationSuccess()
                        }
                    },
                    isLoading = isLoading,
                    enabled = !isLoading && otpValue.length == 6
                )

                Spacer(modifier = Modifier.height(24.dp))

                // Resend code
                Row(
                    horizontalArrangement = Arrangement.Center,
                    verticalAlignment = Alignment.CenterVertically
                ) {
                    Text(
                        text = "Didn't receive the code? ",
                        style = MaterialTheme.typography.bodyMedium,
                        color = TextSecondary
                    )

                    if (canResend) {
                        TextButton(onClick = {
                            canResend = false
                            resendTimer = 60
                            // Resend OTP API call
                        }) {
                            Text(
                                text = "Resend",
                                style = MaterialTheme.typography.bodyMedium,
                                color = VitalTeal,
                                fontWeight = FontWeight.SemiBold
                            )
                        }
                    } else {
                        Text(
                            text = "Resend in ${resendTimer}s",
                            style = MaterialTheme.typography.bodyMedium,
                            color = TextMuted
                        )
                    }
                }

                Spacer(modifier = Modifier.height(32.dp))
            }
        }
    }
}

