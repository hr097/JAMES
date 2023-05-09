package com.attendence.ams

import android.annotation.SuppressLint
import android.app.AlertDialog
import android.app.Dialog
import android.content.BroadcastReceiver
import android.content.Context
import android.content.Intent
import android.content.IntentFilter
import android.graphics.Bitmap
import android.os.Build
import android.os.Bundle
import android.view.View
import android.webkit.*
import android.widget.LinearLayout
import android.widget.TextView
import android.widget.Toast
import androidx.activity.OnBackPressedCallback
import androidx.annotation.RequiresApi
import androidx.appcompat.app.AppCompatActivity
import androidx.localbroadcastmanager.content.LocalBroadcastManager
import com.attendence.ams.databinding.ActivityMainBinding
import com.attendence.ams.utilities.NetworkChangeReceiver
import com.attendence.ams.utilities.NetworkUtils


class MainActivity : AppCompatActivity() {

    companion object {
        private const val UrltoLoad = "https://ams.vnsguit.org"
    }

    private val networkUtils = NetworkUtils()
    private val networkChangeReceiver = NetworkChangeReceiver()
    private lateinit var binding: ActivityMainBinding
    private val onBackPressedCallBack = object : OnBackPressedCallback(true) {
        override fun handleOnBackPressed() {
            if (this@MainActivity.binding.webView.canGoBack()) {
                this@MainActivity.binding.webView.goBack()
            } else {
                generalDialog(getString(R.string.app_name))
            }
        }

    }

    override fun onStart() {
        super.onStart()

        LocalBroadcastManager.getInstance(this).registerReceiver(
            mNotificationReceiverInternet, IntentFilter(getString(R.string.keySendInternetStatus))
        )

        if (Build.VERSION.SDK_INT >= 23) {
            // Above marshmallow Manifest Connectivity Changes not working.
            val intentFilter = IntentFilter("android.net.conn.CONNECTIVITY_CHANGE")
            this.registerReceiver(networkChangeReceiver, intentFilter)
        }
    }

    override fun onDestroy() {
        try {
            LocalBroadcastManager.getInstance(this)
                .unregisterReceiver(mNotificationReceiverInternet)
            LocalBroadcastManager.getInstance(this).unregisterReceiver(networkChangeReceiver)
        } catch (e: Exception) {
            e.printStackTrace()
        }

        super.onDestroy()
    }


    private fun generalDialog(title: String) {
        val message = "Are you sure you want to quit?"
        try {
            val builder = AlertDialog.Builder(this@MainActivity)

            builder.setTitle(title)
            builder.setMessage(message)
            builder.setCancelable(false)
            builder.setPositiveButton("YES") { _, _ ->
                try {
                    this@MainActivity.binding.webView.clearCache(true)
                    finish()
                } catch (e: Exception) {
                    e.printStackTrace()
                }
            }
            builder.setNegativeButton("No") { dialog, _ ->
                dialog.cancel()
            }
            val dialog: AlertDialog = builder.create()
            dialog.show()
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }


    @RequiresApi(Build.VERSION_CODES.M)
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        this@MainActivity.binding = ActivityMainBinding.inflate(layoutInflater)
        val view = binding.root
        setContentView(view)

        onBackPressedDispatcher.addCallback(this, onBackPressedCallBack)

        if (networkUtils.haveNetworkConnection(this)) {
            loadWeb(UrltoLoad)
        } else {
            this@MainActivity.binding.imgvNetworkError.visibility = View.GONE
            this@MainActivity.binding.webView.visibility = View.VISIBLE
            this@MainActivity.binding.overlayView.visibility = View.VISIBLE
            connectionLostAlert("Quit", UrltoLoad)
        }
    }

    private val mNotificationReceiverInternet = object : BroadcastReceiver() {
        @RequiresApi(Build.VERSION_CODES.M)
        override fun onReceive(context: Context, intent: Intent?) {

            if (intent != null && intent.extras != null && !intent.extras!!.isEmpty) {
                if (!intent.getBooleanExtra("isConnected", false)) {
                    val url = if (binding.webView.url == null) {
                        UrltoLoad
                    } else {
                        this@MainActivity.binding.webView.url
                    }
                    url?.let { url1 ->
                        connectionLostAlert("Quit", url1)
                    }
                }
            }
        }
    }

