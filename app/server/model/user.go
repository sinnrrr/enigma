package model

import "github.com/jinzhu/gorm"

/*User struct*/
type User struct {
	gorm.Model
	Email     string    `json:"email"`
	Password  string    `json:"password"`
	Phone     string    `json:"phone"`
	Address   string    `json:"address"`
}

/*TableName function*/
func (User) TableName() string { return "users" }
