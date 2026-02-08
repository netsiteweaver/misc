package com.example.smsrelay.sms;

import android.content.Context;
import android.telephony.SmsManager;
import android.text.TextUtils;

import com.example.smsrelay.network.ServerMessage;

import java.util.ArrayList;

public class SmsSender {
    private final Context appContext;

    public SmsSender(Context context) {
        this.appContext = context.getApplicationContext();
    }

    public boolean send(ServerMessage message) {
        if (message == null) {
            return false;
        }
        String destination = message.getTo();
        String body = message.getBody();
        if (TextUtils.isEmpty(destination) || TextUtils.isEmpty(body)) {
            return false;
        }

        SmsManager smsManager = appContext.getSystemService(SmsManager.class);
        if (smsManager == null) {
            return false;
        }

        ArrayList<String> parts = smsManager.divideMessage(body);
        smsManager.sendMultipartTextMessage(destination, null, parts, null, null);
        return true;
    }
}
