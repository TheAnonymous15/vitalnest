package com.vitalnest.app.features.appointments.presentation

import androidx.compose.foundation.background
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.*
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.LazyRow
import androidx.compose.foundation.lazy.items
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.automirrored.filled.ArrowBack
import androidx.compose.material.icons.filled.*
import androidx.compose.material3.*
import androidx.compose.runtime.*
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import com.vitalnest.app.ui.components.VitalButton
import com.vitalnest.app.ui.components.VitalCard
import com.vitalnest.app.ui.theme.*
import java.time.LocalDate
import java.time.format.DateTimeFormatter

data class Doctor(
    val id: String,
    val name: String,
    val specialty: String,
    val rating: Float,
    val availableSlots: List<String>
)

data class TimeSlot(
    val time: String,
    val available: Boolean
)

enum class AppointmentType {
    IN_PERSON,
    VIDEO_CALL
}

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun BookAppointmentScreen(
    onNavigateBack: () -> Unit,
    onBookingSuccess: () -> Unit
) {
    var currentStep by remember { mutableIntStateOf(0) }
    var selectedSpecialty by remember { mutableStateOf<String?>(null) }
    var selectedDoctor by remember { mutableStateOf<Doctor?>(null) }
    var selectedDate by remember { mutableStateOf<LocalDate?>(null) }
    var selectedTime by remember { mutableStateOf<String?>(null) }
    var appointmentType by remember { mutableStateOf(AppointmentType.IN_PERSON) }
    var notes by remember { mutableStateOf("") }

    val specialties = listOf(
        "General Physician", "Cardiologist", "Dermatologist",
        "Pediatrician", "Gynecologist", "Orthopedic", "ENT Specialist"
    )

    val doctors = listOf(
        Doctor("1", "Dr. Wanjiku", "General Physician", 4.8f, listOf("9:00 AM", "10:00 AM", "2:00 PM")),
        Doctor("2", "Dr. Ochieng", "General Physician", 4.6f, listOf("11:00 AM", "3:00 PM", "4:00 PM")),
        Doctor("3", "Dr. Mwangi", "General Physician", 4.9f, listOf("10:00 AM", "1:00 PM", "5:00 PM"))
    )

    val timeSlots = listOf(
        TimeSlot("9:00 AM", true),
        TimeSlot("10:00 AM", true),
        TimeSlot("11:00 AM", false),
        TimeSlot("12:00 PM", true),
        TimeSlot("2:00 PM", true),
        TimeSlot("3:00 PM", false),
        TimeSlot("4:00 PM", true),
        TimeSlot("5:00 PM", true)
    )

    Scaffold(
        topBar = {
            TopAppBar(
                title = {
                    Text(
                        text = "Book Appointment",
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
        ) {
            // Progress Indicator
            Row(
                modifier = Modifier
                    .fillMaxWidth()
                    .padding(16.dp),
                horizontalArrangement = Arrangement.SpaceEvenly
            ) {
                listOf("Specialty", "Doctor", "Date & Time", "Confirm").forEachIndexed { index, step ->
                    Column(
                        horizontalAlignment = Alignment.CenterHorizontally,
                        modifier = Modifier.weight(1f)
                    ) {
                        Box(
                            modifier = Modifier
                                .size(32.dp)
                                .background(
                                    color = if (index <= currentStep) VitalTeal else MaterialTheme.colorScheme.surfaceVariant,
                                    shape = CircleShape
                                ),
                            contentAlignment = Alignment.Center
                        ) {
                            if (index < currentStep) {
                                Icon(
                                    imageVector = Icons.Default.Check,
                                    contentDescription = null,
                                    tint = Color.White,
                                    modifier = Modifier.size(16.dp)
                                )
                            } else {
                                Text(
                                    text = "${index + 1}",
                                    style = MaterialTheme.typography.labelMedium,
                                    color = if (index <= currentStep) Color.White else MaterialTheme.colorScheme.onSurfaceVariant
                                )
                            }
                        }
                        Spacer(modifier = Modifier.height(4.dp))
                        Text(
                            text = step,
                            style = MaterialTheme.typography.labelSmall,
                            color = if (index <= currentStep) VitalTeal else MaterialTheme.colorScheme.onSurfaceVariant
                        )
                    }
                }
            }

            // Content based on current step
            when (currentStep) {
                0 -> SpecialtySelectionStep(
                    specialties = specialties,
                    selectedSpecialty = selectedSpecialty,
                    onSpecialtySelected = { selectedSpecialty = it }
                )
                1 -> DoctorSelectionStep(
                    doctors = doctors.filter { it.specialty == selectedSpecialty || selectedSpecialty == null },
                    selectedDoctor = selectedDoctor,
                    onDoctorSelected = { selectedDoctor = it }
                )
                2 -> DateTimeSelectionStep(
                    selectedDate = selectedDate,
                    selectedTime = selectedTime,
                    timeSlots = timeSlots,
                    onDateSelected = { selectedDate = it },
                    onTimeSelected = { selectedTime = it }
                )
                3 -> ConfirmationStep(
                    specialty = selectedSpecialty ?: "",
                    doctor = selectedDoctor,
                    date = selectedDate,
                    time = selectedTime ?: "",
                    appointmentType = appointmentType,
                    notes = notes,
                    onTypeChanged = { appointmentType = it },
                    onNotesChanged = { notes = it }
                )
            }

            Spacer(modifier = Modifier.weight(1f))

            // Navigation Buttons
            Row(
                modifier = Modifier
                    .fillMaxWidth()
                    .padding(16.dp),
                horizontalArrangement = Arrangement.spacedBy(12.dp)
            ) {
                if (currentStep > 0) {
                    OutlinedButton(
                        onClick = { currentStep-- },
                        modifier = Modifier.weight(1f)
                    ) {
                        Text("Back")
                    }
                }

                VitalButton(
                    text = if (currentStep == 3) "Confirm Booking" else "Continue",
                    onClick = {
                        if (currentStep < 3) {
                            currentStep++
                        } else {
                            // Book appointment
                            onBookingSuccess()
                        }
                    },
                    modifier = Modifier.weight(1f),
                    enabled = when (currentStep) {
                        0 -> selectedSpecialty != null
                        1 -> selectedDoctor != null
                        2 -> selectedDate != null && selectedTime != null
                        else -> true
                    }
                )
            }
        }
    }
}

@Composable
fun SpecialtySelectionStep(
    specialties: List<String>,
    selectedSpecialty: String?,
    onSpecialtySelected: (String) -> Unit
) {
    LazyColumn(
        modifier = Modifier
            .fillMaxWidth()
            .padding(16.dp),
        verticalArrangement = Arrangement.spacedBy(8.dp)
    ) {
        item {
            Text(
                text = "Select a Specialty",
                style = MaterialTheme.typography.titleMedium,
                fontWeight = FontWeight.SemiBold
            )
            Spacer(modifier = Modifier.height(8.dp))
        }

        items(specialties) { specialty ->
            SpecialtyItem(
                specialty = specialty,
                isSelected = specialty == selectedSpecialty,
                onClick = { onSpecialtySelected(specialty) }
            )
        }
    }
}

@Composable
fun SpecialtyItem(
    specialty: String,
    isSelected: Boolean,
    onClick: () -> Unit
) {
    Card(
        modifier = Modifier
            .fillMaxWidth()
            .clickable(onClick = onClick),
        colors = CardDefaults.cardColors(
            containerColor = if (isSelected) VitalTeal.copy(alpha = 0.1f)
                else MaterialTheme.colorScheme.surface
        ),
        border = if (isSelected) CardDefaults.outlinedCardBorder().copy(
            brush = androidx.compose.ui.graphics.SolidColor(VitalTeal)
        ) else null
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
                Icon(
                    imageVector = Icons.Default.MedicalServices,
                    contentDescription = null,
                    tint = if (isSelected) VitalTeal else MaterialTheme.colorScheme.onSurfaceVariant
                )
                Text(
                    text = specialty,
                    style = MaterialTheme.typography.bodyLarge,
                    fontWeight = if (isSelected) FontWeight.Medium else FontWeight.Normal
                )
            }

            if (isSelected) {
                Icon(
                    imageVector = Icons.Default.CheckCircle,
                    contentDescription = null,
                    tint = VitalTeal
                )
            }
        }
    }
}

@Composable
fun DoctorSelectionStep(
    doctors: List<Doctor>,
    selectedDoctor: Doctor?,
    onDoctorSelected: (Doctor) -> Unit
) {
    LazyColumn(
        modifier = Modifier
            .fillMaxWidth()
            .padding(16.dp),
        verticalArrangement = Arrangement.spacedBy(12.dp)
    ) {
        item {
            Text(
                text = "Select a Doctor",
                style = MaterialTheme.typography.titleMedium,
                fontWeight = FontWeight.SemiBold
            )
            Spacer(modifier = Modifier.height(8.dp))
        }

        items(doctors) { doctor ->
            DoctorCard(
                doctor = doctor,
                isSelected = doctor.id == selectedDoctor?.id,
                onClick = { onDoctorSelected(doctor) }
            )
        }
    }
}

@Composable
fun DoctorCard(
    doctor: Doctor,
    isSelected: Boolean,
    onClick: () -> Unit
) {
    Card(
        modifier = Modifier
            .fillMaxWidth()
            .clickable(onClick = onClick),
        colors = CardDefaults.cardColors(
            containerColor = if (isSelected) VitalTeal.copy(alpha = 0.1f)
                else MaterialTheme.colorScheme.surface
        ),
        border = if (isSelected) CardDefaults.outlinedCardBorder().copy(
            brush = androidx.compose.ui.graphics.SolidColor(VitalTeal)
        ) else null
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
                        .size(56.dp)
                        .background(
                            color = VitalTeal.copy(alpha = 0.1f),
                            shape = CircleShape
                        ),
                    contentAlignment = Alignment.Center
                ) {
                    Icon(
                        imageVector = Icons.Default.Person,
                        contentDescription = null,
                        tint = VitalTeal,
                        modifier = Modifier.size(28.dp)
                    )
                }

                Column {
                    Text(
                        text = doctor.name,
                        style = MaterialTheme.typography.titleSmall,
                        fontWeight = FontWeight.SemiBold
                    )
                    Text(
                        text = doctor.specialty,
                        style = MaterialTheme.typography.bodySmall,
                        color = MaterialTheme.colorScheme.onSurfaceVariant
                    )
                    Row(
                        verticalAlignment = Alignment.CenterVertically,
                        horizontalArrangement = Arrangement.spacedBy(4.dp)
                    ) {
                        Icon(
                            imageVector = Icons.Default.Star,
                            contentDescription = null,
                            tint = Warning,
                            modifier = Modifier.size(14.dp)
                        )
                        Text(
                            text = "${doctor.rating}",
                            style = MaterialTheme.typography.labelSmall,
                            color = MaterialTheme.colorScheme.onSurfaceVariant
                        )
                    }
                }
            }

            if (isSelected) {
                Icon(
                    imageVector = Icons.Default.CheckCircle,
                    contentDescription = null,
                    tint = VitalTeal
                )
            }
        }
    }
}

