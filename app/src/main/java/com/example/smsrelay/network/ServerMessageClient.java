package com.example.smsrelay.network;

import android.text.TextUtils;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.List;

public class ServerMessageClient {
    private static final int CONNECT_TIMEOUT_MS = 15000;
    private static final int READ_TIMEOUT_MS = 20000;

    private final String serverUrl;
    private final String apiToken;

    public ServerMessageClient(String serverUrl, String apiToken) {
        this.serverUrl = serverUrl;
        this.apiToken = apiToken;
    }

    public List<ServerMessage> fetchMessages() throws IOException, JSONException {
        HttpURLConnection connection = null;
        try {
            URL url = new URL(serverUrl);
            connection = (HttpURLConnection) url.openConnection();
            connection.setRequestMethod("GET");
            connection.setConnectTimeout(CONNECT_TIMEOUT_MS);
            connection.setReadTimeout(READ_TIMEOUT_MS);
            connection.setRequestProperty("Accept", "application/json");
            connection.setRequestProperty("User-Agent", "SmsRelay/1.0");
            if (!TextUtils.isEmpty(apiToken)) {
                connection.setRequestProperty("Authorization", "Bearer " + apiToken);
            }

            int status = connection.getResponseCode();
            InputStream stream = status >= 200 && status < 300
                    ? connection.getInputStream()
                    : connection.getErrorStream();
            String response = readStream(stream);

            if (status < 200 || status >= 300) {
                throw new IOException("Server error " + status + ": " + response);
            }

            return parseMessages(response);
        } finally {
            if (connection != null) {
                connection.disconnect();
            }
        }
    }

    private List<ServerMessage> parseMessages(String response) throws JSONException {
        List<ServerMessage> messages = new ArrayList<>();
        if (TextUtils.isEmpty(response)) {
            return messages;
        }

        String trimmed = response.trim();
        JSONArray array;
        if (trimmed.startsWith("[")) {
            array = new JSONArray(trimmed);
        } else {
            JSONObject root = new JSONObject(trimmed);
            array = root.optJSONArray("messages");
        }

        if (array == null) {
            return messages;
        }

        for (int i = 0; i < array.length(); i++) {
            JSONObject item = array.optJSONObject(i);
            if (item == null) {
                continue;
            }
            String id = item.optString("id", "");
            String to = item.optString("to", "");
            String body = item.optString("body", "");
            if (TextUtils.isEmpty(to) || TextUtils.isEmpty(body)) {
                continue;
            }
            messages.add(new ServerMessage(id, to, body));
        }

        return messages;
    }

    private String readStream(InputStream stream) throws IOException {
        if (stream == null) {
            return "";
        }
        StringBuilder builder = new StringBuilder();
        try (BufferedReader reader = new BufferedReader(
                new InputStreamReader(stream, StandardCharsets.UTF_8))) {
            String line;
            while ((line = reader.readLine()) != null) {
                builder.append(line);
            }
        }
        return builder.toString();
    }
}
