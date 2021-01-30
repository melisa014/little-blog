
# Введение. Быстрый старт


## Предыстория и задачи SimpleMVC

`SimpleMVC` (`smvc`) -- учебный фреймворк, созданный в [IFF](http://fkn.ktu10.com/?q=iff-itforfree) для того, чтобы сделать изучение бэкэнд-разработки на PHP проще и эффективнее.

Работа с фреймворком является одной из частей [нашего открытого курса по бэкэнд-разработке](http://fkn.ktu10.com/?q=node/7716).


## Паттерн MVC

SMVC  является примером простой реализации шаблона [MVC](http://fkn.ktu10.com/?q=node/9260), это значит  весь код условно разделяется модели, представления и контроллеры.

## Детали реализации


### Ядро отдельно от приложения

SMVC (та версия, на которой мы создаем учебные приложеения) по сути состоит из двух основных частей:

1. **Ядра** (отдельный репозиторий [it-for-free/SimpleMVC](https://github.com/it-for-free/SimpleMVC)) -- решает _универсальные_ задачи, позволяет писать код более структурированно.
2. **Демонстрационного сайта** (также эту часть можно называть _Сайтом_, _Приложением_) (репозиторий [it-for-free/SimpleMVC-example]()), который использует ядро, передав ему необходимую конфигурацию, показывает _конкретный (частный)_ пример использования возможностей ядра. 


В репозитории демонстрационного сайта находятся контроллеры, модели и представления, которые, собственно, и описывают как выглядит и работает сайт, но управления логикой их использоваения осуществляется кодом, лежащим в репозитории ядра.

### Зачем нужно отдельное ядро

**Главная идея** здесь состоит в том, чтобы отделить универсальную логику ядра приложения (в нашем случае это [it-for-free/SimpleMVC](https://github.com/it-for-free/SimpleMVC)), которая будет одинаковой для самых разных сайтов, от того кода, который решает задачи конткретного сайта (как-то обрабатывая данные).





