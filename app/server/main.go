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

	e.Use(middleware.Logger())
	e.Use(middleware.Recover())
	
	for db, err := datastore.NewDB(); err != nil; {
		db.LogMode(true)
		defer db.Close()

		h, err := graphql.NewHandler(db)
		logFatal(err)

		e.GET("/", handler.Welcome())
		e.GET("/users", handler.GetUsers(db))
		e.GET("/posts", handler.GetPosts(db))

		e.POST("/graphql", echo.WrapHandler(h))

		err = e.Start(":" + routerConfig.Port)
		logFatal(err)
	}
}

func logFatal(err error) {
	if err != nil {
		log.Fatal(err)
	}
}
