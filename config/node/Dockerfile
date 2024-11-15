# Dockerfile - Node.js + Yarn
FROM node:18 AS symfony_assets_builder

# Ustaw katalog roboczy w kontenerze
WORKDIR /usr/src/app

# Instalacja Yarn globalnie
# RUN npm install -g yarn 
RUN npm install --force -g yarn


RUN usermod -u 1000 node && groupmod -g 1000 node
# Kopiowanie plików package.json i yarn.lock
COPY ./../projects/symfonyeasyadmin/package.json ./../projects/symfonyeasyadmin/yarn.lock ./

COPY ./../projects/symfonyeasyadmin /usr/src/app

# Instalacja zależności
RUN yarn install --force 

RUN yarn install
# # Instalacja biublioteki do kursu 
RUN yarn add snarkdown --dev


# Kopiowanie pozostałych plików aplikacji frontendowej
COPY ./../projects/symfonyeasyadmin /usr/src/app

# Budowanie aplikacji frontendowej
RUN yarn build


# RUN cp -R /usr/src/app/public/* ./../projects/symfonyeasyadmin/


# Ekspozycja portu (jeśli jest to wymagane)
EXPOSE 3000

# Komenda do uruchomienia serwisu (jeśli potrzebujesz)
CMD ["yarn", "watch"]