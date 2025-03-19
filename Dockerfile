FROM php:8.3-cli-alpine

RUN apk add --no-cache bash

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

CMD ["/bin/bash"]
