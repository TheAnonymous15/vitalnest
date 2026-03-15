package com.vitalnest.app.ui.components

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.width
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.Error
import androidx.compose.material.icons.filled.Info
import androidx.compose.material.icons.filled.Warning
import androidx.compose.material3.AlertDialog
import androidx.compose.material3.Icon
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.material3.TextButton
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.graphics.vector.ImageVector
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.dp
import com.vitalnest.app.ui.theme.Error
import com.vitalnest.app.ui.theme.Info
import com.vitalnest.app.ui.theme.VitalTeal
import com.vitalnest.app.ui.theme.Warning

@Composable
fun ErrorDialog(
    title: String = "Error",
    message: String,
    onDismiss: () -> Unit,
    onRetry: (() -> Unit)? = null
) {
    VitalDialog(
        icon = Icons.Default.Error,
        iconColor = Error,
        title = title,
        message = message,
        confirmButtonText = onRetry?.let { "Retry" } ?: "OK",
        onConfirm = onRetry ?: onDismiss,
        dismissButtonText = if (onRetry != null) "Cancel" else null,
        onDismiss = onDismiss
    )
}

@Composable
fun WarningDialog(
    title: String = "Warning",
    message: String,
    confirmButtonText: String = "Continue",
    onConfirm: () -> Unit,
    onDismiss: () -> Unit
) {
    VitalDialog(
        icon = Icons.Default.Warning,
        iconColor = Warning,
        title = title,
        message = message,
        confirmButtonText = confirmButtonText,
        onConfirm = onConfirm,
        dismissButtonText = "Cancel",
        onDismiss = onDismiss
    )
}

@Composable
fun InfoDialog(
    title: String = "Information",
    message: String,
    onDismiss: () -> Unit
) {
    VitalDialog(
        icon = Icons.Default.Info,
        iconColor = Info,
        title = title,
        message = message,
        confirmButtonText = "OK",
        onConfirm = onDismiss,
        onDismiss = onDismiss
    )
}

@Composable
fun ConfirmationDialog(
    title: String,
    message: String,
    confirmButtonText: String = "Confirm",
    dismissButtonText: String = "Cancel",
    onConfirm: () -> Unit,
    onDismiss: () -> Unit,
    isDestructive: Boolean = false
) {
    AlertDialog(
        onDismissRequest = onDismiss,
        title = {
            Text(
                text = title,
                style = MaterialTheme.typography.titleLarge
            )
        },
        text = {
            Text(
                text = message,
                style = MaterialTheme.typography.bodyMedium
            )
        },
        confirmButton = {
            TextButton(onClick = onConfirm) {
                Text(
                    text = confirmButtonText,
                    color = if (isDestructive) Error else VitalTeal
                )
            }
        },
        dismissButton = {
            TextButton(onClick = onDismiss) {
                Text(
                    text = dismissButtonText,
                    color = MaterialTheme.colorScheme.onSurfaceVariant
                )
            }
        }
    )
}

@Composable
fun VitalDialog(
    icon: ImageVector,
    iconColor: Color,
    title: String,
    message: String,
    confirmButtonText: String,
    onConfirm: () -> Unit,
    dismissButtonText: String? = null,
    onDismiss: () -> Unit
) {
    AlertDialog(
        onDismissRequest = onDismiss,
        icon = {
            Icon(
                imageVector = icon,
                contentDescription = null,
                modifier = Modifier.size(48.dp),
                tint = iconColor
            )
        },
        title = {
            Text(
                text = title,
                style = MaterialTheme.typography.titleLarge,
                textAlign = TextAlign.Center
            )
        },
        text = {
            Text(
                text = message,
                style = MaterialTheme.typography.bodyMedium,
                textAlign = TextAlign.Center,
                modifier = Modifier.fillMaxWidth()
            )
        },
        confirmButton = {
            Row(
                modifier = Modifier.fillMaxWidth(),
                horizontalArrangement = Arrangement.Center
            ) {
                if (dismissButtonText != null) {
                    TextButton(onClick = onDismiss) {
                        Text(
                            text = dismissButtonText,
                            color = MaterialTheme.colorScheme.onSurfaceVariant
                        )
                    }
                    Spacer(modifier = Modifier.width(8.dp))
                }
                TextButton(onClick = onConfirm) {
                    Text(
                        text = confirmButtonText,
                        color = VitalTeal
                    )
                }
            }
        }
    )
}

