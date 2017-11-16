<?php

if (!file_exists($autoloadFile = __DIR__ . '/../vendor/autoload.php')) {
    throw new \LogicException("Make sure that you install all dependencies.");
}

require_once $autoloadFile;
