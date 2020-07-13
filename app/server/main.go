package main

import (
	"github.com/sinnrrr/enigma/config"
	"github.com/sinnrrr/enigma/datastore"
	"github.com/sinnrrr/enigma/graphql"
	"github.com/sinnrrr/enigma/handler"

	"log"

	"github.com/labstack/echo"
	"github.com/labstack/echo/middleware"
)

func main() {
	// yaml config parsing
	yamlConfig := config.Parse()
	routerConfig := yamlConfig.Router

	// router configuration
	e := echo.New()

	// router middleware
	e.Use(middleware.Logger())
	e.Use(middleware.Recover())

	// setting up connection to db
	db, err := datastore.NewDB()
	logFatal(err)

	// enabling logging
	db.LogMode(true)
	defer db.Close()

	// creating new instance of grphql handler
	h, err := graphql.NewHandler(db)
	logFatal(err)
	
	// routes
	e.GET("/", handler.Welcome())
	e.GET("/users", handler.GetUsers(db))
	e.GET("/posts", handler.GetPosts(db))
	e.POST("/graphql", echo.WrapHandler(h))

	// starting router
	err = e.Start(":" + routerConfig.Port)
	logFatal(err)
}

func logFatal(err error) {
	if err != nil {
		log.Fatal(err)
	}
}
