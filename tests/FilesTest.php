<?php

namespace Pipes\Test;

class FilesTest extends BaseTestCase
{
    public function createTest($data)
    {
        $path = tempnam(sys_get_temp_dir(), 'pipes-');
        unlink($path);
        mkdir($path);
        foreach ($data as $value) {
            touch("$path/$value");
        }

        return $path;
    }

    public function removeTest($data, $path)
    {
        foreach ($data as $file) {
            unlink("$path/$file");
        }
        rmdir($path);
    }

    public function testFiles()
    {
        $array = $this->associative();
        $path = $this->createTest($array);
        $obj = p()->files("$path/*");
        $expected = [
            "$path/apples",
            "$path/bananas",
            "$path/cherries",
            "$path/damsons",
            "$path/elderberries",
            "$path/figs",
        ];

        $expected = array_combine($expected, $expected);
        $this->assertSame($expected, $obj->toArray());

        $obj = p()->files("$path/*", true);
        $result = $obj->toArray();
        $this->assertSame(count($expected), count($result));
        foreach ($result as $fileInfo) {
            $this->assertInstanceOf("\\SplFileInfo", $fileInfo);
        }

        $path = $this->removeTest($array, $path);
    }

}
