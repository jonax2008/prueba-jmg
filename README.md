# Ejecución del Proyecto

Para ejecutar este proyecto, sigue los siguientes pasos:

## Pasos para la Ejecución

1. **Construir la Imagen Docker**

    Ejecuta `make up` para consutrir la imagen de Docker y levantar los servicios de php y msql
    ```

2. **Crear la base de datos**

    - Ejecuta `make createdb` para crear la base de datos
    - Ejecuta `male createtb` para crear la tabla a partir de las entidades mapeadas por el ORM. Se debe crear la tabla `users`
    ```

3. **Ejecutar las pruebas unitarias y de integración**

    Ejecuta `make test` esto ejecutará las pruebas unitarias de:
        - ValueObjects
        - User (Entity)
        - RegisterUserUseCase

    Y la prueba de integración

[!IMPORTANT] El puerto 3307 en el host debe estar libre para montar el servicio de MYSQL en caso contrario cambiarlo en Dockerfile