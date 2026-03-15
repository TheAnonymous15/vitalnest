package com.vitalnest.app.features.profile.presentation

import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.*
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.automirrored.filled.ArrowBack
import androidx.compose.material.icons.filled.*
import androidx.compose.material3.*
import androidx.compose.runtime.*
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.vector.ImageVector
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import com.vitalnest.app.ui.theme.*

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun SettingsScreen(
    onNavigateBack: () -> Unit,
    onNavigateToChangePassword: () -> Unit,
    onNavigateToNotificationSettings: () -> Unit
) {
    var isDarkMode by remember { mutableStateOf(true) }
    var isBiometricEnabled by remember { mutableStateOf(false) }

    Scaffold(
        topBar = {
            TopAppBar(
                title = {
                    Text(
                        text = "Settings",
                        style = MaterialTheme.typography.titleLarge,
                        fontWeight = FontWeight.Bold
                    )
                },
                navigationIcon = {
                    IconButton(onClick = onNavigateBack) {
                        Icon(
                            imageVector = Icons.AutoMirrored.Filled.ArrowBack,
                            contentDescription = "Back"
                        )
                    }
                },
                colors = TopAppBarDefaults.topAppBarColors(
                    containerColor = MaterialTheme.colorScheme.background
                )
            )
        }
    ) { paddingValues ->
        LazyColumn(
            modifier = Modifier
                .fillMaxSize()
                .padding(paddingValues)
                .padding(16.dp),
            verticalArrangement = Arrangement.spacedBy(8.dp)
        ) {
            // Account Settings
            item {
                Text(
                    text = "Account",
                    style = MaterialTheme.typography.titleSmall,
                    fontWeight = FontWeight.SemiBold,
                    color = MaterialTheme.colorScheme.onSurfaceVariant,
                    modifier = Modifier.padding(start = 8.dp, bottom = 8.dp)
                )

                Card(
                    colors = CardDefaults.cardColors(
                        containerColor = MaterialTheme.colorScheme.surface
                    )
                ) {
                    Column {
                        SettingsItem(
                            icon = Icons.Default.Lock,
                            title = "Change Password",
                            onClick = onNavigateToChangePassword
                        )
                        HorizontalDivider(modifier = Modifier.padding(start = 56.dp))
                        SettingsItem(
                            icon = Icons.Default.Email,
                            title = "Change Email",
                            onClick = { }
                        )
                        HorizontalDivider(modifier = Modifier.padding(start = 56.dp))
                        SettingsItem(
                            icon = Icons.Default.Phone,
                            title = "Change Phone Number",
                            onClick = { }
                        )
                    }
                }
            }

            // Security Settings
            item {
                Spacer(modifier = Modifier.height(16.dp))
                Text(
                    text = "Security",
                    style = MaterialTheme.typography.titleSmall,
                    fontWeight = FontWeight.SemiBold,
                    color = MaterialTheme.colorScheme.onSurfaceVariant,
                    modifier = Modifier.padding(start = 8.dp, bottom = 8.dp)
                )

                Card(
                    colors = CardDefaults.cardColors(
                        containerColor = MaterialTheme.colorScheme.surface
                    )
                ) {
                    Column {
                        SettingsToggleItem(
                            icon = Icons.Default.Fingerprint,
                            title = "Biometric Login",
                            subtitle = "Use fingerprint or face to login",
                            isChecked = isBiometricEnabled,
                            onCheckedChange = { isBiometricEnabled = it }
                        )
                        HorizontalDivider(modifier = Modifier.padding(start = 56.dp))
                        SettingsItem(
                            icon = Icons.Default.Security,
                            title = "Two-Factor Authentication",
                            onClick = { }
                        )
                    }
                }
            }

            // Notifications
            item {
                Spacer(modifier = Modifier.height(16.dp))
                Text(
                    text = "Notifications",
                    style = MaterialTheme.typography.titleSmall,
                    fontWeight = FontWeight.SemiBold,
                    color = MaterialTheme.colorScheme.onSurfaceVariant,
                    modifier = Modifier.padding(start = 8.dp, bottom = 8.dp)
                )

                Card(
                    colors = CardDefaults.cardColors(
                        containerColor = MaterialTheme.colorScheme.surface
                    )
                ) {
                    SettingsItem(
                        icon = Icons.Default.Notifications,
                        title = "Notification Preferences",
                        onClick = onNavigateToNotificationSettings
                    )
                }
            }

            // Appearance
            item {
                Spacer(modifier = Modifier.height(16.dp))
                Text(
                    text = "Appearance",
                    style = MaterialTheme.typography.titleSmall,
                    fontWeight = FontWeight.SemiBold,
                    color = MaterialTheme.colorScheme.onSurfaceVariant,
                    modifier = Modifier.padding(start = 8.dp, bottom = 8.dp)
                )

                Card(
                    colors = CardDefaults.cardColors(
                        containerColor = MaterialTheme.colorScheme.surface
                    )
                ) {
                    Column {
                        SettingsToggleItem(
                            icon = Icons.Default.DarkMode,
                            title = "Dark Mode",
                            subtitle = "Use dark theme",
                            isChecked = isDarkMode,
                            onCheckedChange = { isDarkMode = it }
                        )
                        HorizontalDivider(modifier = Modifier.padding(start = 56.dp))
                        SettingsItem(
                            icon = Icons.Default.Language,
                            title = "Language",
                            subtitle = "English",
                            onClick = { }
                        )
                    }
                }
            }

            // Data & Storage
            item {
                Spacer(modifier = Modifier.height(16.dp))
                Text(
                    text = "Data & Storage",
                    style = MaterialTheme.typography.titleSmall,
                    fontWeight = FontWeight.SemiBold,
                    color = MaterialTheme.colorScheme.onSurfaceVariant,
                    modifier = Modifier.padding(start = 8.dp, bottom = 8.dp)
                )

                Card(
                    colors = CardDefaults.cardColors(
                        containerColor = MaterialTheme.colorScheme.surface
                    )
                ) {
                    Column {
                        SettingsItem(
                            icon = Icons.Default.Download,
                            title = "Download My Data",
                            onClick = { }
                        )
                        HorizontalDivider(modifier = Modifier.padding(start = 56.dp))
                        SettingsItem(
                            icon = Icons.Default.Delete,
                            title = "Clear Cache",
                            onClick = { }
                        )
                        HorizontalDivider(modifier = Modifier.padding(start = 56.dp))
                        SettingsItem(
                            icon = Icons.Default.DeleteForever,
                            title = "Delete Account",
                            titleColor = Error,
                            onClick = { }
                        )
                    }
                }
            }
        }
    }
}

