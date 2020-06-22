package field

import (
	"github.com/graphql-go/graphql"
	"github.com/jinzhu/gorm"
	"log"

	"../../model"
)

var user = graphql.NewObject(
	graphql.ObjectConfig{
		Name: "User",
		Fields: graphql.Fields{
			"id":        &graphql.Field{Type: graphql.ID},
			"email":     &graphql.Field{Type: graphql.String},
			"password":  &graphql.Field{Type: graphql.String},
			"phone":     &graphql.Field{Type: graphql.String},
			"address":   &graphql.Field{Type: graphql.String},
			"createdAt": &graphql.Field{Type: graphql.String},
			"updatedAt": &graphql.Field{Type: graphql.String},
			"deletedAt": &graphql.Field{Type: graphql.String},
		},
		Description: "Users data",
	},
)

func NewUsers(db *gorm.DB) *graphql.Field {
	return &graphql.Field{
		Type: graphql.NewList(user),
		Resolve: func(p graphql.ResolveParams) (i interface{}, e error) {
			var u []*model.User
			if err := db.Find(&u).Error; err != nil {
				log.Fatal(err)
			}

			return u, nil
		},
		Description: "user",
	}
}
