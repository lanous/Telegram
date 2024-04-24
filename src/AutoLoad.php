<?php

namespace Lanous\Telegram;

class AutoLoad {
    public function Directory (string $directory_name,array $variables=array()) {
        $directores = glob($directory_name."\*");
        foreach ($directores as $DIR_FILE) {
            if (is_dir($DIR_FILE)) {
                $this->Directory ($DIR_FILE,$variables);
            } else {
                $fileExtension = pathinfo($DIR_FILE, PATHINFO_EXTENSION);
                if ($fileExtension == 'php') {
                    extract($variables);
                    ob_start();
                    include($DIR_FILE);
                    ob_get_clean();
                }
            }
        }
    }
}