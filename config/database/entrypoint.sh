#!/bin/bash

# Sprawdzanie czy zmienna MYSQL_DATABASES jest ustawiona
if [ -z "$MYSQL_DATABASES" ]; then
  echo "Zmienna środowiskowa MYSQL_DATABASES nie jest ustawiona. Zakończenie pracy skryptu."
  exit 1
fi

echo "Dostępne bazy danych:"
mysql -uroot -p"$MYSQL_ROOT_PASSWORD" -e "SHOW DATABASES;"

# Czekanie 5 sekund na pełne uruchomienie MySQL
echo "Oczekiwanie 5 sekund na pełne uruchomienie MySQL..."
sleep 5

echo "Oczekiwanie na uruchomienie MySQL..."
RETRIES=30
until mysqladmin ping -h "127.0.0.1" --silent || [ $RETRIES -eq 0 ]; do
    echo "MySQL nie jest jeszcze dostępny. Próba ponowna za 1 sekundę..."
    sleep 1
    RETRIES=$((RETRIES-1))
done

if [ $RETRIES -eq 0 ]; then
  echo "MySQL nie jest dostępny po 30 sekundach. Zakończenie skryptu."
  exit 1
fi

# Tworzenie użytkownika db_user z hasłem pass
echo mysql -uroot -pdb_pass -e "SHOW DATABASES";
mysql -uroot -p"$MYSQL_ROOT_PASSWORD"  -h 0.0.0.0 -e "CREATE USER IF NOT EXISTS 'db_user'@'%' IDENTIFIED BY 'db_pass';"

# Podział bazy danych
IFS=',' read -ra DATABASES <<< "$MYSQL_DATABASES"

# Tworzenie baz danych i nadawanie uprawnień użytkownikowi db_user
for DB in "${DATABASES[@]}"; do
  echo "Tworzenie bazy danych: $DB"
  mysql -uroot -p"$MYSQL_ROOT_PASSWORD"  -h 0.0.0.0 -e "CREATE DATABASE IF NOT EXISTS \`$DB\`;"
  mysql -uroot -p"$MYSQL_ROOT_PASSWORD"  -h 0.0.0.0 -e "GRANT ALL PRIVILEGES ON \`$DB\`.* TO 'db_user'@'%';"
done

# Odświeżenie uprawnień
mysql -uroot -p"$MYSQL_ROOT_PASSWORD" -h 0.0.0.0  -e "FLUSH PRIVILEGES;"

echo "Bazy danych i użytkownik zostały utworzone."