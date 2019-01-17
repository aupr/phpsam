<?php

class Downloader {
    private $location;

    public function __construct($location) {
        $this->location = $location;
    }

    public function download($file, $name = 'default') {
        $targetFile = "$this->location$file";
        ob_start();
        if(file_exists($targetFile)){
            header('Content-Description: File Transfer');

            header('Content-Type: application/octet-stream');

            header('Content-Disposition: attachment; filename=' . $name);

            header('Content-Transfer-Encoding: binary');

            header('Expires: 0');

            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

            header('Pragma: public');

            header('Content-Length: ' . filesize($targetFile));

            ob_clean();

            flush();

            readfile($targetFile);
        } else {
            throw new \Exception('Error: Target file location is not valid!');
        }
        ob_end_flush();
    }

    public function flyload($content, $name = 'default.txt') {
        if ($content != "") {
            header('Content-Description: File Transfer');

            header('Content-Type: application/octet-stream');

            header('Content-disposition: attachment; filename=' . $name);

            header('Content-Length: '.strlen($content));

            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

            header('Expires: 0');

            header('Pragma: public');

            echo $content;

            exit;
        } else {
            throw new \Exception('Error: No file content is available!');
        }
    }
}