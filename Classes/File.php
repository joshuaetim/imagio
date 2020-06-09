<?php

    // require 'vendor/autoload.php';

    use League\Flysystem\Filesystem;
    use League\Flysystem\Adapter\Local;

    class File
    {
        public $adapter;
        public $filesystem;

        public function __construct(League\Flysystem\Adapter\Local $adapter, League\Flysystem\Filesystem $filesystem)
        {
            $this->filesystem = $filesystem;
            $this->adapter = $adapter;
        }

        public function checkExist($file)
        {
            return $this->filesystem->has($file);
        }

        public function listAll($path)
        {
            if($this->filesystem->has($path))
            {
                $content = $this->filesystem->listContents($path, true);
                if(empty($content))
                {
                    return 'empty';
                }
                else{
                    return $content;
                }
            }

            else{
                return false;
            }
        }
    }

?>