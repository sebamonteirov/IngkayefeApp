package com.monteiro.ingkayefeapp

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.webkit.WebView
import android.webkit.WebViewClient
import androidx.appcompat.widget.Toolbar

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        val myWebView: WebView = findViewById(R.id.webview)
        myWebView.loadUrl("INGKAYEFE_APP_WEBSITE")
        myWebView.settings.javaScriptEnabled = true
        myWebView.webViewClient = WebViewClient() //All links the user clicks load in your WebView.

        val toolbar: Toolbar = findViewById(R.id.myToolBar)
        setSupportActionBar(toolbar)
    }
}