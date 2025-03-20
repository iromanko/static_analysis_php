# PHP Mess Detector (PHPMD)

## 1. Что такое PHPMD?
PHP Mess Detector (PHPMD) – это инструмент статического анализа кода, предназначенный для выявления потенциальных проблем в коде. Он помогает находить сложные, запутанные или небезопасные участки кода, которые могут привести к проблемам в поддержке и развитии проекта.

## 2. Для чего нужен PHPMD?
PHPMD используется для:
- Поиска длинных и сложных методов.
- Выявления избыточности кода.
- Обнаружения нарушений принципов проектирования.
- Поиска потенциальных ошибок (например, неиспользуемых переменных).
- Улучшения читаемости и поддержки кода.

## 3. Установка и настройка
PHPMD можно установить через Composer:
```bash
composer require --dev phpmd/phpmd
```
После установки можно проверить версию:
```bash
vendor/bin/phpmd --version
```

## 4. Использование в PhpStorm
### 4.1. Настройка PHPMD в PhpStorm
1. Открыть **Preferences** (*⌘ + ,* на macOS, *Ctrl + Alt + S* на Windows/Linux).
2. Перейти в **Languages & Frameworks → PHP → Quality Tools**.
3. В разделе **PHP Mess Detector** указать путь к бинарному файлу PHPMD (`vendor/bin/phpmd`).
4. В **Ruleset** выбрать стандартные правила или указать кастомные.
5. Нажать **Apply** и **OK**.

### 4.2. Проверка кода в PhpStorm
1. Открыть файл PHP.
2. Включить **Code Inspections**.
3. Проблемные участки кода будут подсвечены в редакторе.

## 5. Использование в GitHub Actions
PHPMD можно запускать автоматически при каждом коммите.

### 5.1. Пример конфигурации GitHub Actions
Создадим файл [.github/workflows/phpmd.yaml`](../.github/workflows/phpmd.yaml).

Этот workflow анализирует код, используя три набора правил: **cleancode**, **codesize** и **unusedcode**.

## 6. Основные правила PHPMD
PHPMD включает несколько наборов правил:

### 6.1. Clean Code
- **BooleanArgumentFlag** – метод не должен принимать булевый аргумент.
- **StaticAccess** – статический доступ к методам и свойствам нежелателен.
- **DuplicatedArrayKey** – дублирование ключей массива.

### 6.2. Codesize
- **CyclomaticComplexity** – измеряет сложность кода.
- **ExcessiveClassLength** – слишком длинные классы.
- **ExcessiveMethodLength** – слишком длинные методы.
- **TooManyFields** – слишком много свойств в классе.
- **TooManyMethods** – слишком много методов в классе.

### 6.3. Controversial
- **CamelCaseClassName** – проверяет соответствие имен классов стилю CamelCase.
- **Superglobals** – ограничение использования суперглобальных переменных ($_GET, $_POST и др.).

### 6.4. Design
- **CouplingBetweenObjects** – высокий уровень связности между классами.
- **DepthOfInheritance** – слишком глубокое наследование.
- **GotoStatement** – использование `goto` недопустимо.

### 6.5. Naming
- **ShortVariable** – слишком короткие имена переменных.
- **ShortMethodName** – слишком короткие имена методов.
- **LongVariable** – слишком длинные имена переменных.

### 6.6. Unused Code
- **UnusedPrivateMethod** – неиспользуемые приватные методы.
- **UnusedLocalVariable** – неиспользуемые локальные переменные.
- **UnusedFormalParameter** – неиспользуемые параметры методов.

## 7. Создание собственных правил
PHPMD позволяет создавать кастомные правила для анализа кода. Для этого:
1. Создайте файл `custom-ruleset.xml`:
```xml
<?xml version="1.0"?>
<ruleset name="CustomRules">
    <description>Кастомные правила PHPMD</description>
    <rule ref="rulesets/cleancode.xml"/>
    <rule ref="rulesets/codesize.xml"/>
    <rule ref="rulesets/unusedcode.xml"/>
</ruleset>
```
2. Запустите PHPMD с новым набором правил:
```bash
vendor/bin/phpmd src/ text custom-ruleset.xml
```

## 8. Подавление (Suppress) предупреждений PHPMD
Иногда может потребоваться подавить определенные предупреждения PHPMD. Это можно сделать с помощью аннотаций в коде:

### 8.1. Подавление предупреждений для метода или класса
```php
/**
 * @SuppressWarnings("CyclomaticComplexity")
 */
function complexFunction($a, $b, $c, $d, $e) {
    // сложная логика
}
```

### 8.2. Подавление нескольких правил
```php
/**
 * @SuppressWarnings({"CyclomaticComplexity", "ExcessiveMethodLength"})
 */
function anotherComplexFunction() {
    // код
}
```

### 8.3. Подавление предупреждений в конфигурации
Можно исключить определенные файлы или директории в конфигурационном файле `phpmd.xml`:
```xml
<exclude-pattern>*/tests/*</exclude-pattern>
```

## 9. Заключение
PHPMD – это мощный инструмент для выявления потенциальных проблем в коде. Он помогает соблюдать чистоту кода, избегать избыточности и следовать лучшим практикам проектирования. Интеграция с IDE и CI/CD позволяет легко внедрять автоматизированный анализ качества кода в рабочий процесс. Возможность подавления предупреждений делает его гибким инструментом, который можно адаптировать под потребности проекта.
