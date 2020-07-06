package model

import "time"

/*Post struct*/
type Post struct {
	ID          uint      `gorm:"primary_key" json:"id"`
	OwnerID     uint      `json:"owner_id"`
	Category    string    `json:"category"`
	Title       string    `json:"title"`
	Description string    `json:"description"`
	Latitude    decimal   `json:"lat"`
	Longitude   decimal   `json:"lng"`
	Status      string    `json:"status"`
	Reward      string    `json:"reward"`
	CreatedAt   time.Time `json:"created_at"`
	UpdatedAt   time.Time `json:"updated_at"`
	DeletedAt   time.Time `json:"deleted_at"`
}

/*TableName function*/
func (Post) TableName() string { return "posts" }
