# Tabby Integration - Quick Reference Card

## 🚀 Quick Start

### 1. Configure Environment Variables

```env
# For Test/Sandbox
TABBY_ENV=test
TABBY_SECRET_KEY=sk_test_...
TABBY_PUBLIC_KEY=pk_test_...
TABBY_MERCHANT_CODE=...

# For Production
TABBY_ENV=live
TABBY_SECRET_KEY=sk_live_...
TABBY_PUBLIC_KEY=pk_live_...
TABBY_MERCHANT_CODE=...
```

### 2. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
```

### 3. Test Payment Flow

- Go to booking page
- Select "Tabby" payment method
- Complete booking form
- Submit payment

---

## 🔄 Switching Modes

### Test → Live
```env
TABBY_ENV=live
# or
TABBY_TEST_MODE=false
```

### Live → Test
```env
TABBY_ENV=test
# or
TABBY_TEST_MODE=true
```

**Then**: `php artisan config:clear`

---

## 🧪 Testing Without Credentials

If API keys are not configured:
- System automatically shows "Simulate Payment" button
- Click button to test order creation flow
- No actual payment processing

---

## 🔗 Webhook Setup (Local Testing)

1. Start Laravel: `php artisan serve`
2. Start ngrok: `ngrok http 8000`
3. Copy ngrok URL: `https://abc123.ngrok.io`
4. Configure in Tabby Dashboard:
   - Settings > Webhooks
   - Add: `https://abc123.ngrok.io/tabby/webhook`

---

## 📋 Checklist

### Before Testing
- [ ] Environment variables configured
- [ ] Config cache cleared
- [ ] Tabby credentials valid
- [ ] Webhook URL configured (if testing webhooks)

### Before Production
- [ ] Production credentials configured
- [ ] `TABBY_ENV=live` set
- [ ] Webhook URL configured in Tabby Dashboard
- [ ] SSL certificate valid
- [ ] Tested with small amount
- [ ] Logs monitored

---

## 🐛 Common Issues

| Issue | Solution |
|-------|----------|
| "Not configured" error | Check `.env` has `TABBY_SECRET_KEY` |
| Wrong API endpoint | Check `TABBY_ENV` value |
| Webhook not received | Use ngrok for local testing |
| Invalid signature | Verify `TABBY_SECRET_KEY` matches dashboard |

---

## 📞 Support

- **Full Guide**: `TABBY_SETUP_GUIDE.md`
- **Summary**: `TABBY_INTEGRATION_SUMMARY.md`
- **Tabby Docs**: https://docs.tabby.ai/

---

**Last Updated**: January 2025

