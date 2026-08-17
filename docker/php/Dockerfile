FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip curl \
    libzip-dev libicu-dev libonig-dev libxml2-dev libsqlite3-dev default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring xml dom zip bcmath intl \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Match the host user so bind-mounted files (vendor/, node_modules/, storage/
# cache, .env) come out owned by the developer, not root.
ARG APP_UID=1000
ARG APP_GID=1000
RUN groupadd -g ${APP_GID} appuser 2>/dev/null || true \
    && useradd -u ${APP_UID} -g ${APP_GID} -m -s /bin/sh appuser 2>/dev/null || true

WORKDIR /var/www/html

# Pre-create the mount points for the named volumes (vendor/, node_modules/)
# with correct ownership -- when Docker initializes an empty named volume it
# copies whatever's at that path in the image, ownership included, so this is
# what keeps composer/npm (running as appuser below) able to write there.
RUN mkdir -p vendor node_modules \
    && chown -R ${APP_UID}:${APP_GID} /var/www/html

COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

USER appuser

EXPOSE 8000

ENTRYPOINT ["entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
