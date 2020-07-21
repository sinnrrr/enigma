package datastore

import (
	"github.com/sinnrrr/enigma/config"
	"github.com/go-sql-driver/mysql"
	"github.com/jinzhu/gorm"
)

/*NewDB method*/
func NewDB() (*gorm.DB, error) {
	yamlConfig := config.Parse()
	dbConfig := yamlConfig.Database
	mySQLConfig := dbConfig.MySql

	DBMS := dbConfig.Default

	sqlConfig := &mysql.Config{
		User: mySQLConfig.User,
		Passwd: mySQLConfig.Pass,
		Net: mySQLConfig.Protocol,
		Addr: mySQLConfig.Host + ":" + mySQLConfig.Port,
		DBName: mySQLConfig.DbName,
		AllowNativePasswords: true,
		Params: map[string]string{
			"parseTime": "true",
		},
	}

	return gorm.Open(DBMS, sqlConfig.FormatDSN())
}
