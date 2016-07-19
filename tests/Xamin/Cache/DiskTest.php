<?php

class DiskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function setUp()
    {
        
    }

    /**
     * Return the new driver
     *
     * @param null|string $prefix optional key prefix, defaults to null
     *
     * @return \Handlebars\Cache\APC
     */
    private function _getCacheDriver( $path = '')
    {
        return new \Handlebars\Cache\Disk($path);
    }

    /**
     * Test with cache prefix
     *
     * @return void
     */
    public function testDiskCache()
    {
        $cache_dir = getcwd().'/tests/cache';
        $driver = $this->_getCacheDriver($cache_dir);

        $this->assertEquals(false, $driver->get('foo'));

        $driver->set('foo', "hello world");
        $this->assertEquals("hello world", $driver->get('foo'));

        $driver->set('foo', "hello world", -1);
        $this->assertEquals(false, $driver->get('foo'));

        $driver->set('foo', "hello world", 3600);
        $this->assertEquals("hello world", $driver->get('foo'));

        $driver->set('foo', array(12));
        $this->assertEquals(array(12), $driver->get('foo'));

        $driver->remove('foo');
        $this->assertEquals(false, $driver->get('foo'));
        
        rmdir($cache_dir);
    }

    
    
    /**
     * Test ttl
     *
     * @return void
     */
    /*public function testTtl()
    {
        $driver = $this->_getCacheDriver();
        
        $driver->set('foo', 10, -1);
        $this->assertEquals(false, $driver->get('foo'));

        $driver->set('foo', 20, 10);
        $this->assertEquals(20, $driver->get('foo'));
    }*/
}

?>