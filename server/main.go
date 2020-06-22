package main

import (
	"./config"
	"./datastore"
	"./graphql"
	"./handler"

	"log"

	"github.com/labstack/echo"
	"github.com/labstack/echo/middleware"
)

func main() {
	// yaml config parsing
	yamlConfig := config.Parse()
	routerConfig := yamlConfig.Router

	// database connection
	db, err := datastore.NewDB()
	logFatal(err)

	db.LogMode(true)
	defer db.Close()

	// router configuration
	e := echo.New()

	e.Use(middleware.Logger())
	e.Use(middleware.Recover())

	e.GET("/", handler.Welcome())
	e.GET("/users", handler.GetUsers(db))

	h, err := graphql.NewHandler(db)
	logFatal(err)
	e.POST("/graphql", echo.WrapHandler(h))
	
	err = e.Start(":" + routerConfig.Port)
	logFatal(err)
}

func logFatal(err error) {
	if err != nil {
		log.Fatal(err)
	}
}
