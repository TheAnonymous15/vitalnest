package com.vitalnest.app.features.health.presentation

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.*
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.items
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.CheckCircle
import androidx.compose.material.icons.filled.Favorite
import androidx.compose.material.icons.filled.Medication
import androidx.compose.material.icons.filled.Science
import androidx.compose.material.icons.filled.FolderOpen
import androidx.compose.material3.*
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.graphics.vector.ImageVector
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import com.vitalnest.app.ui.theme.*

@Composable
fun HealthScreen(
    onNavigateToVitals: () -> Unit,
    onNavigateToMedications: () -> Unit,
    onNavigateToLabResults: () -> Unit,
    onNavigateToMedicalRecords: () -> Unit
) {
    LazyColumn(
        modifier = Modifier
            .fillMaxSize()
            .padding(16.dp),
        verticalArrangement = Arrangement.spacedBy(16.dp)
    ) {
        item {
            Text(
                text = "Health",
                style = MaterialTheme.typography.headlineMedium,
                fontWeight = FontWeight.Bold,
                color = MaterialTheme.colorScheme.onBackground
            )
        }

        item {
            HealthScoreCard()
        }

        item {
            Text(
                text = "Quick Actions",
                style = MaterialTheme.typography.titleMedium,
                fontWeight = FontWeight.SemiBold,
                color = MaterialTheme.colorScheme.onBackground
            )
        }

        item {
            Row(
                modifier = Modifier.fillMaxWidth(),
                horizontalArrangement = Arrangement.spacedBy(12.dp)
            ) {
                HealthActionCard(
                    modifier = Modifier.weight(1f),
                    title = "Vitals",
                    icon = Icons.Default.Favorite,
                    color = Error,
                    onClick = onNavigateToVitals
                )
                HealthActionCard(
                    modifier = Modifier.weight(1f),
                    title = "Medications",
                    icon = Icons.Default.Medication,
                    color = Info,
                    onClick = onNavigateToMedications
                )
            }
        }

        item {
            Row(
                modifier = Modifier.fillMaxWidth(),
                horizontalArrangement = Arrangement.spacedBy(12.dp)
            ) {
                HealthActionCard(
                    modifier = Modifier.weight(1f),
                    title = "Lab Results",
                    icon = Icons.Default.Science,
                    color = Success,
                    onClick = onNavigateToLabResults
                )
                HealthActionCard(
                    modifier = Modifier.weight(1f),
                    title = "Records",
                    icon = Icons.Default.FolderOpen,
                    color = Warning,
                    onClick = onNavigateToMedicalRecords
                )
            }
        }

        item {
            Text(
                text = "Today's Medications",
                style = MaterialTheme.typography.titleMedium,
                fontWeight = FontWeight.SemiBold,
                color = MaterialTheme.colorScheme.onBackground
            )
        }

        items(sampleMedications) { medication ->
            MedicationCard(medication = medication)
        }
    }
}

@Composable
fun HealthScoreCard() {
    Card(
        modifier = Modifier.fillMaxWidth(),
        colors = CardDefaults.cardColors(
            containerColor = VitalTeal.copy(alpha = 0.1f)
        )
    ) {
        Row(
            modifier = Modifier
                .fillMaxWidth()
                .padding(16.dp),
            horizontalArrangement = Arrangement.SpaceBetween,
            verticalAlignment = Alignment.CenterVertically
        ) {
            Column {
                Text(
                    text = "Health Score",
                    style = MaterialTheme.typography.titleMedium,
                    fontWeight = FontWeight.SemiBold
                )
                Spacer(modifier = Modifier.height(4.dp))
                Text(
                    text = "Based on your recent vitals and activities",
                    style = MaterialTheme.typography.bodySmall,
                    color = MaterialTheme.colorScheme.onSurfaceVariant
                )
            }
            Box(
                modifier = Modifier
                    .size(64.dp)
                    .background(VitalTeal, CircleShape),
                contentAlignment = Alignment.Center
            ) {
                Text(
                    text = "85",
                    style = MaterialTheme.typography.headlineSmall,
                    fontWeight = FontWeight.Bold,
                    color = Color.White
                )
            }
        }
    }
}

@Composable
fun HealthActionCard(
    modifier: Modifier = Modifier,
    title: String,
    icon: ImageVector,
    color: Color,
    onClick: () -> Unit
) {
    Card(
        modifier = modifier,
        onClick = onClick,
        colors = CardDefaults.cardColors(
            containerColor = MaterialTheme.colorScheme.surface
        )
    ) {
        Column(
            modifier = Modifier
                .fillMaxWidth()
                .padding(16.dp),
            horizontalAlignment = Alignment.CenterHorizontally
        ) {
            Box(
                modifier = Modifier
                    .size(48.dp)
                    .background(color.copy(alpha = 0.1f), MaterialTheme.shapes.medium),
                contentAlignment = Alignment.Center
            ) {
                Icon(
                    imageVector = icon,
                    contentDescription = null,
                    tint = color
                )
            }
            Spacer(modifier = Modifier.height(8.dp))
            Text(
                text = title,
                style = MaterialTheme.typography.titleSmall,
                fontWeight = FontWeight.Medium
            )
        }
    }
}

@Composable
fun MedicationCard(medication: Medication) {
    Card(
        modifier = Modifier.fillMaxWidth(),
        colors = CardDefaults.cardColors(
            containerColor = MaterialTheme.colorScheme.surface
        )
    ) {
        Row(
            modifier = Modifier
                .fillMaxWidth()
                .padding(16.dp),
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
                            color = Info.copy(alpha = 0.1f),
                            shape = MaterialTheme.shapes.medium
                        ),
                    contentAlignment = Alignment.Center
                ) {
                    Icon(
                        imageVector = Icons.Default.Medication,
                        contentDescription = null,
                        tint = Info
                    )
                }
                Column {
                    Text(
                        text = medication.name,
                        style = MaterialTheme.typography.titleSmall,
                        fontWeight = FontWeight.SemiBold
                    )
                    Text(
                        text = "${medication.dosage} • ${medication.frequency}",
                        style = MaterialTheme.typography.bodySmall,
                        color = MaterialTheme.colorScheme.onSurfaceVariant
                    )
                    Text(
                        text = medication.schedule,
                        style = MaterialTheme.typography.labelSmall,
                        color = VitalTeal
                    )
                }
            }
            IconButton(onClick = { /* Mark as taken */ }) {
                Icon(
                    imageVector = Icons.Default.CheckCircle,
                    contentDescription = "Mark as taken",
                    tint = VitalTeal
                )
            }
        }
    }
}

data class Medication(
    val id: String,
    val name: String,
    val dosage: String,
    val frequency: String,
    val schedule: String
)

val sampleMedications = listOf(
    Medication("1", "Lisinopril", "10mg", "Once daily", "8:00 AM"),
    Medication("2", "Metformin", "500mg", "Twice daily", "8:00 AM, 8:00 PM"),
    Medication("3", "Aspirin", "81mg", "Once daily", "8:00 AM")
)