@Composable
fun DateTimeSelectionStep(
    selectedDate: LocalDate?,
    selectedTime: String?,
    timeSlots: List<TimeSlot>,
    onDateSelected: (LocalDate) -> Unit,
    onTimeSelected: (String) -> Unit
) {
    val today = LocalDate.now()
    val dates = (0..13).map { today.plusDays(it.toLong()) }

    Column(
        modifier = Modifier
            .fillMaxWidth()
            .padding(16.dp)
    ) {
        Text(
            text = "Select Date",
            style = MaterialTheme.typography.titleMedium,
            fontWeight = FontWeight.SemiBold
        )

        Spacer(modifier = Modifier.height(12.dp))

        // Date Selection
        LazyRow(
            horizontalArrangement = Arrangement.spacedBy(8.dp)
        ) {
            items(dates) { date ->
                val isSelected = date == selectedDate
                Card(
                    modifier = Modifier
                        .size(64.dp)
                        .clickable { onDateSelected(date) },
                    colors = CardDefaults.cardColors(
                        containerColor = if (isSelected) VitalTeal else MaterialTheme.colorScheme.surface
                    )
                ) {
                    Column(
                        modifier = Modifier.fillMaxSize(),
                        horizontalAlignment = Alignment.CenterHorizontally,
                        verticalArrangement = Arrangement.Center
                    ) {
                        Text(
                            text = date.format(DateTimeFormatter.ofPattern("EEE")),
                            style = MaterialTheme.typography.labelSmall,
                            color = if (isSelected) Color.White else MaterialTheme.colorScheme.onSurfaceVariant
                        )
                        Text(
                            text = date.dayOfMonth.toString(),
                            style = MaterialTheme.typography.titleMedium,
                            fontWeight = FontWeight.Bold,
                            color = if (isSelected) Color.White else MaterialTheme.colorScheme.onSurface
                        )
                    }
                }
            }
        }

        Spacer(modifier = Modifier.height(24.dp))

        Text(
            text = "Select Time",
            style = MaterialTheme.typography.titleMedium,
            fontWeight = FontWeight.SemiBold
        )

        Spacer(modifier = Modifier.height(12.dp))

        // Time Slots Grid
        val chunkedSlots = timeSlots.chunked(4)
        Column(verticalArrangement = Arrangement.spacedBy(8.dp)) {
            chunkedSlots.forEach { row ->
                Row(
                    modifier = Modifier.fillMaxWidth(),
                    horizontalArrangement = Arrangement.spacedBy(8.dp)
                ) {
                    row.forEach { slot ->
                        val isSelected = slot.time == selectedTime
                        Card(
                            modifier = Modifier
                                .weight(1f)
                                .clickable(enabled = slot.available) {
                                    if (slot.available) onTimeSelected(slot.time)
                                },
                            colors = CardDefaults.cardColors(
                                containerColor = when {
                                    isSelected -> VitalTeal
                                    !slot.available -> MaterialTheme.colorScheme.surfaceVariant.copy(alpha = 0.5f)
                                    else -> MaterialTheme.colorScheme.surface
                                }
                            )
                        ) {
                            Box(
                                modifier = Modifier
                                    .fillMaxWidth()
                                    .padding(12.dp),
                                contentAlignment = Alignment.Center
                            ) {
                                Text(
                                    text = slot.time,
                                    style = MaterialTheme.typography.bodySmall,
                                    color = when {
                                        isSelected -> Color.White
                                        !slot.available -> MaterialTheme.colorScheme.onSurfaceVariant.copy(alpha = 0.5f)
                                        else -> MaterialTheme.colorScheme.onSurface
                                    }
                                )
                            }
                        }
                    }
                    // Fill remaining space if row is not complete
                    repeat(4 - row.size) {
                        Spacer(modifier = Modifier.weight(1f))
                    }
                }
            }
        }
    }
}

