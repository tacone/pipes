<?php

namespace Pipes\Filter;

trait FilesTrait
{
    /**
     * Iterates files
     * (internally uses \GlobIterator)
     *
     * <code>
     * $files = p->files('/tmp/*.txt');
     * foreach ($files as $f) {
     *     echo $f .PHP_EOL;
     * }
     * </code>
     *
     * Use true to get a SplFileInfo object for each file:
     * <code>
     * $files = p->files('/tmp/*.txt');
     * </code>
     *
     * You can also pass any GlobIterator or FilesystemIterator flag
     *
     * <code>
     * $files = p->files('/tmp/*.txt', \FilesystemIterator::FOLLOW_SYMLINKS);
     * </code>
     *
     * You are incoraged to download and use Symfony Finder for any advanced need:
     *
     * <code>
     * $finder = new Finder();
     * $iterator = $finder
     *     ->files()
     *     ->name('*.php')
     *     ->depth(0)
     *     ->size('>= 1K')
     *     ->in(__DIR__);
     *
     * // then you can use your new iterator with pipes :)
     * p($iterator)->each(function(){
     *     //... do stuff
     * });
     *
     * </code>
     *
     * @param string $path any file wildcard (ie:/tmp/*.txt). Use the full path!
     * @param int $flags any GlobIterator or FilesystemIterator flag
     * @return \Pipes\Pipe
     */
    public function files($path, $flags = \GlobIterator::CURRENT_AS_PATHNAME)
    {
        if ($flags === true)
        {
            $flags = 0;
        }
        return $this->chainWith(new \GlobIterator($path, $flags));
    }
}