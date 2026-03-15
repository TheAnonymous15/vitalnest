package com.vitalnest.app.features.subscription.presentation

import androidx.compose.foundation.layout.*
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.items
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.automirrored.filled.ArrowBack
import androidx.compose.material.icons.filled.Check
import androidx.compose.material3.*
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import com.vitalnest.app.ui.theme.*

data class SubscriptionPackage(
    val id: String,
    val name: String,
    val price: String,
    val period: String,
    val features: List<String>,
    val isPopular: Boolean = false
)

val packages = listOf(
    SubscriptionPackage(
        id = "basic",
        name = "Basic",
        price = "KES 500",
        period = "month",
        features = listOf(
            "Basic health tracking",
            "Appointment booking",
            "Chat with doctors",
            "Health records access"
        )
    ),
    SubscriptionPackage(
        id = "premium",
        name = "Premium",
        price = "KES 1,500",
        period = "month",
        features = listOf(
            "Everything in Basic",
            "Video consultations",
            "Priority booking",
            "Family accounts (up to 4)",
            "Lab results integration"
        ),
        isPopular = true
    ),
    SubscriptionPackage(
        id = "family",
        name = "Family",
        price = "KES 3,000",
        period = "month",
        features = listOf(
            "Everything in Premium",
            "Unlimited family members",
            "Home visit coordination",
            "24/7 emergency support",
            "Annual health checkup"
        )
    )
)

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun PackagesScreen(
    onNavigateBack: () -> Unit,
    onNavigateToPackageDetail: (String) -> Unit
) {
    Scaffold(
        topBar = {
            TopAppBar(
                title = { Text("Choose Your Plan") },
                navigationIcon = {
                    IconButton(onClick = onNavigateBack) {
                        Icon(Icons.AutoMirrored.Filled.ArrowBack, contentDescription = "Back")
                    }
                }
            )
        }
    ) { paddingValues ->
        LazyColumn(
            modifier = Modifier
                .fillMaxSize()
                .padding(paddingValues)
                .padding(16.dp),
            verticalArrangement = Arrangement.spacedBy(16.dp)
        ) {
            items(packages) { pkg ->
                PackageCard(
                    package_ = pkg,
                    onClick = { onNavigateToPackageDetail(pkg.id) }
                )
            }
        }
    }
}

@Composable
fun PackageCard(
    package_: SubscriptionPackage,
    onClick: () -> Unit
) {
    Card(
        modifier = Modifier.fillMaxWidth(),
        onClick = onClick,
        colors = CardDefaults.cardColors(
            containerColor = if (package_.isPopular)
                VitalTeal.copy(alpha = 0.1f)
            else
                MaterialTheme.colorScheme.surface
        )
    ) {
        Column(
            modifier = Modifier.padding(20.dp)
        ) {
            if (package_.isPopular) {
                Surface(
                    color = VitalTeal,
                    shape = MaterialTheme.shapes.small
                ) {
                    Text(
                        text = "Most Popular",
                        modifier = Modifier.padding(horizontal = 12.dp, vertical = 4.dp),
                        style = MaterialTheme.typography.labelSmall,
                        color = MaterialTheme.colorScheme.onPrimary
                    )
                }
                Spacer(modifier = Modifier.height(12.dp))
            }

            Text(
                text = package_.name,
                style = MaterialTheme.typography.headlineSmall,
                fontWeight = FontWeight.Bold
            )

            Row(
                verticalAlignment = Alignment.Bottom
            ) {
                Text(
                    text = package_.price,
                    style = MaterialTheme.typography.headlineMedium,
                    fontWeight = FontWeight.Bold,
                    color = VitalTeal
                )
                Text(
                    text = "/${package_.period}",
                    style = MaterialTheme.typography.bodyMedium,
                    color = MaterialTheme.colorScheme.onSurfaceVariant
                )
            }

            Spacer(modifier = Modifier.height(16.dp))
            HorizontalDivider()
            Spacer(modifier = Modifier.height(16.dp))

            package_.features.forEach { feature ->
                Row(
                    modifier = Modifier.padding(vertical = 4.dp),
                    verticalAlignment = Alignment.CenterVertically
                ) {
                    Icon(
                        imageVector = Icons.Default.Check,
                        contentDescription = null,
                        modifier = Modifier.size(20.dp),
                        tint = VitalTeal
                    )
                    Spacer(modifier = Modifier.width(12.dp))
                    Text(
                        text = feature,
                        style = MaterialTheme.typography.bodyMedium
                    )
                }
            }
        }
    }
}

