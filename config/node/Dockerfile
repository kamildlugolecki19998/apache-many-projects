# Dockerfile - Node.js + Yarn
FROM node:18 AS symfony_assets_builder

# Ustaw katalog roboczy w kontenerze
WORKDIR /usr/src/app

# Instalacja Yarn globalnie
# RUN npm install -g yarn 
RUN npm install --force -g yarn


RUN usermod -u 1000 node && groupmod -g 1000 node
# Kopiowanie plików package.json i yarn.lock
# COPY ./../projects/symfonyeasyadmin/package.json ./../projects/symfonyeasyadmin/yarn.lock ./

# COPY ./../projects/symfonyeasyadmin /usr/src/app


COPY ./../projects/api-platfrom3p2/package.json ./../projects/api-platfrom3p2/package-lock.json ./

# Instalacja zależności
# RUN yarn install --force 

#RUN yarn install
# # Instalacja biublioteki do kursu 
#RUN yarn add snarkdown --dev

RUN npm install

# Kopiowanie pozostałych plików aplikacji frontendowej
COPY ./../projects/api-platfrom3p2 /usr/src/app

# Budowanie aplikacji frontendowej
RUN npm install
RUN npm run build

# RUN cp -R /usr/src/app/public/* ./../projects/api-platfrom3p2/public/



# Ekspozycja portu (jeśli jest to wymagane)
EXPOSE 3000

# Komenda do uruchomienia serwisu (jeśli potrzebujesz)
# CMD ["npm", "build"]
CMD ["npm", "watch"]