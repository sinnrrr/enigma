FROM golang

WORKDIR /var/www/server
RUN mkdir build

COPY /var/www/server/go.mod /build
COPY go.sum /build

RUN go mod download

COPY . /build

RUN go build -o main .
RUN cp main ../dist

CMD ["/dist/main"]

EXPOSE 8001