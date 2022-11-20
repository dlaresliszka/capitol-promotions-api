FROM nginx:1.19

ARG USER_ID
EXPOSE $USER_ID

RUN adduser -u ${USER_ID} --disabled-password --gecos "" appuser

COPY default.conf /etc/nginx/conf.d/
