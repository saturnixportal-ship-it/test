FROM php:8.3-apache

# Install required extensions
RUN apt-get update && apt-get install -y curl \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Create the logs directory before setting permissions
RUN mkdir -p /var/www/html/logs \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod 777 /var/www/html/logs

# Copy all your files
COPY . /var/www/html/

# Enable Apache mod_rewrite (often needed for PHP apps)
RUN a2enmod rewrite

# Important for Render.com
EXPOSE 10000

# Use Render's PORT environment variable
CMD sed -i "s/80/10000/" /etc/apache2/ports.conf && \
    sed -i "s/:80/:10000/" /etc/apache2/sites-available/000-default.conf && \
    apache2-foreground
