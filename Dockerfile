# Use an official PHP image with Apache
FROM php:8.4-apache

# Set the working directory inside the container's web root
WORKDIR /var/www/html

# Install necessary PHP extensions (e.g., mysqli for MySQL connection)
# You might need other extensions depending on your app (e.g., gd, pdo_mysql, etc.)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache's rewrite module (often needed for frameworks/clean URLs)
RUN a2enmod rewrite

# Remove the default Apache index.html (if it exists)
RUN rm /var/www/html/index.html || true
EXPOSE 80
