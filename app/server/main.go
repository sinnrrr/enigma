package main

import (
	"github.com/sinnrrr/enigma/config"
	"github.com/sinnrrr/enigma/datastore"
	"github.com/sinnrrr/enigma/graphql"
	"github.com/sinnrrr/enigma/handler"
	// "github.com/sinnrrr/enigma/model"

	"log"

	// "github.com/qor/admin"

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

	// Admin := admin.New(&admin.AdminConfig{DB: db})

	// Admin.AddResource(&model.User{})
	// Admin.AddResource(&model.Post{})

	// creating new instance of graphql handler
	h, err := graphql.NewHandler(db)
	logFatal(err)
	
	// routes
	e.GET("/", handler.Welcome())
	e.GET("/users", handler.GetUsers(db))
	e.GET("/posts", handler.GetPosts(db))
	e.POST("/graphql", echo.WrapHandler(h))

	// Handler
	// adminHandler := echo.WrapHandler(Admin.NewServeMux("/admin"))
	// e.GET("/admin", adminHandler)
	// e.Any("/admin/*", adminHandler)

	// starting router
	e.Logger.Fatal(e.Start(":" + routerConfig.Port))
}

func logFatal(err error) {
	if err != nil {
		log.Fatal(err)
	}
}
