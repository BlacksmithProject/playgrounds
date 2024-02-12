# Utiliser une image de base qui a bash, curl et netcat (nc) disponibles
FROM alpine:3.12

# Installer curl et netcat
RUN apk --no-cache add curl netcat-openbsd

# Copier les scripts locaux dans l'image
COPY ./ /scripts

# Rendre le script principal exécutable
RUN chmod +x /scripts/init-rabbitmq.sh
RUN chmod +x /scripts/script.sh
