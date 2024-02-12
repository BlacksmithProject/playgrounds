#!/bin/sh

# Variables
host="http://rabbit_playgrounds:15672" # Adresse du serveur RabbitMQ
user="user" # Utilisateur RabbitMQ
password="password" # Mot de passe RabbitMQ
vhost="%2F" # Vhost RabbitMQ

# Création de l'exchange
curl -v -u "$user:$password" -X PUT "$host/api/exchanges/$vhost/orders" \
     -H "content-type:application/json" \
     -d @/scripts/exchange.json

# Création de la queue
curl -v -u "$user:$password" -X PUT "$host/api/queues/$vhost/orders_queue" \
     -H "content-type:application/json" \
     -d @/scripts/queue.json

# Création du binding
curl -v -u "$user:$password" -X POST "$host/api/bindings/$vhost/e/orders/q/orders_queue" \
     -H "content-type:application/json" \
     -d @/scripts/binding.json
