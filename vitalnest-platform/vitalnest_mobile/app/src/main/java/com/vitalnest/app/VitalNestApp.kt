package com.vitalnest.app

import android.app.Application
import dagger.hilt.android.HiltAndroidApp

@HiltAndroidApp
class VitalNestApp : Application() {
    override fun onCreate() {
        super.onCreate()
        // Initialize any app-wide configurations here
    }
}

