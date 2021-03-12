Тестовое задание для PHP-разработчика.
 
Используя фреймворк Yii2.
Basic или advanced на Ваше усмотрение.


* Реализовать сущности заявки, перевозки и рейса. Перевозки привязаны к заявке. Рейсы к перевозке.
 
* Реализовать административную часть.
CRUD для сущностей.
 
* Реализовать выдачу данных в формате json по RESTful протоколу отдельным контроллером:
 
GET /api/v1/orders получение списка заявок. В объекте заявки передать привязанные перевозки. В объекте перевозок передать привязанные рейсы.
 
POST /api/v1/orders/<order_id>/shipping метод создания перевозки с рейсами к заявке.
 
При создании перевозки отправить уведомление на почтовый ящик администратора.
Почтовый ящик администратора указать в конфигурации приложения.
 
Результат представить ссылкой на репозиторий.
 
Сущности:

Заявка:
1. Отправитель.
2. Тариф.
3. Дистанция.
4. Адрес загрузки.
5. Адрес разгрузки.
 
Перевозка:
1. ID перевозки.
2. Перевозчик.
3. Перевозимый вес.
 
Рейс:
1. ID перевозки.
2. Перевозимый вес.
3. Дата загрузки.
4. Дата выгрузки.
5. Телефон водителя.


API
-------------------


```
/api/v1/orders/1/shipping
-------
{
    "transporter_id": 1,
    "weight": 100,
    "voyages": [
        {
            "date_load": "21.01.2020",
            "date_unload": "22.01.2020",
            "phone": "1221313223",
            "weight": 50
        },
        {
            "date_load": "24.01.2020",
            "date_unload": "27.01.2020",
            "phone": "1221313223",
            "weight": 50
        }
    ]
}
```
