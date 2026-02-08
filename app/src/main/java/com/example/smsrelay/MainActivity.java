package com.example.smsrelay;

import android.Manifest;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.text.TextUtils;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import com.example.smsrelay.network.ServerMessage;
import com.example.smsrelay.network.ServerMessageClient;
import com.example.smsrelay.sms.SmsSender;

import java.util.List;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class MainActivity extends AppCompatActivity {
    private static final int REQUEST_SEND_SMS = 1001;

    private EditText serverUrlInput;
    private EditText apiTokenInput;
    private Button fetchButton;
    private TextView statusText;
    private ExecutorService executor;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        serverUrlInput = findViewById(R.id.server_url_input);
        apiTokenInput = findViewById(R.id.api_token_input);
        fetchButton = findViewById(R.id.fetch_button);
        statusText = findViewById(R.id.status_text);
        executor = Executors.newSingleThreadExecutor();

        fetchButton.setOnClickListener(view -> startFetchFlow());
    }

    private void startFetchFlow() {
        String serverUrl = serverUrlInput.getText().toString().trim();
        if (TextUtils.isEmpty(serverUrl)) {
            updateStatus("Server URL is required.");
            return;
        }

        if (ContextCompat.checkSelfPermission(this, Manifest.permission.SEND_SMS)
                != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(
                    this,
                    new String[]{Manifest.permission.SEND_SMS},
                    REQUEST_SEND_SMS
            );
            updateStatus("Grant SMS permission to send messages.");
            return;
        }

        fetchButton.setEnabled(false);
        updateStatus("Fetching messages...");

        String apiToken = apiTokenInput.getText().toString().trim();
        executor.execute(() -> fetchAndSend(serverUrl, apiToken));
    }

    private void fetchAndSend(String serverUrl, String apiToken) {
        ServerMessageClient client = new ServerMessageClient(serverUrl, apiToken);
        SmsSender sender = new SmsSender(this);

        try {
            List<ServerMessage> messages = client.fetchMessages();
            int sentCount = 0;
            for (ServerMessage message : messages) {
                if (sender.send(message)) {
                    sentCount += 1;
                }
            }

            int total = messages.size();
            String status = total == 0
                    ? "No messages to send."
                    : "Sent " + sentCount + " of " + total + " messages.";
            runOnUiThread(() -> finishFetch(status));
        } catch (Exception e) {
            String status = "Error: " + e.getMessage();
            runOnUiThread(() -> finishFetch(status));
        }
    }

    private void finishFetch(String status) {
        updateStatus(status);
        fetchButton.setEnabled(true);
    }

    private void updateStatus(String message) {
        statusText.setText(message);
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        executor.shutdownNow();
    }

    @Override
    public void onRequestPermissionsResult(
            int requestCode,
            @NonNull String[] permissions,
            @NonNull int[] grantResults
    ) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == REQUEST_SEND_SMS) {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                startFetchFlow();
            } else {
                updateStatus("SMS permission denied. Cannot send messages.");
            }
        }
    }
}
