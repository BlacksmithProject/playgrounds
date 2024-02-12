#!/bin/sh
# init-rabbitmq.sh

# Attendre que RabbitMQ soit prêt
RABBITMQ_HOST=rabbit_playgrounds
RABBITMQ_MANAGEMENT_PORT=15672

echo "Attente de RabbitMQ sur $RABBITMQ_HOST:$RABBITMQ_MANAGEMENT_PORT"
while ! nc -z $RABBITMQ_HOST $RABBITMQ_MANAGEMENT_PORT; do
  sleep 1
done

echo "RabbitMQ est disponible. Exécution du script de configuration."

# Exécuter le script de configuration
/scripts/script.sh
