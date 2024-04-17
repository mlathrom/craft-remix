# Remix

![Remix Poster](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

## Descripción general

El campo Remix genera el valor transformado de tu título o slug basado en las reglas que definas, incluyendo:

 - Buscar y reemplazar
 - Transformaciones en mayúsculas, minúsculas y formato de título
 - Agregar texto
 - Anteponer texto

### Características
 - **Actualización en vivo** - a medida que escribes tu título o slug
 - **Expresiones regulares** - para buscar y reemplazar
 - **Ignorar mayúsculas y minúsculas** - para buscar y reemplazar
 - **Filtrar elementos** - en el Panel de control
 - **Ordenar elementos** - en el Panel de control

### Casos de uso
Ordenar, filtrar, traducir, redactar, formatear, SEO

### Traducciones
Inglés, español, francés, alemán, coreano. ¡Más por venir!

## Remix en acción
![Crear reglas de remix](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Transformar títulos y slugs](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![Remezcla tu contenido para ordenar, filtrar, SEO y más.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## Historia de origen
Este campo fue creado para abordar una necesidad específica: eliminar "The" y "A" de los títulos para crear un campo de ordenamiento. De hecho, el nombre original de este plugin era **Sort Title**. Pero después de algunos ajustes, quedó claro que este campo tenía más potencial.

Así nació el campo Remix.

---

## Instalación

Puedes instalar este plugin desde la [tienda de plugins](https://plugins.craftcms.com/remix) o con Composer.

Requiere Craft CMS 5.0.0 o posterior y PHP 8.2 o posterior.

### Con Composer

```bash
# ir al directorio del proyecto
cd /ruta/a/mi-proyecto.test

# decirle a Composer que cargue el plugin
composer require mlathrom/craft-remix

# decirle a Craft que instale el plugin
./craft plugin/install remix
```

---

## Cómo usar
1. Crea un campo Remix
2. Selecciona un objetivo (Título o Slug)
3. Define tus reglas
4. Agrega el campo a tu elemento
5. Remix se autocompleta cuando agregas o modificas el título o slug de un elemento