package com.vitalnest.app.features.profile.presentation

import androidx.compose.foundation.layout.*
import androidx.compose.foundation.rememberScrollState
import androidx.compose.foundation.verticalScroll
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.automirrored.filled.ArrowBack
import androidx.compose.material.icons.filled.*
import androidx.compose.material3.*
import androidx.compose.runtime.*
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.text.input.ImeAction
import androidx.compose.ui.text.input.KeyboardType
import androidx.compose.ui.unit.dp
import com.vitalnest.app.ui.components.VitalButton
import com.vitalnest.app.ui.components.VitalTextField
import com.vitalnest.app.ui.theme.*

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun EditProfileScreen(
    onNavigateBack: () -> Unit
) {
    var firstName by remember { mutableStateOf("Daniel") }
    var lastName by remember { mutableStateOf("Kinyua") }
    var email by remember { mutableStateOf("daniel@example.com") }
    var phone by remember { mutableStateOf("+254 712 345 678") }
    var dateOfBirth by remember { mutableStateOf("1990-01-15") }
    var gender by remember { mutableStateOf("Male") }
    var address by remember { mutableStateOf("Nairobi, Kenya") }
    var isLoading by remember { mutableStateOf(false) }

    Scaffold(
        topBar = {
            TopAppBar(
                title = {
                    Text(
                        text = "Edit Profile",
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
        Column(
            modifier = Modifier
                .fillMaxSize()
                .padding(paddingValues)
                .verticalScroll(rememberScrollState())
                .padding(16.dp),
            verticalArrangement = Arrangement.spacedBy(16.dp)
        ) {
            VitalTextField(
                value = firstName,
                onValueChange = { firstName = it },
                label = "First Name",
                leadingIcon = Icons.Default.Person,
                imeAction = ImeAction.Next
            )

            VitalTextField(
                value = lastName,
                onValueChange = { lastName = it },
                label = "Last Name",
                leadingIcon = Icons.Default.Person,
                imeAction = ImeAction.Next
            )

            VitalTextField(
                value = email,
                onValueChange = { email = it },
                label = "Email",
                leadingIcon = Icons.Default.Email,
                keyboardType = KeyboardType.Email,
                imeAction = ImeAction.Next,
                enabled = false // Email cannot be changed
            )

            VitalTextField(
                value = phone,
                onValueChange = { phone = it },
                label = "Phone Number",
                leadingIcon = Icons.Default.Phone,
                keyboardType = KeyboardType.Phone,
                imeAction = ImeAction.Next
            )

            VitalTextField(
                value = dateOfBirth,
                onValueChange = { dateOfBirth = it },
                label = "Date of Birth",
                leadingIcon = Icons.Default.CalendarMonth,
                readOnly = true,
                trailingIcon = {
                    IconButton(onClick = { /* Show date picker */ }) {
                        Icon(Icons.Default.CalendarMonth, contentDescription = "Select date")
                    }
                }
            )

            // Gender Selection
            var expanded by remember { mutableStateOf(false) }
            ExposedDropdownMenuBox(
                expanded = expanded,
                onExpandedChange = { expanded = !expanded }
            ) {
                VitalTextField(
                    value = gender,
                    onValueChange = { },
                    label = "Gender",
                    leadingIcon = Icons.Default.Person,
                    readOnly = true,
                    modifier = Modifier.menuAnchor(MenuAnchorType.PrimaryNotEditable, true),
                    trailingIcon = {
                        ExposedDropdownMenuDefaults.TrailingIcon(expanded = expanded)
                    }
                )
                ExposedDropdownMenu(
                    expanded = expanded,
                    onDismissRequest = { expanded = false }
                ) {
                    listOf("Male", "Female", "Other").forEach { option ->
                        DropdownMenuItem(
                            text = { Text(option) },
                            onClick = {
                                gender = option
                                expanded = false
                            }
                        )
                    }
                }
            }

            VitalTextField(
                value = address,
                onValueChange = { address = it },
                label = "Address",
                leadingIcon = Icons.Default.LocationOn,
                imeAction = ImeAction.Done,
                singleLine = false,
                maxLines = 3
            )

            Spacer(modifier = Modifier.height(16.dp))

            VitalButton(
                text = "Save Changes",
                onClick = {
                    isLoading = true
                    // Save profile changes
                    onNavigateBack()
                },
                isLoading = isLoading
            )
        }
    }
}

