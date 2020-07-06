package model

import "time"

/*User struct*/
type User struct {
	ID        uint      `gorm:"primary_key" json:"id"`
	Email     string    `json:"email"`
	Password  string    `json:"password"`
	Phone     string    `json:"phone"`
	Address   string    `json:"address"`
	CreatedAt time.Time `json:"created_at"`
	UpdatedAt time.Time `json:"updated_at"`
	DeletedAt time.Time `json:"deleted_at"`
}

/*TableName function*/
func (User) TableName() string { return "users" }
