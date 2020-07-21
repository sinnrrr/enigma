package model

import "github.com/jinzhu/gorm"

/*Post struct*/
type Post struct {
	gorm.Model
	OwnerID     uint      `json:"owner_id"`
	Category    string    `json:"category"`
	Title       string    `json:"title"`
	Description string    `json:"description"`
	Latitude    int64     `json:"lat"`
	Longitude   int64     `json:"lng"`
	Status      string    `json:"status"`
	Reward      string    `json:"reward"`
}

/*TableName function*/
func (Post) TableName() string { return "posts" }