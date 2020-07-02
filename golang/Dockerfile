FROM golang

WORKDIR /server/
RUN mkdir build

COPY go.mod go.sum /build/

RUN go mod download

COPY . /build/

RUN go build -o main .
RUN cp main ../dist

CMD ["/dist/main"]

EXPOSE 8001