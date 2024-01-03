# Utilisez une image de base, par exemple une image Linux Alpine
FROM alpine:latest

# Copiez vos fichiers dans le conteneur
COPY . /app

# Définissez le répertoire de travail
WORKDIR /app

# Installez les dépendances ou effectuez d'autres opérations nécessaires
RUN apk add --no-cache python3

# Commande par défaut pour exécuter votre application
CMD ["python3", "app.py"]
