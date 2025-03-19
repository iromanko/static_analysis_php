# PhpStorm PHP Inspections Plugin

## 1. Что такое PhpStorm PHP Inspections?
PhpStorm PHP Inspections (EA Extended) – это мощный плагин для PhpStorm, который расширяет стандартные инспекции IDE, добавляя дополнительные проверки на качество кода, потенциальные ошибки и оптимизации.

## 2. Для чего нужен этот плагин?
Этот плагин помогает:
- Выявлять потенциальные баги и анти-паттерны.
- Улучшать производительность кода.
- Соблюдать лучшие практики кодирования.
- Обнаруживать устаревшие конструкции и неиспользуемый код.

## 3. Установка и настройка
### 3.1 Установка через JetBrains Marketplace
1. Открыть **Preferences → Plugins**.
2. Найти **PHP Inspections (EA Extended)**.
3. Установить и перезапустить PhpStorm.

### 3.2 Настройка инспекций
После установки можно настроить инспекции в **Preferences → Editor → Inspections → PHP → Quality Tools → PHP Inspections (EA Extended)**.

Можно включить или отключить различные категории проверок, такие как:
- Undefined variables (неопределенные переменные).
- Performance issues (проблемы с производительностью).
- Code style issues (нарушения кодстайла).
- Security issues (уязвимости в коде).
- Unused code (неиспользуемые функции и переменные).
- Strict comparison issues (ошибки строгого сравнения `===` vs `==`).

## 4. Использование в PhpStorm
- Подсветка ошибок в реальном времени.
- Быстрое исправление с помощью **Alt + Enter**.
- Возможность игнорирования отдельных предупреждений через `@noinspection`.

### Примеры найденных проблем
#### 4.1 Неинициализированные переменные
```php
function test() {
    echo $var; // PhpStorm Inspections: Undefined variable $var
}
```

#### 4.2 Использование `==` вместо `===`
```php
if ($value == "123") { // PhpStorm Inspections: Possible type juggling issue
    echo "Match found";
}
```
Используйте строгое сравнение:
```php
if ($value === "123") {
    echo "Match found";
}
```

#### 4.3 Неиспользуемый код
```php
function unusedFunction() { // PhpStorm Inspections: Unused function
    return 42;
}
```

#### 4.4 Избыточные вызовы функций
```php
for ($i = 0; $i < count($array); $i++) { // PhpStorm Inspections: count() is called in a loop
    echo $array[$i];
}
```
Рекомендация: сохранить значение `count($array)` в переменную перед циклом.

#### 4.5 Устаревший код
```php
$fp = fopen("file.txt", "r"); // PhpStorm Inspections: Consider using modern file handling functions
```
Рекомендация: использовать `file_get_contents()` или `SplFileObject`.

## 5. Запуск инспекций через CLI в CI/CD
Плагин можно использовать в CI/CD, запуская инспекции через командную строку:
```bash
./bin/inspect.sh ~/project .idea/inspectionProfiles/Project.xml -v2 -o output.xml
```

## 6. Интеграция с GitHub Actions
Пример workflow для автоматического запуска инспекций:
```yaml
name: PhpStorm Inspections

on: [push, pull_request]

jobs:
  inspections:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout repository
        uses: actions/checkout@v3
      
      - name: Set up PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.1'

      - name: Run PhpStorm Inspections
        run: ./bin/inspect.sh . .idea/inspectionProfiles/Project.xml -v2 -o output.xml
```

## 7. Преимущества и недостатки
### Преимущества
- Глубокая интеграция с PhpStorm.
- Расширенные проверки, которых нет в стандартных инспекциях IDE.
- Гибкость в настройке.
- Поддержка Suppress-аннотаций (`@noinspection`).

### Недостатки
- Запуск через CLI в CI/CD может быть медленным.
- Требуется PhpStorm, что может быть проблемой для headless-сред.
- Не так детализирован, как Psalm или PHPStan.

## 8. Заключение
PhpStorm PHP Inspections – это мощный инструмент для статического анализа, который удобен в повседневной разработке и CI/CD. Однако, из-за возможных ограничений по производительности, его лучше использовать в сочетании с другими анализаторами, такими как Psalm или PHPStan.
