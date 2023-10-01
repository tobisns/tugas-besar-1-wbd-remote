# Use the official PHP with Apache image as the base image
FROM php:8.2-apache

# Install the required PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Enable Apache modules (if needed)
RUN a2enmod rewrite

# Set your working directory
WORKDIR /var/www/html

# Copy your PHP application files into the container
COPY . .

# Expose port 80 for Apache
EXPOSE 80

# Define the entrypoint for Apache
CMD ["apache2-foreground"]