@Composable
fun ConfirmationStep(
    specialty: String,
    doctor: Doctor?,
    date: LocalDate?,
    time: String,
    appointmentType: AppointmentType,
    notes: String,
    onTypeChanged: (AppointmentType) -> Unit,
    onNotesChanged: (String) -> Unit
) {
    Column(
        modifier = Modifier
            .fillMaxWidth()
            .padding(16.dp),
        verticalArrangement = Arrangement.spacedBy(16.dp)
    ) {
        Text(
            text = "Confirm Appointment",
            style = MaterialTheme.typography.titleMedium,
            fontWeight = FontWeight.SemiBold
        )

        VitalCard {
            Column(verticalArrangement = Arrangement.spacedBy(12.dp)) {
                // Doctor Info
                Row(
                    horizontalArrangement = Arrangement.spacedBy(12.dp),
                    verticalAlignment = Alignment.CenterVertically
                ) {
                    Box(
                        modifier = Modifier
                            .size(48.dp)
                            .background(VitalTeal.copy(alpha = 0.1f), CircleShape),
                        contentAlignment = Alignment.Center
                    ) {
                        Icon(Icons.Default.Person, null, tint = VitalTeal)
                    }
                    Column {
                        Text(doctor?.name ?: "", style = MaterialTheme.typography.titleSmall, fontWeight = FontWeight.SemiBold)
                        Text(specialty, style = MaterialTheme.typography.bodySmall, color = MaterialTheme.colorScheme.onSurfaceVariant)
                    }
                }

                HorizontalDivider()

                // Date & Time
                Row(
                    modifier = Modifier.fillMaxWidth(),
                    horizontalArrangement = Arrangement.SpaceBetween
                ) {
                    Row(horizontalArrangement = Arrangement.spacedBy(8.dp)) {
                        Icon(Icons.Default.CalendarMonth, null, modifier = Modifier.size(20.dp), tint = MaterialTheme.colorScheme.onSurfaceVariant)
                        Text(date?.format(DateTimeFormatter.ofPattern("MMM dd, yyyy")) ?: "", style = MaterialTheme.typography.bodyMedium)
                    }
                    Row(horizontalArrangement = Arrangement.spacedBy(8.dp)) {
                        Icon(Icons.Default.Schedule, null, modifier = Modifier.size(20.dp), tint = MaterialTheme.colorScheme.onSurfaceVariant)
                        Text(time, style = MaterialTheme.typography.bodyMedium)
                    }
                }
            }
        }

        // Appointment Type Selection
        Text("Appointment Type", style = MaterialTheme.typography.titleSmall, fontWeight = FontWeight.Medium)

        Row(
            modifier = Modifier.fillMaxWidth(),
            horizontalArrangement = Arrangement.spacedBy(12.dp)
        ) {
            AppointmentType.entries.forEach { type ->
                val isSelected = type == appointmentType
                Card(
                    modifier = Modifier
                        .weight(1f)
                        .clickable { onTypeChanged(type) },
                    colors = CardDefaults.cardColors(
                        containerColor = if (isSelected) VitalTeal.copy(alpha = 0.1f) else MaterialTheme.colorScheme.surface
                    ),
                    border = if (isSelected) CardDefaults.outlinedCardBorder().copy(
                        brush = androidx.compose.ui.graphics.SolidColor(VitalTeal)
                    ) else null
                ) {
                    Column(
                        modifier = Modifier
                            .fillMaxWidth()
                            .padding(16.dp),
                        horizontalAlignment = Alignment.CenterHorizontally
                    ) {
                        Icon(
                            imageVector = if (type == AppointmentType.VIDEO_CALL) Icons.Default.VideoCall else Icons.Default.LocationOn,
                            contentDescription = null,
                            tint = if (isSelected) VitalTeal else MaterialTheme.colorScheme.onSurfaceVariant
                        )
                        Spacer(modifier = Modifier.height(4.dp))
                        Text(
                            text = if (type == AppointmentType.VIDEO_CALL) "Video Call" else "In-Person",
                            style = MaterialTheme.typography.labelMedium,
                            color = if (isSelected) VitalTeal else MaterialTheme.colorScheme.onSurfaceVariant
                        )
                    }
                }
            }
        }

        // Notes
        OutlinedTextField(
            value = notes,
            onValueChange = onNotesChanged,
            label = { Text("Additional Notes (Optional)") },
            modifier = Modifier.fillMaxWidth(),
            minLines = 3,
            maxLines = 5
        )
    }
}

