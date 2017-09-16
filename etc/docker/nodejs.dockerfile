FROM node:6

ADD ./frontend /src
WORKDIR /src
RUN npm install

EXPOSE 8080