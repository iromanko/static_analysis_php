# Внедрение инструментов статического анализа в существующий legacy-проект

Внедрение инструментов статического анализа кода в устаревший (legacy) проект может показаться сложной задачей, особенно если в коде накопилось множество проблем. Однако, правильный подход позволяет минимизировать влияние на разработку и постепенно повышать качество кода.

## Основные шаги внедрения

### 1. Определение набора инструментов

Выбор инструментов зависит от требований проекта. Чаще всего применяются:
- PHPCS (PHP CodeSniffer) — проверка на соответствие кодстайлу.
- PHPMD (PHP Mess Detector) — выявление проблемных мест в коде.
- Psalm или PHPStan — анализ типов и потенциальных ошибок.
- PHP Inspections (плагин для PHPStorm) — дополнительные проверки качества кода.

### 2. Запуск анализа на всём проекте

Первоначальный запуск покажет огромное количество проблем, но исправлять их сразу нецелесообразно. Вместо этого можно использовать baseline-файл (например, в Psalm) или ограничить проверку только новых изменений.

### 3. Анализ только изменённых файлов**

Чтобы анализ не блокировал разработку из-за большого числа ошибок в старом коде, можно настроить инструменты так, чтобы они проверяли только файлы, изменённые в текущем pull request'е.

Для этого в GitHub Actions можно определить изменённые файлы следующим образом:

```yaml
- name: Get changed PHP files
  run: |
    git fetch origin $TARGET_BRANCH
    CHANGED_FILES=$(git diff --name-only origin/$TARGET_BRANCH HEAD -- '*.php' | xargs)
    echo "CHANGED_FILES=$CHANGED_FILES" >> $GITHUB_ENV
```

Далее передавать `CHANGED_FILES` в команды анализа:

```yaml
- name: Run PHPCS on changed files
  if: env.CHANGED_FILES != ''
  run: vendor/bin/phpcs $CHANGED_FILES
```

```yaml
- name: Run PHPMD on changed files
  if: env.CHANGED_FILES != ''
  run: vendor/bin/phpmd $CHANGED_FILES text phpmd.xml
```

### 4. Постепенное исправление кода

- Можно устанавливать строгие требования к новому коду, но допускать старый код без изменений.
- Периодически улучшать существующий код в отдельных задачах (рефакторинг).
- Добавлять дополнительные правила анализа постепенно, по мере исправления основных проблем.

### 5. Автоматизация в CI/CD

Добавьте выполнение анализа в GitHub Actions или другой CI/CD:
- Настроить `composer.json` для установки зависимостей.
- Добавить шаги в GitHub Actions для запуска анализаторов только на измененных файлах.
- Использовать baseline-файлы, чтобы не получать ошибки на старом коде.

## Вывод

Внедрение инструментов статического анализа в legacy-проект требует осторожного и постепенного подхода.
Полное сканирование кода сразу может привести к лавине ошибок, с которой трудно работать. 
Поэтому использование базовых стратегий, таких как baseline-файлы, ограничение анализа только на новых изменениях и поэтапное добавление проверок, позволяет сделать процесс управляемым.

Подход с анализом только изменённых файлов в pull request’ах помогает команде постепенно улучшать качество кода, не перегружая разработчиков исправлением старых проблем. 
Со временем, когда большая часть кода будет приведена в соответствие с правилами, можно ужесточать проверки и расширять их область применения.

Такой метод позволяет найти баланс между улучшением качества кода и поддержанием продуктивности команды, не останавливая разработку из-за тысяч старых ошибок.