    @RequiresApi(Build.VERSION_CODES.M)
    private fun connectionLostAlert(noButtonText: String, url: String) {
        try {
            // custom dialog
            this@MainActivity.binding.webView.visibility = View.GONE
            val customDialog = Dialog(this)
            customDialog.setContentView(R.layout.network_error)
            customDialog.setCanceledOnTouchOutside(false)
            customDialog.setCancelable(false)
            val dialogTitle = customDialog.findViewById(R.id.tvDialogTitle) as TextView
            val dialogRetry = customDialog.findViewById(R.id.tvDialogRetry) as TextView
            val dialogCancel = customDialog.findViewById(R.id.tvDialogCancel) as TextView
            customDialog.window?.setLayout(
                LinearLayout.LayoutParams.MATCH_PARENT, LinearLayout.LayoutParams.WRAP_CONTENT
            )

            dialogTitle.text = getString(R.string.noInternetConnection)

            dialogRetry.setOnClickListener {
                customDialog.cancel()
                if (networkUtils.haveNetworkConnection(this)) {
                    if (!isTextEmpty(url)) loadWeb(url)
                    customDialog.cancel()
                } else {
                    connectionLostAlert(noButtonText, url)
                }
            }
            dialogCancel.text = noButtonText
            dialogCancel.setOnClickListener {
                customDialog.cancel()
                finish()
            }

            if (!customDialog.isShowing) {
                customDialog.show()
            }
        } catch (e: Exception) {
            e.printStackTrace()
        }
    }

    @RequiresApi(Build.VERSION_CODES.M)
    @SuppressLint("SetJavaScriptEnabled", "ClickableViewAccessibility")
    private fun loadWeb(url: String) {
        val webSettings = binding.webView.settings
        webSettings.javaScriptEnabled = true
        webSettings.builtInZoomControls = false
        this@MainActivity.binding.webView.webViewClient = WebClient()
        this@MainActivity.binding.webView.webChromeClient = MyWebChromeClient()
        try {
            this.binding.webView.loadData("", "text/html", null)
            this.binding.webView.loadUrl(url)
        } catch (e: Exception) {
            e.printStackTrace()
        }

        this@MainActivity.binding.webView.setOnTouchListener { _, _ ->
            if (!networkUtils.haveNetworkConnection(this)) {
                this@MainActivity.binding.webView.url?.let { connectionLostAlert("Quit", it) }
            }
            false
        }
    }

    inner class WebClient : WebViewClient() {
        @RequiresApi(Build.VERSION_CODES.M)
        override fun onPageStarted(view: WebView, url: String, favicon: Bitmap?) {
            if (networkUtils.haveNetworkConnection(this@MainActivity)) {
                this@MainActivity.binding.imgvNetworkError.visibility = View.GONE
                this@MainActivity.binding.webView.visibility = View.VISIBLE
                this@MainActivity.binding.overlayView.visibility = View.VISIBLE
                super.onPageStarted(view, url, favicon)
            } else {
                this@MainActivity.binding.imgvNetworkError.visibility = View.GONE
                this@MainActivity.binding.imgvNetworkError.visibility = View.VISIBLE
                this@MainActivity.binding.overlayView.visibility = View.VISIBLE
                connectionLostAlert("Quit", url)
            }
        }

        @RequiresApi(Build.VERSION_CODES.M)
        override fun onPageFinished(view: WebView, url: String) {
            if (networkUtils.haveNetworkConnection(this@MainActivity)) {
                this@MainActivity.binding.webView.visibility = View.VISIBLE
                this@MainActivity.binding.overlayView.visibility = View.GONE
                super.onPageFinished(view, url)
            }
        }

        override fun onReceivedError(
            view: WebView, request: WebResourceRequest, error: WebResourceError
        ) {
            try {
                this@MainActivity.binding.webView.visibility = View.GONE
                this@MainActivity.binding.imgvNetworkError.visibility = View.VISIBLE
                this@MainActivity.binding.overlayView.visibility = View.VISIBLE
            } catch (e: Exception) {
                e.printStackTrace()
            }

        }
    }

    internal inner class MyWebChromeClient : WebChromeClient() {

        override fun onJsConfirm(
            view: WebView, url: String, message: String, result: JsResult
        ): Boolean {
            return super.onJsConfirm(view, url, message, result)
        }

        override fun onJsPrompt(
            view: WebView,
            url: String,
            message: String,
            defaultValue: String,
            result: JsPromptResult
        ): Boolean {
            return super.onJsPrompt(view, url, message, defaultValue, result)
        }

        override fun onJsAlert(
            view: WebView, url: String, message: String, result: JsResult
        ): Boolean {
            result.confirm()
            if (message.equals("exit", ignoreCase = true)) {
                finish()
            } else {
                showToast(message)
            }
            return true
        }
    }

    private fun showToast(text: String) {
        Toast.makeText(this, text, Toast.LENGTH_LONG).show()

    }


    private fun isTextEmpty(text: String?): Boolean {
        val result: String
        return try {
            if (text != null) {
                result = text.trim { it <= ' ' }
                result.isEmpty() || result.equals("null", ignoreCase = true)
            } else {
                true
            }
        } catch (e: Exception) {
            false
        }
    }


}