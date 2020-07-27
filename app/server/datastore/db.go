package datastore

import (
	"fmt"
	"github.com/jinzhu/gorm"
	_ "github.com/jinzhu/gorm/dialects/postgres"
	"github.com/sinnrrr/enigma/config"
)

/*NewDB method*/
func NewDB() (*gorm.DB, error) {
	yamlConfig := config.Parse()
	postgres := yamlConfig.Database.Postgres

	psqlInfo := fmt.Sprintf("host=%s port=%s user=%s password=%s dbname=%s sslmode=disable",
		postgres.Host, postgres.Port, postgres.User, postgres.Pass, postgres.DbName)

	return gorm.Open("postgres", psqlInfo)
}
