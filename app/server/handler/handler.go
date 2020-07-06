package handler

import (
	"github.com/jinzhu/gorm"
	"net/http"

	"github.com/sinnrrr/enigma/model"

	"github.com/labstack/echo"
)

/*Welcome handler*/
func Welcome() echo.HandlerFunc {
	return func(c echo.Context) error {
		return c.String(http.StatusOK, "Welcome!")
	}
}

/*GetUsers handler*/
func GetUsers(db *gorm.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var u []*model.User

		if err := db.Find(&u).Error; err != nil {
			return err
		}

		return c.JSON(http.StatusOK, u)
	}
}

/*GetPosts handler*/
func GetPosts(db *gorm.DB) echo.HandlerFunc {
	return func(c echo.Context) error {
		var u []*model.Post

		if err := db.Find(&u).Error; err != nil {
			return err
		}

		return c.JSON(http.StatusOK, u)
	}
}