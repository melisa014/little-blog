# Обработка ошибок

В ходе использования приложении SimpleMVC могут возникать различные ошибки и в 
этом случае будут сгенерированы исключения, в их числе:

* Ошибки маршрутизации
* Ошибки доступа
* Ошибки конфигурации
* Ошибки использования

В методе run()  класса Application код обработки запроса обёрнут в блок try/catch

```php
// \ItForFree\SimpleMVC\Application.php
...
   public function run() {
        
        $exceptionHandler = new ExceptionHandler();
        try{
            if (!empty($this->config)) {
                $route = $this->getConfigObject('core.url.class')::getRoute();
                /**
                 * @var ItForFree\SimpleMVC\Router
                 */
                $Router = $this->getConfigObject('core.router.class');

                $Router->callControllerAction($route);

            } else {
                throw new SmvcCoreException('Не задан конфигурационный массив приложения!');
            }


            return $this;
        
        } catch (Exception $exc) {
            $exceptionHandler->handleException($exc);
        }
    }
...
```

В случае возникновения ошибки результат будет передан в специальный обработчик который перехватывает все возникающие исключения и либо  передает пользовательскому обработчику описанному в конфигурации, либо  если не находит подходящий обработчик пробрасывает дальше. 

В пользовательском коде демонстрационного приложения создан пример обработчика который реализует интерфейс ExceptionHandlerInterface и служит для обработки ошибок маршрутизации и доступа.



## Создаём собственный обработчик

## Настраиваем отображения ошибок
