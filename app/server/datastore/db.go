package datastore

import (
	"github.com/sinnrrr/enigma/config"

	"github.com/go-sql-driver/mysql"
	"github.com/jinzhu/gorm"
)

func NewDB() (*gorm.DB, error) {
	yamlConfig := config.Parse()
	dbConfig := yamlConfig.Database
	mySqlConfig := dbConfig.MySql

	DBMS := dbConfig.Default

	sqlConfig := &mysql.Config{
		User: mySqlConfig.User,
		Passwd: mySqlConfig.Pass,
		Net: mySqlConfig.Protocol,
		Addr: mySqlConfig.Host + ":" + mySqlConfig.Port,
		DBName: mySqlConfig.DbName,
		AllowNativePasswords: true,
		Params: map[string]string{
			"parseTime": "true",
		},
	}

	return gorm.Open(DBMS, sqlConfig.FormatDSN())
}
