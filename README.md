Проверка, вошел ли пользователь
http://sarapul.ru/admin/operations/make.php?operation=login&password=123&login=Bicsz


получение любой инфы из любой таблицы по любым ключам и с сортировкой или без пишется в формате:

http://sarapul.ru/admin/operations/make.php?operation=SelectSome&table=(название таблицы без скобок)    - вернет все из талицы

http://sarapul.ru/admin/operations/make.php?operation=SelectSome&table=(название таблицы без скобок)&id=1    - вернет запись с id=1

http://sarapul.ru/admin/operations/make.php?operation=SelectSome&table=(название таблицы без скобок)&id=1&date=curdate    - вернет запись с id=1 и date=текущей дате


создание записи или чего либо еще
http://sarapul.ru/admin/operations/make.php?operation=CreateUpdateSome&table=(название таблицы без скобок)&(название поля в таблице  без скобок)=(значение поля в таблице без скобок)
и так можно сколько угодно значений, если нужно выполнить апдейт то следует добавить table_key=(имя ключа) и table_key_val=(значение ключа)  опять же без скобок все.

удаление чего либо
http://sarapul.ru/admin/operations/make.php?operation=DeleteSome&table=(название таблицы без скобок)&(название поля в таблице  без скобок)=(значение поля в таблице без скобок)

значений так же может быть добавленно сколько угодно с поддержкой sql во всех запросах типо curdate curtime now 


если нужно отправить запрос, который должен содержвть сессионную инфу то нужно написать в запросе .....&key=session_id и сервер подставить id администратора

существуют 3 поля
session_id
session_login
session_password