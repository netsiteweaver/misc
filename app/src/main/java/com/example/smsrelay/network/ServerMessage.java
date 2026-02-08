package com.example.smsrelay.network;

public class ServerMessage {
    private final String id;
    private final String to;
    private final String body;

    public ServerMessage(String id, String to, String body) {
        this.id = id;
        this.to = to;
        this.body = body;
    }

    public String getId() {
        return id;
    }

    public String getTo() {
        return to;
    }

    public String getBody() {
        return body;
    }
}
