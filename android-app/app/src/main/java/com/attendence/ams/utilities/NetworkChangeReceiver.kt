package com.attendence.ams.utilities

import android.content.BroadcastReceiver
import android.content.Context
import android.content.Intent
import android.net.ConnectivityManager
import android.net.NetworkCapabilities
import android.os.Build
import androidx.annotation.RequiresApi
import androidx.localbroadcastmanager.content.LocalBroadcastManager
import com.attendence.ams.R

class NetworkChangeReceiver : BroadcastReceiver() {

    //should check null because in airplane mode it will be null
    @RequiresApi(Build.VERSION_CODES.M)
    fun isOnline(context: Context): Boolean {
        try {
            val connectivityManager =
                context.getSystemService(Context.CONNECTIVITY_SERVICE) as ConnectivityManager
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                val nw = connectivityManager.activeNetwork ?: return false
                val actNw = connectivityManager.getNetworkCapabilities(nw) ?: return false
                return when {
                    actNw.hasTransport(NetworkCapabilities.TRANSPORT_WIFI) -> true
                    actNw.hasTransport(NetworkCapabilities.TRANSPORT_CELLULAR) -> true
                    //for other device how are able to connect with Ethernet
                    actNw.hasTransport(NetworkCapabilities.TRANSPORT_ETHERNET) -> true
                    //for check internet over Bluetooth
                    actNw.hasTransport(NetworkCapabilities.TRANSPORT_BLUETOOTH) -> true
                    else -> false
                }
            } else {
                // check Internet capability
                val capability =
                    connectivityManager.getNetworkCapabilities(connectivityManager.activeNetwork)
                return capability?.hasCapability(NetworkCapabilities.NET_CAPABILITY_INTERNET)
                    ?: false
            }
        } catch (e: Exception) {
            return false
        }

    }

    //Broadcast Receiver
    @RequiresApi(Build.VERSION_CODES.M)
    override fun onReceive(context: Context, intent: Intent) {
        if (isOnline(context)) {
            sendInternetUpdate(context, true)
        } else {
            sendInternetUpdate(context, false)
        }
    }

    // internet Connection Update
    private fun sendInternetUpdate(context: Context, isConnected: Boolean) {
        val intent = Intent(context.getString(R.string.keySendInternetStatus))
        intent.putExtra("isConnected", isConnected)
        LocalBroadcastManager.getInstance(context).sendBroadcast(intent)
    }
}
