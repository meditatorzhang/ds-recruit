FROM php:8.3-cli-alpine

# 安装 make 和其他可能需要的构建工具
RUN apk add --no-cache make gcc g++ \
    && apk add --no-cache alpine-sdk

WORKDIR /srv

