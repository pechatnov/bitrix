<?php

namespace PV\Main\Logger;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Фабрика логгеров на базе Monolog.
 * Создаёт именованный логгер с ротацией файлов.
 */
final class LoggerFactory
{
    private const LOG_DIR = '/local/logs';

    /** @var array<string, LoggerInterface> */
    private static array $instances = [];

    /**
     * Возвращает (или создаёт) логгер с заданным именем.
     * Файл лога: /local/logs/{name}.log (ротация — 30 дней).
     */
    public static function getLogger(string $name = 'pv.main'): LoggerInterface
    {
        if (isset(self::$instances[$name])) {
            return self::$instances[$name];
        }

        $logDir = $_SERVER['DOCUMENT_ROOT'] . self::LOG_DIR;

        if (!is_dir($logDir) && !mkdir($logDir, 0755, true) && !is_dir($logDir)) {
            // Если не удалось создать директорию — пишем в stderr
            $handler = new StreamHandler('php://stderr', Level::Debug);
        } else {
            $handler = new RotatingFileHandler(
                $logDir . '/' . $name . '.log',
                30,
                Level::Debug
            );
        }

        $formatter = new LineFormatter(
            "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
            'Y-m-d H:i:s',
            true,
            true
        );
        $handler->setFormatter($formatter);

        $logger = new Logger($name);
        $logger->pushHandler($handler);

        self::$instances[$name] = $logger;

        return $logger;
    }
}
