# Iniciar los servicios de Docker
up:
	docker-compose up -d

# Detener los servicios de Docker
down:
	docker-compose down

# Reiniciar los servicios de Docker
restart: down up

# Ver los logs de los servicios de Docker
logs:
	docker-compose logs -f

# Construir las imágenes de Docker
build:
	docker-compose build

# Ejecutar las pruebas con PHPUnit
test:
	docker exec -it php_docfav php vendor/bin/phpunit --testdox tests

# Ejecutar un shell en el contenedor PHP
shell:
	docker exec -it php_docfav sh

# Ejecutar migraciones de Doctrine
migrate:
	docker exec -it php_docfav php vendor/bin/doctrine-migrations migrate

# Crear la base de datos
createdb:
	docker exec -it php_docfav php vendor/bin/doctrine orm:schema-tool:create

# Eliminar la base de datos
dropdb:
	docker exec -it php_docfav php vendor/bin/doctrine orm:schema-tool:drop --force