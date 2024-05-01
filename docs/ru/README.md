# Remix

![Remix Poster](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md), [Русский](docs/ru/README.md)

## Обзор

Поле Remix выводит преобразованное значение вашего заголовка или слага на основе определенных вами правил, включая:

 - Поиск и замена
 - Преобразования в верхний регистр, нижний регистр и регистр заголовка
 - Добавление текста в конец
 - Добавление текста в начало

### Возможности
 - **Обновление в реальном времени** - по мере ввода заголовка или слага
 - **Регулярные выражения** - для поиска и замены
 - **Игнорирование регистра** - для поиска и замены 
 - **Фильтрация элементов** - в панели управления
 - **Сортировка элементов** - в панели управления

### Варианты использования
Сортировка, фильтрация, перевод, редактирование, форматирование, SEO

## Как использовать
1. Создайте поле Remix
2. Выберите цель (заголовок или слаг)
3. Определите свои правила
4. Добавьте поле к вашему элементу
5. Remix автоматически заполняется при добавлении или изменении заголовка или слага элемента

## Remix в действии 
![Создание правил Remix](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Преобразование заголовков и слагов](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1) 
![Remix вашего контента для сортировки, фильтрации, SEO и многого другого.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## История создания
Это поле было создано для решения конкретной задачи: удаления "The" и "A" из заголовков для создания поля сортировки. На самом деле, оригинальное название этого плагина было **Sort Title**. Но после некоторых экспериментов стало ясно, что у этого поля есть больше потенциала.

Так родилось поле Remix.

---

## Установка

Вы можете установить этот плагин из [Магазина плагинов](https://plugins.craftcms.com/remix) или с помощью Composer.

Требуется Craft CMS 5.0.0 или выше и PHP 8.2 или выше.

### С помощью Composer

```bash
# перейдите в каталог проекта
cd /path/to/my-project.test

# скажите Composer загрузить плагин  
composer require mlathrom/craft-remix

# скажите Craft установить плагин
./craft plugin/install remix
```
