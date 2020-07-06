package config

import (
	"io/ioutil"
	"path/filepath"

	"log"

	"gopkg.in/yaml.v2"
)

type YamlConfig struct {
	Database struct {
		Default string `yaml:"default"`

		MySql struct {
			Host     string `yaml:"host"`
			Port     string `yaml:"port"`
			User     string `yaml:"user"`
			DbName   string `yaml:"dbname"`
			Pass     string `yaml:"password"`
			Protocol string `yaml:"protocol"`
		}
	}

	Router struct {
		Port string `yaml:"port"`
	}
}

func Parse() YamlConfig {
	fileName, _ := filepath.Abs("./config/main.yaml")
	yamlFile, err := ioutil.ReadFile(fileName)

	if err != nil {
		log.Fatal(err, "\nReading file failed")
	}

	var yamlConfig YamlConfig

	err = yaml.Unmarshal(yamlFile, &yamlConfig)

	if err != nil {
		log.Fatal(err, "\nParsing file failed")
	}

	return yamlConfig
}
