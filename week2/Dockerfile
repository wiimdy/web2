FROM node:current-alpine

WORKDIR /app

COPY ./ ./

RUN npm install

RUN npm run build

EXPOSE 8777

CMD ["npm", "start"]