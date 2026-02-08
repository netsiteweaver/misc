# SMS Relay (Android)

This Android app pulls pending messages from a server endpoint and sends them as SMS.

## Server API contract

The app expects a JSON response from the provided server URL. Two formats are accepted:

```json
{
  "messages": [
    { "id": "abc123", "to": "+15551234567", "body": "Hello there" }
  ]
}
```

or a plain array:

```json
[
  { "id": "abc123", "to": "+15551234567", "body": "Hello there" }
]
```

If you provide an API token in the app, it is sent as:

```
Authorization: Bearer <token>
```

## Permissions

- `INTERNET` for fetching messages.
- `SEND_SMS` is requested at runtime.

## Notes

- Cleartext HTTP traffic is enabled for local or non-HTTPS servers.
- For delivery receipts or acknowledgements, add a follow-up API call in
  `ServerMessageClient`.

## Build

Open the project in Android Studio and sync Gradle. If you need a Gradle
wrapper, generate one from Android Studio or via `gradle wrapper`.