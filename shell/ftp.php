#!/usr/bin/env php

<?php
/* script for automation of file uploads via FTP */
/* invented by me */

define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/..'));
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');

class FTP_Upload
{
    public $bldgrn = "\033[1;32m"; // Green
    public $txtwht = "\033[0;37m"; // White

    public function main() {
        /* specific settings */
        require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');
        $ftp_yaml = sfYaml::load(dirname(__FILE__) . '/../config/ftp.yml');

        $host = $ftp_yaml['production']['connection']['host'];
        $username = $ftp_yaml['production']['connection']['username'];
        $password = $ftp_yaml['production']['connection']['password'];

        if (empty($host) || empty($username) || empty($password)) {
            echo 'Nothing to do here!' . PHP_EOL;
            die('Lost parameters');
        }

        /* FTP connection */
        echo 'Connecting to: ' . $host . PHP_EOL;
        $connection = ftp_connect($host) or die('Couldn\'t connect to ' . $host);

        if (@ftp_login($connection, $username, $password)) {
            echo 'Connected as ' . $username . PHP_EOL . PHP_EOL;
        } else {
            die('Couldn\'t connect as ' . $username);
        }

        /* create the directories before upload, if it's needed */
        if (isset($ftp_yaml['production']['mkdir'])) {
            $mkdir = $ftp_yaml['production']['mkdir'];
            if (!empty($mkdir)) {
                foreach ($mkdir as $dir) {
                    $this->create_directory($connection, $dir);
                }
            }
        }
        echo PHP_EOL;

        /* put the right permissions if it's needed */
        if (isset($ftp_yaml['production']['chmod'])) {
            $chmod = $ftp_yaml['production']['chmod'];
            if (!empty($mkdir)) {
                foreach ($chmod as $permission) {
                    list($file, $mode) = explode(' -> ', $permission);
                    echo $this->bldgrn . 'CHMOD: ' . $this->txtwht . $file . PHP_EOL;
                    ftp_chmod($connection, $mode, $file);
                }
            }
        }
        echo PHP_EOL;

        /* preparing directories for uploading */
        if (isset($ftp_yaml['production']['dirs'])) {
            $dirs = $ftp_yaml['production']['dirs'];
            if (!empty($dirs)) {
                foreach ($dirs as $dir) {
                    list($from, $to) = explode(' -> ', $dir);
                    echo $from . $this->bldgrn . ' -> ' . $this->txtwht . $to . PHP_EOL;
                    $this->upload_directory($connection, APPLICATION_PATH . $from, $to);
                }
            }
        }
        echo PHP_EOL;

        /* preparing files for uploading */
        if (isset($ftp_yaml['production']['files'])) {
            $files = $ftp_yaml['production']['files'];
            if (!empty($files)) {
                foreach ($files as $file) {
                    list($from, $to) = explode(' -> ', $file);
                    $this->upload_file($connection, APPLICATION_PATH . $from, $to);
                }
            }
        }
        echo PHP_EOL;

        /* FTP closing */
        echo 'Disconnecting to FTP' . PHP_EOL;
        ftp_close($connection);
    }

    function create_directory($connection, $to) {
        if (!@ftp_chdir($connection, $to)) {
            $result = @ftp_mkdir($connection, $to);
            echo $this->bldgrn . 'MKDIR: ' . $this->txtwht . $to  . ($result ? '':' :X') . PHP_EOL;
        }
    }

    function upload_file($connection, $from, $to, $level = 0) {
        // upload a file
        if (ftp_put($connection, $to, $from, FTP_ASCII)) {
            echo str_repeat(' ', 2 * $level) . $this->bldgrn . 'CP: ' . $this->txtwht . str_replace(APPLICATION_PATH, '', $from) . $this->bldgrn . ' -> ' . $this->txtwht . $to . PHP_EOL;
        } else {
            echo $this->bldgrn . 'CP: ' . $this->txtwht . $from . ' -> :X' . PHP_EOL;
        }
    }

    function upload_directory($connection, $from, $to, $level = 0) {
        $directory = dir($from);
        $this->create_directory($connection, $to);

        while ($file = $directory->read()) {
            if ($file != "." && $file != "..") {
                if (is_dir($from . '/' . $file)) {
                    $this->create_directory($connection, $to . '/' . $file);
                    $this->upload_directory($connection, $from . '/' . $file, $to . '/' . $file, $level++);
                } else {
                    $this->upload_file($connection, $from . '/' . $file, $to . '/' . $file, $level);
                }
            }
        }
        $directory->close();
    }
}

$ftp = new FTP_Upload();
$ftp->main();
