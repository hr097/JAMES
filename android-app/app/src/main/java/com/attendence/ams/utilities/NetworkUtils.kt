package com.attendence.ams.utilities

import android.content.Context
import android.net.ConnectivityManager
import android.net.NetworkCapabilities
import android.os.Build
import androidx.annotation.RequiresApi

/**
 * Network Util Class
 */

class NetworkUtils {

    // Send flag for internet Connection True/False
    @RequiresApi(Build.VERSION_CODES.M)
    fun haveNetworkConnection(context: Context): Boolean {
        return try {
            val connectivityManager =
                context.getSystemService(Context.CONNECTIVITY_SERVICE) as ConnectivityManager
            val capability =
                connectivityManager.getNetworkCapabilities(connectivityManager.activeNetwork)
            capability?.hasCapability(NetworkCapabilities.NET_CAPABILITY_INTERNET) ?: false
        } catch (e: Exception) {
            e.printStackTrace()
            false
        }
    }
}