# Remix

![Remix Poster](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md), [Русский](docs/ru/README.md)

## Descripción general

El campo Remix genera el valor transformado de tu título o slug basado en las reglas que definas, incluyendo:

 - Buscar y reemplazar (con soporte de regex)
 - Transformaciones en mayúsculas, minúsculas y formato de título
 - Agregar texto
 - Anteponer texto

### Características
 - **Vista previa en vivo** - prueba tus reglas en tiempo real con un desglose regla por regla
 - **Validación de regex en línea** - ve los errores mientras escribes tus patrones
 - **Expresiones regulares** - para buscar y reemplazar
 - **Ignorar mayúsculas y minúsculas** - para buscar y reemplazar
 - **Reglas de plantilla** - agrega rápidamente patrones comunes como eliminar artículos, puntuación o colapsar espacios en blanco
 - **Todos los tipos de elementos** - funciona con entradas, categorías y cualquier elemento con título o slug
 - **Filtrar y ordenar elementos** - en el Panel de control

### Casos de uso
Ordenar, filtrar, traducir, redactar, formatear, SEO

## Cómo usar
1. Crea un campo Remix
2. Selecciona un objetivo (Título o Slug)
3. Define tus reglas (o usa los botones de plantilla para patrones comunes)
4. Agrega el campo al diseño de campos de tu elemento
5. Remix se autocompleta cuando guardas el elemento

## Remix en acción
![Crear reglas de remix](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Transformar títulos y slugs](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![Remezcla tu contenido para ordenar, filtrar, SEO y más.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## Historia de origen
Este campo fue creado para abordar una necesidad específica: eliminar "The" y "A" de los títulos para crear un campo de ordenamiento. De hecho, el nombre original de este plugin era **Sort Title**. Pero después de algunos ajustes, quedó claro que este campo tenía más potencial.

Así nació el campo Remix.

---

## Actualización a v2.0.0

La versión 2.0.0 incluye cambios incompatibles con migración automática:

- **Los nombres de propiedades** cambiaron de PascalCase a camelCase (ej. `RemixTarget` → `target`)
- **El almacenamiento de reglas** cambió de arrays indexados a arrays asociativos
- **Craft 4 ya no es compatible** — usa la línea 0.x para Craft 4

La migración se ejecuta automáticamente cuando actualizas. Haz una copia de seguridad de tu base de datos primero.

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
