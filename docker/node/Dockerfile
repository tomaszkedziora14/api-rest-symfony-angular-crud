FROM node:10.14-alpine

#Linux setup
#RUN apt update \
#  && apt install --update alpine-sdk \
#  && apt del alpine-sdk \
#  && rm -rf /tmp/* /var/cache/apk/* *.tar.gz ~/.npm \
#  && npm cache verify \
#  && sed -i -e "s/bin\/ash/bin\/sh/" /etc/passwd

#Angular CLI

RUN npm config set unsafe-perm truea

WORKDIR /var/www/front/

RUN npm i -g npm

RUN npm install -g @angular/cli

# ADD entrypoint.sh /var/www/entrypoint.sh
# RUN chmod +x /var/www/entrypoint.sh

# ENTRYPOINT ["/var/www/entrypoint.sh"]

CMD ["npm","start"]