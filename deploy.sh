#!/bin/bash

# 🚀 Zmurod E-commerce Production Deployment Script
# Run this script on your production server

echo "🚀 Starting Zmurod E-commerce Production Deployment..."

# Check if running as root
if [[ $EUID -eq 0 ]]; then
   echo "❌ This script should not be run as root"
   exit 1
fi

# Update system packages
echo "📦 Updating system packages..."
sudo apt update && sudo apt upgrade -y

# Install required packages
echo "📦 Installing required packages..."
sudo apt install -y nginx mysql-server php8.1-fpm php8.1-mysql php8.1-xml php8.1-curl php8.1-mbstring php8.1-zip php8.1-gd php8.1-bcmath php8.1-intl php8.1-soap php8.1-redis php8.1-memcached

# Install Composer
echo "🎼 Installing Composer..."
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js and npm
echo "📱 Installing Node.js and npm..."
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs

# Set proper permissions
echo "🔐 Setting file permissions..."
sudo chown -R $USER:www-data storage/
sudo chown -R $USER:www-data bootstrap/cache/
sudo chmod -R 755 storage/
sudo chmod -R 755 bootstrap/cache/

# Install PHP dependencies
echo "📚 Installing PHP dependencies..."
composer install --optimize-autoloader --no-dev

# Install Node dependencies
echo "📱 Installing Node dependencies..."
npm install

# Build production assets
echo "🏗️ Building production assets..."
npm run production

# Generate application key
echo "🔑 Generating application key..."
php artisan key:generate

# Run database migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Seed database
echo "🌱 Seeding database..."
php artisan db:seed --force

# Clear and cache
echo "🧹 Clearing and caching..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Set production environment
echo "⚙️ Setting production environment..."
sed -i 's/APP_ENV=local/APP_ENV=production/' .env
sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env

# Configure Nginx
echo "🌐 Configuring Nginx..."
sudo tee /etc/nginx/sites-available/zmurod-ecommerce << EOF
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/zmurod-ecommerce/public;
    index index.php index.html index.htm;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;

    # Gzip compression
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_proxied expired no-cache no-store private must-revalidate auth;
    gzip_types text/plain text/css text/xml text/javascript application/x-javascript application/xml+rss;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Cache static files
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|pdf|txt)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
EOF

# Enable site
sudo ln -sf /etc/nginx/sites-available/zmurod-ecommerce /etc/nginx/sites-enabled/
sudo rm -f /etc/nginx/sites-enabled/default

# Test Nginx configuration
sudo nginx -t

# Restart services
echo "🔄 Restarting services..."
sudo systemctl restart nginx
sudo systemctl restart php8.1-fpm

# Set up SSL with Let's Encrypt (optional)
echo "🔒 Setting up SSL with Let's Encrypt..."
read -p "Do you want to set up SSL with Let's Encrypt? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    sudo apt install -y certbot python3-certbot-nginx
    sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
fi

# Set up cron for Laravel scheduler
echo "⏰ Setting up cron for Laravel scheduler..."
(crontab -l 2>/dev/null; echo "* * * * * cd /var/www/zmurod-ecommerce && php artisan schedule:run >> /dev/null 2>&1") | crontab -

# Set up log rotation
echo "📝 Setting up log rotation..."
sudo tee /etc/logrotate.d/zmurod-ecommerce << EOF
/var/www/zmurod-ecommerce/storage/logs/*.log {
    daily
    missingok
    rotate 52
    compress
    notifempty
    create 644 www-data www-data
}
EOF

echo "✅ Deployment completed successfully!"
echo "🌐 Your site should now be accessible at: http://yourdomain.com"
echo "📧 Don't forget to:"
echo "   - Update your domain in .env file"
echo "   - Configure your database credentials"
echo "   - Set up your email configuration"
echo "   - Test all functionality"
echo "   - Set up monitoring and backups"
