# 🚀 Production Setup Guide for Zmurod E-commerce

## **Step 1: Environment Configuration**

Create a `.env` file in your project root with these production settings:

```bash
APP_NAME="Zmurod E-commerce"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zmurod_ecommerce
DB_USERNAME=your_db_username
DB_PASSWORD=your_secure_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"

# Security Settings
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
```

## **Step 2: Generate Application Key**

```bash
php artisan key:generate
```

## **Step 3: Database Setup**

```bash
# Run migrations
php artisan migrate

# Seed initial data
php artisan db:seed

# Optimize database
php artisan optimize
```

## **Step 4: Build Production Assets**

```bash
# Install dependencies
npm install

# Build production assets
npm run production
```

## **Step 5: File Permissions**

```bash
# Set proper permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod -R 755 public/
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
```

## **Step 6: Security Hardening**

1. **HTTPS Setup**: Configure SSL certificate
2. **Rate Limiting**: Add to `app/Http/Kernel.php`
3. **Security Headers**: Configure in web server
4. **File Upload Security**: Validate all uploads

## **Step 7: Performance Optimization**

```bash
# Cache routes
php artisan route:cache

# Cache config
php artisan config:cache

# Cache views
php artisan view:cache

# Queue setup (optional)
php artisan queue:work
```

## **Step 8: Monitoring & Logging**

1. Set up error monitoring (Sentry, Bugsnag)
2. Configure log rotation
3. Set up backup system
4. Monitor performance metrics

## **Step 9: Testing Checklist**

- [ ] User registration/login
- [ ] Product browsing/search
- [ ] Cart functionality
- [ ] Checkout process
- [ ] Order management
- [ ] Seller dashboard
- [ ] Admin panel
- [ ] Mobile responsiveness
- [ ] Payment processing
- [ ] Email notifications

## **Step 10: Go Live**

1. Point domain to server
2. Test all functionality
3. Monitor for errors
4. Set up monitoring alerts

## **Critical Security Notes**

- Never commit `.env` file to version control
- Use strong, unique passwords
- Enable HTTPS everywhere
- Regular security updates
- Monitor access logs
- Backup regularly
