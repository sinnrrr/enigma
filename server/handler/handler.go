package handler

import (
	"github.com/jinzhu/gorm"
	"net/http"

	"../model"

	"github.com/labstack/echo"
)

func Welcome() echo.HandlerFunc {
	return func(c echo.Context) error {
		return c.String(http.StatusOK, "Welcome!")
	}
}

func GetUsers(db *gorm.DB) echo.HandlerFunc {
	return func(context echo.Context) error {
		var u []*model.User

		if err := db.Find(&u).Error; err != nil {
			return err
		}

		return context.JSON(http.StatusOK, u)
	}
}