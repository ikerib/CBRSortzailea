<?php

namespace ikerib\CBRSortzailea;

use Symfony\Component\Finder\Finder;

class Compiler
{
    public function compile($pharFile = 'cbrsortzailea.phar')
    {
        if (file_exists($pharFile)) {
            unlink($pharFile);
        }

        $phar = new \Phar($pharFile, 0, 'cbrsortzailea.phar');
        $phar->setSignatureAlgorithm(\Phar::SHA1);

        $phar->startBuffering();

        // CLI Component files
        foreach ($this->getFiles() as $file) {
            $path = str_replace(__DIR__.'/', '', $file);
            $phar->addFromString($path, file_get_contents($file));
        }
        $this->addPhpCsFixer($phar);

        // Stubs
        $phar->setStub($this->getStub());

        $phar->stopBuffering();

        // $phar->compressFiles(\Phar::GZ);

        unset($phar);

        chmod($pharFile, 0777);
    }

    /**
     * Remove the shebang from the file before add it to the PHAR file.
     *
     * @param \Phar $phar PHAR instance
     */
    protected function addPhpCsFixer(\Phar $phar)
    {
        $content = file_get_contents(__DIR__ . '/../../../bin/cbrsortzailea');
        $content = preg_replace('{^#!/usr/bin/env php\s*}', '', $content);

        $phar->addFromString('cbrsortzailea', $content);
    }

    protected function getStub()
    {
        return "#!/usr/bin/env php\n<?php Phar::mapPhar('cbrsortzailea.phar'); require 'phar://cbrsortzailea.phar/cbrsortzailea'; __HALT_COMPILER();";
    }

    protected function getFiles()
    {
        $iterator = Finder::create()->files()->exclude('tests')->name('*.php')->name('*.yml')->in(array('vendor', 'src'));

        return iterator_to_array($iterator);
    }
}