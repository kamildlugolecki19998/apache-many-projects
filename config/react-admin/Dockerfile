# Dockerfile - Node.js + Yarn
FROM node:18 AS symfony_assets_builder

# Ustaw katalog roboczy w kontenerze
WORKDIR /usr/src/app

RUN usermod -u 1000 node && groupmod -g 1000 node


# Kopiowanie plików package.json i yarn.lock
# COPY ./../projects/react-admin/package.json ./../projects/react-admin/package-lock.json ./

RUN chown -R node:node /usr/src/app
COPY ./../projects/react-admin /usr/src/app

# RUN npm install

# RUN npm run build
#RUN npx create-react-app .
#RUN rm -rf src/*
#RUN npm install @api-platform/admin
#RUN npm install -g @api-platform/client-generator

RUN chown -R node:node /usr/src/app
# Ekspozycja portu (jeśli jest to wymagane)
EXPOSE 3001

# Komenda do uruchomienia serwisu (jeśli potrzebujesz)
CMD ["npm", "start"]