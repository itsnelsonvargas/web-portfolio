<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 30px;
            border: 1px solid #e9ecef;
        }
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 20px -30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .field {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
            color: #1e293b;
            display: block;
            margin-bottom: 5px;
        }
        .value {
            background-color: white;
            padding: 12px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }
        .message-box {
            background-color: white;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #2563eb;
            margin-top: 10px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Form Submission</h1>
        </div>

        <div class="field">
            <span class="label">From:</span>
            <div class="value">{{ $contactData['name'] }}</div>
        </div>

        <div class="field">
            <span class="label">Email:</span>
            <div class="value">
                <a href="mailto:{{ $contactData['email'] }}">{{ $contactData['email'] }}</a>
            </div>
        </div>

        @if(!empty($contactData['subject']))
        <div class="field">
            <span class="label">Subject:</span>
            <div class="value">{{ $contactData['subject'] }}</div>
        </div>
        @endif

        <div class="field">
            <span class="label">Message:</span>
            <div class="message-box">
                {!! nl2br(e($contactData['message'])) !!}
            </div>
        </div>

        <div class="footer">
            <p>This email was sent from your portfolio contact form.</p>
            <p>Submitted on {{ now()->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>
