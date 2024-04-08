<?php
/**
 * Logger class for logging messages to a file.
 *
 * This class provides a simple way to log messages to a file for debugging purposes.
 * Each message is timestamped and appended to the end of the log file.
 *
 * Example usage:
 * $logger = new Logger('app.log');  // Create a new Logger object
 * $logger->log('This is a log message.');  // Log a message
 *
 * @property string $logFile The path to the log file.
 */

class Logger {
    private $logFile;

      /**
     * Constructs a new Logger object.
     *
     * @param string $logFile The path to the log file. Defaults to 'app.log'.
     */

    public function __construct($logFile = 'app.log') {
        $this->logFile = $logFile;
    }
    
    /**
     * Logs a message to the log file.
     *
     * @param string $message The message to log.
     */

    public function log($message) {
        $time = date('Y-m-d H:i:s');
        file_put_contents($this->logFile, "[$time] $message\n", FILE_APPEND);
    }
}