@Composable
fun SettingsItem(
    icon: ImageVector,
    title: String,
    subtitle: String? = null,
    titleColor: androidx.compose.ui.graphics.Color = MaterialTheme.colorScheme.onSurface,
    onClick: () -> Unit
) {
    Row(
        modifier = Modifier
            .fillMaxWidth()
            .clickable(onClick = onClick)
            .padding(16.dp),
        horizontalArrangement = Arrangement.spacedBy(16.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        Icon(
            imageVector = icon,
            contentDescription = null,
            tint = MaterialTheme.colorScheme.onSurfaceVariant
        )

        Column(modifier = Modifier.weight(1f)) {
            Text(
                text = title,
                style = MaterialTheme.typography.bodyLarge,
                color = titleColor
            )
            if (subtitle != null) {
                Text(
                    text = subtitle,
                    style = MaterialTheme.typography.bodySmall,
                    color = MaterialTheme.colorScheme.onSurfaceVariant
                )
            }
        }

        Icon(
            imageVector = Icons.Default.ChevronRight,
            contentDescription = null,
            tint = MaterialTheme.colorScheme.onSurfaceVariant
        )
    }
}

@Composable
fun SettingsToggleItem(
    icon: ImageVector,
    title: String,
    subtitle: String? = null,
    isChecked: Boolean,
    onCheckedChange: (Boolean) -> Unit
) {
    Row(
        modifier = Modifier
            .fillMaxWidth()
            .clickable { onCheckedChange(!isChecked) }
            .padding(16.dp),
        horizontalArrangement = Arrangement.spacedBy(16.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        Icon(
            imageVector = icon,
            contentDescription = null,
            tint = MaterialTheme.colorScheme.onSurfaceVariant
        )

        Column(modifier = Modifier.weight(1f)) {
            Text(
                text = title,
                style = MaterialTheme.typography.bodyLarge
            )
            if (subtitle != null) {
                Text(
                    text = subtitle,
                    style = MaterialTheme.typography.bodySmall,
                    color = MaterialTheme.colorScheme.onSurfaceVariant
                )
            }
        }

        Switch(
            checked = isChecked,
            onCheckedChange = onCheckedChange,
            colors = SwitchDefaults.colors(
                checkedThumbColor = VitalTeal,
                checkedTrackColor = VitalTeal.copy(alpha = 0.5f)
            )
        )
    }
}

