=============================================
Logging and Debugging
=============================================

WIP

Logging
=======

Logging to the System Log
-------------------------

An instance of the System Logger can be injected to an own class and then used for logging:

.. code-block:: php

 /**
  * @var \TYPO3\Flow\Log\SystemLoggerInterface
  */
 protected $logger;

 /**
  * @param \TYPO3\Flow\Log\SystemLoggerInterface $logger
  * @return void
  */
 public function injectLogger(\TYPO3\Flow\Log\SystemLoggerInterface $logger)
 {
	 $this->logger = $logger;
 }    

In other to be able to distinguish own log entries, it is wise to send the Package Key along with the log entry:

.. code-block:: php

 $this->logger->log('My first log entry.', LOG_INFO, null, 'Acme.Demo');

Logging to an own logger
------------------------

While logging to the System Logger is easily done, it might be desirable to have a separate log for your application. In order to be able to log to a separate file, a Logger and a LoggerInterface must be created.

The interface must implement Flow's ``LoggerInterface``:

.. code-block:: php

	<?php
	namespace Acme\Demo\Log;

	use TYPO3\Flow\Log\LoggerInterface;

	/**
	 * Marker interface for the security logger.
	 *
	 */
	interface MyLoggerInterface extends LoggerInterface
	{
	}

The actual logger can extend Flow's ``Logger`` and must implement ``MyLoggerInterface``:

.. code-block:: php

	<?php
	namespace Acme\Demo\Log;

	use TYPO3\Flow\Log\Backend;

	class Logger extends \TYPO3\Flow\Log\Logger implements MyLoggerInterface
	{
	}

The settings are used when the logger is injected:

.. code-block:: yaml

  Acme:
    Demo:
      log:
        myLogger:
          logger: Acme\Demo\Log\Logger
          backend: TYPO3\Flow\Log\Backend\FileBackend
          backendOptions:
            logFileURL: '%FLOW_PATH_DATA%Logs/My.log'
            createParentDirectories: TRUE
            severityThreshold: '%LOG_INFO%'
            maximumLogFileSize: 1048576
            logFilesToKeep: 1

In order to be able to inject to logger to your class, the constructor properties must be defined in `Objects.yaml` using the settings configured above:

.. code-block:: yaml

  Acme\Demo\Log\MyLoggerInterface:
    scope: singleton
    factoryObjectName: TYPO3\Flow\Log\LoggerFactory
    arguments:
      1:
        value: 'MyLogger'
      2:
        setting: Acme.Demo.log.myLogger.logger
      3:
        setting: Acme.Demo.log.myLogger.backend
      4:
        setting: Acme.Demo.log.myLogger.backendOptions

Now, the logger can be injected to your class:

.. code-block:: php

    /**
     * @var \Acme\Demo\Log\MyLoggerInterface
     */
    protected $logger;

    /**
     * @param \Acme\Demo\Log\MyLoggerInterface $myLogger
     * @return void
     */
    public function injectMyLogger(\Acme\Demo\Log\MyLoggerInterface $myLogger)
    {
        $this->logger = $myLogger;
    }

Is it then available for use:

.. code-block:: php

  $this->logger->log('My first log entry.', LOG_INFO);
  
The log file can be found in ``Data/Logs/My.log``.
