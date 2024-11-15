FROM mysql:8.4.0

COPY ./config/database/entrypoint.sh /docker-entrypoint-initdb.d/entrypoint.sh

RUN echo "Dostępne bazy danych:"
RUN mysql -uroot -p"$MYSQL_ROOT_PASSWORD" -e "SHOW DATABASES;"


# Tworzenie użytkownika db_user z hasłem pass
RUN mysql -uroot -p"$MYSQL_ROOT_PASSWORD"  -h 0.0.0.0 -e "CREATE USER IF NOT EXISTS 'db_user'@'%' IDENTIFIED BY 'db_pass';"

RUN echo "Tworzenie bazy danych: $DB"
RUN mysql -uroot -p"$MYSQL_ROOT_PASSWORD"  -e "CREATE DATABASE IF NOT EXISTS db;"
RUN mysql -uroot -p"$MYSQL_ROOT_PASSWORD"  -e "GRANT ALL PRIVILEGES ON db.* TO 'db_user'@'%';"

RUN mysql -uroot -p"$MYSQL_ROOT_PASSWORD" -e "FLUSH PRIVILEGES;"

# ENTRYPOINT ["docker-entrypoint.sh[]