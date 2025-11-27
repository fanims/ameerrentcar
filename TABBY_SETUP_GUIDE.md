# Tabby Payment Integration - Complete Setup Guide

## Overview

This guide provides complete instructions for setting up and testing the Tabby (Buy Now, Pay Later) payment integration in your Laravel application.

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Environment Configuration](#environment-configuration)
3. [Getting Tabby Credentials](#getting-tabby-credentials)
4. [Local Development Setup](#local-development-setup)
5. [Testing with Ngrok](#testing-with-ngrok)
6. [Production Setup](#production-setup)
7. [Switching Between Test and Live Mode](#switching-between-test-and-live-mode)
8. [Testing the Integration](#testing-the-integration)
9. [Troubleshooting](#troubleshooting)
10. [File Changes Summary](#file-changes-summary)

---

## Prerequisites

- Laravel application (this project)
- Tabby merchant account (sign up at https://tabby.ai)
- Composer and PHP installed
- ngrok (for local webhook testing) - [Download here](https://ngrok.com/)

---

## Environment Configuration

### Step 1: Add Tabby Configuration to `.env`

Add the following variables to your `.env` file:

```env
# Tabby Payment Gateway Configuration
# ====================================

# API Credentials (Get these from Tabby Dashboard)
TABBY_SECRET_KEY=your_secret_key_here
TABBY_PUBLIC_KEY=your_public_key_here
TABBY_MERCHANT_CODE=your_merchant_code_here

# Environment Mode
# Options: 'test' or 'live'
# When set to 'test', uses sandbox URLs and test credentials
TABBY_ENV=test

# Alternative: Use boolean flag (TABBY_ENV takes precedence)
TABBY_TEST_MODE=true

# Currency (default: AED)
TABBY_CURRENCY=AED

# API URLs (usually no need to change these)
TABBY_SANDBOX_URL=https://api.tabby.dev/api/v2/checkout
TABBY_PRODUCTION_URL=https://api.tabby.ai/api/v2/checkout
TABBY_SANDBOX_BASE_URL=https://api.tabby.dev/api/v2
TABBY_PRODUCTION_BASE_URL=https://api.tabby.ai/api/v2

# Test Email (for Tabby OTP testing in sandbox)
# Use 'otp.success@tabby.ai' for successful OTP verification
TABBY_TEST_EMAIL=otp.success@tabby.ai
TABBY_DEFAULT_EMAIL=customer@example.com

# Payment Verification
# Set to true to verify payment status via API after redirect
TABBY_VERIFY_PAYMENTS=true
```

### Step 2: Clear Configuration Cache

After updating `.env`, clear Laravel's configuration cache:

```bash
php artisan config:clear
php artisan cache:clear
```

---

## Getting Tabby Credentials

### For Test/Sandbox Mode:

1. **Sign up for Tabby Developer Account**
   - Visit: https://tabby.ai/developers
   - Create a developer account
   - Access the Developer Dashboard

2. **Get Sandbox Credentials**
   - Log into Tabby Developer Dashboard
   - Navigate to **Settings** > **API Keys**
   - Copy your **Secret Key** and **Public Key**
   - Note your **Merchant Code** (usually displayed in dashboard)

3. **Configure Webhook URL** (for local testing, use ngrok - see below)
   - In Tabby Dashboard, go to **Settings** > **Webhooks**
   - Add webhook URL: `https://your-ngrok-url.ngrok.io/tabby/webhook`

### For Production/Live Mode:

1. **Complete Merchant Onboarding**
   - Complete business verification
   - Submit required documents
   - Wait for approval

2. **Get Production Credentials**
   - Once approved, get production API keys from dashboard
   - Update `.env` with production credentials
   - Set `TABBY_ENV=live` or `TABBY_TEST_MODE=false`

---

## Local Development Setup

### Step 1: Configure Test Mode

For local development, use test mode:

```env
TABBY_ENV=test
TABBY_TEST_MODE=true
TABBY_SECRET_KEY=your_sandbox_secret_key
TABBY_PUBLIC_KEY=your_sandbox_public_key
TABBY_MERCHANT_CODE=your_sandbox_merchant_code
```

### Step 2: Test Without Credentials (Simulation Mode)

If you don't have Tabby credentials yet, the system will automatically show a "Simulate Successful Tabby Payment" button when:
- Tabby payment method is selected
- API keys are not configured

This allows you to test the order creation flow without actual payment processing.

### Step 3: Test with Real Tabby API (Sandbox)

Once you have sandbox credentials:

1. Add credentials to `.env`
2. Clear config cache: `php artisan config:clear`
3. The system will automatically use Tabby sandbox API
4. Test payments will use Tabby's test environment

---

## Testing with Ngrok

Ngrok is required for testing webhooks locally, as Tabby needs a public URL to send webhook notifications.

### Step 1: Install Ngrok

Download from: https://ngrok.com/download

### Step 2: Start Your Laravel Application

```bash
php artisan serve
# Your app will be available at http://localhost:8000
```

### Step 3: Start Ngrok

```bash
ngrok http 8000
```

You'll see output like:
```
Forwarding  https://abc123.ngrok.io -> http://localhost:8000
```

### Step 4: Configure Webhook URL in Tabby Dashboard

1. Copy the ngrok HTTPS URL (e.g., `https://abc123.ngrok.io`)
2. Log into Tabby Developer Dashboard
3. Go to **Settings** > **Webhooks**
4. Add webhook URL: `https://abc123.ngrok.io/tabby/webhook`
5. Save

### Step 5: Test Webhook

1. Make a test payment through your application
2. Check Laravel logs: `storage/logs/laravel.log`
3. You should see webhook logs like:
   ```
   Tabby Webhook Received: payment_id=xxx, status=authorized
   ```

### Important Notes:

- **Ngrok Free Tier**: URLs change on each restart. Update Tabby webhook URL each time.
- **Ngrok Paid Tier**: Get a static domain, no need to update each time.
- **Webhook Testing**: Use Tabby's webhook testing tool in dashboard to send test webhooks.

---

## Production Setup

### Step 1: Update Environment Variables

```env
TABBY_ENV=live
TABBY_TEST_MODE=false
TABBY_SECRET_KEY=your_production_secret_key
TABBY_PUBLIC_KEY=your_production_public_key
TABBY_MERCHANT_CODE=your_production_merchant_code
```

### Step 2: Configure Production Webhook

1. In Tabby Dashboard, go to **Settings** > **Webhooks**
2. Add production webhook URL: `https://yourdomain.com/tabby/webhook`
3. Ensure your server accepts POST requests to `/tabby/webhook`
4. Test the webhook using Tabby's test tool

### Step 3: Verify SSL Certificate

- Production webhook URL must use HTTPS
- SSL certificate must be valid
- Tabby will reject webhooks from non-HTTPS URLs

### Step 4: Monitor Logs

Set up log monitoring to track:
- Payment success/failure
- Webhook deliveries
- API errors

---

## Switching Between Test and Live Mode

### Method 1: Using TABBY_ENV (Recommended)

```env
# Test Mode
TABBY_ENV=test

# Live Mode
TABBY_ENV=live
```

### Method 2: Using TABBY_TEST_MODE

```env
# Test Mode
TABBY_TEST_MODE=true

# Live Mode
TABBY_TEST_MODE=false
```

**Note**: `TABBY_ENV` takes precedence over `TABBY_TEST_MODE`.

### After Changing Mode:

1. Clear config cache:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. Verify mode in application:
   - Check booking page - should show current mode
   - Test a payment to confirm correct API endpoints

---

## Testing the Integration

### Test Scenarios

#### 1. Test Mode Without Credentials (Simulation)

1. Ensure `.env` has no Tabby credentials (or empty values)
2. Go to booking page
3. Select "Tabby" payment method
4. You should see "Simulate Successful Tabby Payment" button
5. Click button - order should be created with "paid" status

#### 2. Test Mode With Sandbox Credentials

1. Configure sandbox credentials in `.env`
2. Set `TABBY_ENV=test`
3. Clear config cache
4. Go to booking page
5. Select "Tabby" payment method
6. Complete booking form
7. Submit payment
8. You should be redirected to Tabby sandbox payment page
9. Use test credentials to complete payment
10. You should be redirected back to success page

#### 3. Webhook Testing

1. Set up ngrok (see above)
2. Configure webhook URL in Tabby dashboard
3. Complete a test payment
4. Check Laravel logs for webhook receipt
5. Verify order status is updated correctly

#### 4. Production Testing

1. Configure production credentials
2. Set `TABBY_ENV=live`
3. Test with small amount first
4. Monitor logs and webhooks
5. Verify order creation and status updates

### Test Email Addresses (Sandbox)

Tabby sandbox uses special test email addresses:

- `otp.success@tabby.ai` - Always succeeds OTP verification
- `otp.fail@tabby.ai` - Always fails OTP verification
- `payment.authorized@tabby.ai` - Payment always authorized
- `payment.rejected@tabby.ai` - Payment always rejected

Use these in your test bookings to simulate different scenarios.

---

## Troubleshooting

### Issue: "Tabby payment gateway is not configured"

**Solution:**
- Check `.env` file has `TABBY_SECRET_KEY` set
- Verify `TABBY_MERCHANT_CODE` is set
- Clear config cache: `php artisan config:clear`

### Issue: "Tabby payment initialization failed"

**Possible Causes:**
1. Invalid API credentials
2. Wrong API endpoint (check test/live mode)
3. Network connectivity issues
4. Invalid payload structure

**Solution:**
- Check Laravel logs: `storage/logs/laravel.log`
- Verify API keys in Tabby dashboard
- Ensure correct mode (test/live) is set
- Check API request/response in logs

### Issue: Webhook not received

**Possible Causes:**
1. Webhook URL not configured in Tabby dashboard
2. Local development without ngrok
3. SSL certificate issues (production)
4. Firewall blocking requests

**Solution:**
- Verify webhook URL in Tabby dashboard
- Use ngrok for local testing
- Check server logs for incoming requests
- Test webhook using Tabby's test tool

### Issue: "Invalid signature" in webhook

**Possible Causes:**
1. Wrong secret key used for verification
2. Payload format mismatch
3. Signature header missing

**Solution:**
- Verify `TABBY_SECRET_KEY` matches Tabby dashboard
- Check webhook signature header name
- Review webhook verification code in `TabbyService.php`

### Issue: Payment success but order not created

**Possible Causes:**
1. Session expired
2. Database error
3. Missing required fields

**Solution:**
- Check Laravel logs for errors
- Verify session configuration
- Check database connection
- Review order creation code

---

## File Changes Summary

### Modified Files

1. **app/Services/TabbyService.php**
   - Added `isConfigured()` method
   - Added `getMode()` method
   - Improved test mode detection
   - Enhanced webhook signature verification
   - Better error handling

2. **app/Http/Controllers/TabbyPaymentController.php**
   - Fixed webhook signature verification
   - Improved error logging
   - Better payload handling

3. **app/Http/Controllers/OrderController.php**
   - Fixed bug in payment cancel/failure handlers
   - Improved error handling

4. **resources/views/frontend/pages/booking-details.blade.php**
   - Added Tabby configuration check
   - Show test mode button only when not configured
   - Show mode information when configured

5. **config/services.php**
   - Already configured with Tabby settings
   - No changes needed

### New Files

1. **TABBY_SETUP_GUIDE.md** (this file)
   - Complete setup and testing guide

### Routes

Routes are already configured in `routes/web.php`:
- `/tabby/payment/success` - Success callback
- `/tabby/payment/cancel` - Cancel callback
- `/tabby/payment/failure` - Failure callback
- `/tabby/webhook` - Webhook endpoint (POST only)
- `/tabby/payment/simulate` - Simulation endpoint (for testing)

---

## API Endpoints Reference

### Checkout Session Creation
- **Test**: `https://api.tabby.dev/api/v2/checkout`
- **Production**: `https://api.tabby.ai/api/v2/checkout`

### Payment Status
- **Test**: `https://api.tabby.dev/api/v2/payments/{payment_id}`
- **Production**: `https://api.tabby.ai/api/v2/payments/{payment_id}`

### Webhook URL
- **Local (ngrok)**: `https://your-ngrok-url.ngrok.io/tabby/webhook`
- **Production**: `https://yourdomain.com/tabby/webhook`

---

## Security Best Practices

1. **Never commit `.env` file** - Keep credentials secure
2. **Use environment variables** - Don't hardcode credentials
3. **Verify webhook signatures** - Always validate webhook requests
4. **Use HTTPS in production** - Required for webhooks
5. **Monitor logs** - Track all payment-related activities
6. **Rate limiting** - Consider adding rate limits to payment endpoints
7. **Encrypt sensitive data** - Encrypt session data if storing payment info

---

## Support and Resources

- **Tabby API Documentation**: https://docs.tabby.ai/
- **Tabby Developer Dashboard**: https://tabby.ai/developers
- **Tabby Support**: Contact through developer dashboard

---

## Quick Reference: Environment Variables

```env
# Required for Live Mode
TABBY_SECRET_KEY=sk_live_...
TABBY_PUBLIC_KEY=pk_live_...
TABBY_MERCHANT_CODE=...

# Required for Test Mode
TABBY_SECRET_KEY=sk_test_...
TABBY_PUBLIC_KEY=pk_test_...
TABBY_MERCHANT_CODE=...

# Mode Configuration
TABBY_ENV=test  # or 'live'
TABBY_TEST_MODE=true  # or false

# Optional
TABBY_CURRENCY=AED
TABBY_TEST_EMAIL=otp.success@tabby.ai
TABBY_VERIFY_PAYMENTS=true
```

---

**Last Updated**: January 2025  
**Integration Version**: 1.0  
**Laravel Version**: Compatible with Laravel 8+

