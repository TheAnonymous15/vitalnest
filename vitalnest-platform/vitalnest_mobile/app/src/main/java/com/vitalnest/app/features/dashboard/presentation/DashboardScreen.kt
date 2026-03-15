package com.vitalnest.app.features.dashboard.presentation

import androidx.compose.foundation.background
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.*
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.LazyRow
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.*
import androidx.compose.material.icons.outlined.*
import androidx.compose.material3.*
import androidx.compose.runtime.*
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.graphics.Brush
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.graphics.vector.ImageVector
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import com.vitalnest.app.ui.components.VitalCard
import com.vitalnest.app.ui.theme.*
import java.util.Date
import com.vitalnest.app.core.utils.toGreeting

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun DashboardScreen(
    onNavigateToAppointments: () -> Unit,
    onNavigateToHealth: () -> Unit,
    onNavigateToCurrentPlan: () -> Unit,
    onNavigateToBookAppointment: () -> Unit,
    onNavigateToNotifications: () -> Unit
) {
    val greeting = remember { Date().toGreeting() }
    val userName = "DK" // This would come from ViewModel

    Scaffold(
        topBar = {
            TopAppBar(
                title = {
                    Column {
                        Text(
                            text = "$greeting 👋",
                            style = MaterialTheme.typography.bodyMedium,
                            color = MaterialTheme.colorScheme.onSurfaceVariant
                        )
                        Text(
                            text = userName,
                            style = MaterialTheme.typography.titleLarge,
                            fontWeight = FontWeight.Bold
                        )
                    }
                },
                actions = {
                    IconButton(onClick = onNavigateToNotifications) {
                        BadgedBox(
                            badge = {
                                Badge(
                                    containerColor = VitalOrange
                                ) {
                                    Text("3")
                                }
                            }
                        ) {
                            Icon(
                                imageVector = Icons.Outlined.Notifications,
                                contentDescription = "Notifications"
                            )
                        }
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
                .padding(horizontal = 16.dp),
            verticalArrangement = Arrangement.spacedBy(16.dp)
        ) {
            item { Spacer(modifier = Modifier.height(8.dp)) }

            // Subscription Card
            item {
                SubscriptionCard(
                    planName = "Premium Plan",
                    validUntil = "Mar 30, 2026",
                    usagePercentage = 0.75f,
                    onClick = onNavigateToCurrentPlan
                )
            }

            // Quick Actions
            item {
                Text(
                    text = "Quick Actions",
                    style = MaterialTheme.typography.titleMedium,
                    fontWeight = FontWeight.SemiBold
                )
                Spacer(modifier = Modifier.height(8.dp))
                QuickActionsRow(
                    onBookAppointment = onNavigateToBookAppointment,
                    onCallEmergency = { /* Handle emergency call */ },
                    onViewMedications = onNavigateToHealth,
                    onViewRecords = onNavigateToHealth
                )
            }

            // Upcoming Appointments
            item {
                Row(
                    modifier = Modifier.fillMaxWidth(),
                    horizontalArrangement = Arrangement.SpaceBetween,
                    verticalAlignment = Alignment.CenterVertically
                ) {
                    Text(
                        text = "Upcoming Appointments",
                        style = MaterialTheme.typography.titleMedium,
                        fontWeight = FontWeight.SemiBold
                    )
                    TextButton(onClick = onNavigateToAppointments) {
                        Text("View All", color = VitalTeal)
                    }
                }

                UpcomingAppointmentCard(
                    doctorName = "Dr. Wanjiku",
                    specialty = "General Check-up",
                    date = "Mar 16, 2026",
                    time = "10:00 AM",
                    onClick = onNavigateToAppointments
                )
            }

            // Health Tips
            item {
                Text(
                    text = "Health Tips",
                    style = MaterialTheme.typography.titleMedium,
                    fontWeight = FontWeight.SemiBold
                )
                Spacer(modifier = Modifier.height(8.dp))
                HealthTipsCarousel()
            }

            // Recent Activity
            item {
                Text(
                    text = "Recent Activity",
                    style = MaterialTheme.typography.titleMedium,
                    fontWeight = FontWeight.SemiBold
                )
                Spacer(modifier = Modifier.height(8.dp))
                RecentActivityList()
            }

            item { Spacer(modifier = Modifier.height(80.dp)) } // Bottom nav spacing
        }
    }
}

@Composable
fun SubscriptionCard(
    planName: String,
    validUntil: String,
    usagePercentage: Float,
    onClick: () -> Unit
) {
    VitalCard(
        onClick = onClick,
        containerColor = MaterialTheme.colorScheme.surface
    ) {
        Row(
            modifier = Modifier.fillMaxWidth(),
            horizontalArrangement = Arrangement.SpaceBetween,
            verticalAlignment = Alignment.CenterVertically
        ) {
            Column {
                Row(
                    verticalAlignment = Alignment.CenterVertically,
                    horizontalArrangement = Arrangement.spacedBy(8.dp)
                ) {
                    Icon(
                        imageVector = Icons.Default.Verified,
                        contentDescription = null,
                        tint = PremiumPlanColor,
                        modifier = Modifier.size(20.dp)
                    )
                    Text(
                        text = planName,
                        style = MaterialTheme.typography.titleMedium,
                        fontWeight = FontWeight.SemiBold
                    )
                }
                Spacer(modifier = Modifier.height(4.dp))
                Text(
                    text = "Valid until: $validUntil",
                    style = MaterialTheme.typography.bodySmall,
                    color = MaterialTheme.colorScheme.onSurfaceVariant
                )
            }

            Icon(
                imageVector = Icons.Default.ChevronRight,
                contentDescription = "View details",
                tint = MaterialTheme.colorScheme.onSurfaceVariant
            )
        }

        Spacer(modifier = Modifier.height(12.dp))

        // Usage Progress
        Column {
            Row(
                modifier = Modifier.fillMaxWidth(),
                horizontalArrangement = Arrangement.SpaceBetween
            ) {
                Text(
                    text = "Monthly Usage",
                    style = MaterialTheme.typography.bodySmall,
                    color = MaterialTheme.colorScheme.onSurfaceVariant
                )
                Text(
                    text = "${(usagePercentage * 100).toInt()}%",
                    style = MaterialTheme.typography.bodySmall,
                    fontWeight = FontWeight.Medium,
                    color = VitalTeal
                )
            }
            Spacer(modifier = Modifier.height(4.dp))
            LinearProgressIndicator(
                progress = { usagePercentage },
                modifier = Modifier
                    .fillMaxWidth()
                    .height(8.dp)
                    .clip(MaterialTheme.shapes.small),
                color = VitalTeal,
                trackColor = VitalTeal.copy(alpha = 0.2f)
            )
        }
    }
}

@Composable
fun QuickActionsRow(
    onBookAppointment: () -> Unit,
    onCallEmergency: () -> Unit,
    onViewMedications: () -> Unit,
    onViewRecords: () -> Unit
) {
    Row(
        modifier = Modifier.fillMaxWidth(),
        horizontalArrangement = Arrangement.SpaceEvenly
    ) {
        QuickActionItem(
            icon = Icons.Default.CalendarMonth,
            label = "Book",
            color = VitalTeal,
            onClick = onBookAppointment
        )
        QuickActionItem(
            icon = Icons.Default.Phone,
            label = "Call",
            color = Error,
            onClick = onCallEmergency
        )
        QuickActionItem(
            icon = Icons.Default.Medication,
            label = "Meds",
            color = Info,
            onClick = onViewMedications
        )
        QuickActionItem(
            icon = Icons.Default.Description,
            label = "Records",
            color = VitalOrange,
            onClick = onViewRecords
        )
    }
}

@Composable
fun QuickActionItem(
    icon: ImageVector,
    label: String,
    color: Color,
    onClick: () -> Unit
) {
    Column(
        horizontalAlignment = Alignment.CenterHorizontally,
        modifier = Modifier.clickable(onClick = onClick)
    ) {
        Box(
            modifier = Modifier
                .size(56.dp)
                .background(
                    color = color.copy(alpha = 0.1f),
                    shape = MaterialTheme.shapes.medium
                ),
            contentAlignment = Alignment.Center
        ) {
            Icon(
                imageVector = icon,
                contentDescription = label,
                tint = color,
                modifier = Modifier.size(28.dp)
            )
        }
        Spacer(modifier = Modifier.height(4.dp))
        Text(
            text = label,
            style = MaterialTheme.typography.labelSmall,
            color = MaterialTheme.colorScheme.onSurfaceVariant
        )
    }
}

@Composable
fun UpcomingAppointmentCard(
    doctorName: String,
    specialty: String,
    date: String,
    time: String,
    onClick: () -> Unit
) {
    VitalCard(onClick = onClick) {
        Row(
            modifier = Modifier.fillMaxWidth(),
            horizontalArrangement = Arrangement.SpaceBetween,
            verticalAlignment = Alignment.CenterVertically
        ) {
            Row(
                horizontalArrangement = Arrangement.spacedBy(12.dp),
                verticalAlignment = Alignment.CenterVertically
            ) {
                Box(
                    modifier = Modifier
                        .size(48.dp)
                        .background(
                            color = VitalTeal.copy(alpha = 0.1f),
                            shape = CircleShape
                        ),
                    contentAlignment = Alignment.Center
                ) {
                    Icon(
                        imageVector = Icons.Default.Person,
                        contentDescription = null,
                        tint = VitalTeal
                    )
                }

                Column {
                    Text(
                        text = doctorName,
                        style = MaterialTheme.typography.titleSmall,
                        fontWeight = FontWeight.SemiBold
                    )
                    Text(
                        text = specialty,
                        style = MaterialTheme.typography.bodySmall,
                        color = MaterialTheme.colorScheme.onSurfaceVariant
                    )
                }
            }

            Column(horizontalAlignment = Alignment.End) {
                Text(
                    text = date,
                    style = MaterialTheme.typography.bodySmall,
                    color = VitalTeal,
                    fontWeight = FontWeight.Medium
                )
                Text(
                    text = time,
                    style = MaterialTheme.typography.bodySmall,
                    color = MaterialTheme.colorScheme.onSurfaceVariant
                )
            }
        }
    }
}

@Composable
fun HealthTipsCarousel() {
    val tips = listOf(
        "💧 Stay hydrated! Drink at least 8 glasses of water daily.",
        "🏃 30 minutes of exercise daily can improve your heart health.",
        "😴 Quality sleep of 7-8 hours is essential for recovery.",
        "🥗 Eat a balanced diet rich in fruits and vegetables."
    )

    LazyRow(
        horizontalArrangement = Arrangement.spacedBy(12.dp)
    ) {
        items(tips.size) { index ->
            Card(
                modifier = Modifier.width(280.dp),
                colors = CardDefaults.cardColors(
                    containerColor = VitalTeal.copy(alpha = 0.1f)
                )
            ) {
                Row(
                    modifier = Modifier.padding(16.dp),
                    verticalAlignment = Alignment.CenterVertically
                ) {
                    Icon(
                        imageVector = Icons.Default.Lightbulb,
                        contentDescription = null,
                        tint = VitalOrange,
                        modifier = Modifier.size(24.dp)
                    )
                    Spacer(modifier = Modifier.width(12.dp))
                    Text(
                        text = tips[index],
                        style = MaterialTheme.typography.bodyMedium
                    )
                }
            }
        }
    }
}

@Composable
fun RecentActivityList() {
    Column(verticalArrangement = Arrangement.spacedBy(8.dp)) {
        ActivityItem(
            icon = Icons.Default.EventAvailable,
            title = "Appointment Completed",
            subtitle = "General Check-up with Dr. Ochieng",
            time = "2 days ago",
            iconColor = Success
        )
        ActivityItem(
            icon = Icons.Default.Science,
            title = "Lab Results Ready",
            subtitle = "Blood test results are available",
            time = "3 days ago",
            iconColor = Info
        )
        ActivityItem(
            icon = Icons.Default.Payment,
            title = "Payment Successful",
            subtitle = "Monthly subscription renewed",
            time = "1 week ago",
            iconColor = VitalTeal
        )
    }
}

@Composable
fun ActivityItem(
    icon: ImageVector,
    title: String,
    subtitle: String,
    time: String,
    iconColor: Color
) {
    Row(
        modifier = Modifier
            .fillMaxWidth()
            .padding(vertical = 8.dp),
        horizontalArrangement = Arrangement.spacedBy(12.dp),
        verticalAlignment = Alignment.CenterVertically
    ) {
        Box(
            modifier = Modifier
                .size(40.dp)
                .background(
                    color = iconColor.copy(alpha = 0.1f),
                    shape = CircleShape
                ),
            contentAlignment = Alignment.Center
        ) {
            Icon(
                imageVector = icon,
                contentDescription = null,
                tint = iconColor,
                modifier = Modifier.size(20.dp)
            )
        }

        Column(modifier = Modifier.weight(1f)) {
            Text(
                text = title,
                style = MaterialTheme.typography.bodyMedium,
                fontWeight = FontWeight.Medium
            )
            Text(
                text = subtitle,
                style = MaterialTheme.typography.bodySmall,
                color = MaterialTheme.colorScheme.onSurfaceVariant
            )
        }

        Text(
            text = time,
            style = MaterialTheme.typography.labelSmall,
            color = MaterialTheme.colorScheme.onSurfaceVariant
        )
    }
}

