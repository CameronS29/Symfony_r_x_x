<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-06-10
 * Time: 16:03
 */

namespace App\Service;

use GeoIp2\Exception\AddressNotFoundException;
use GeoIp2\Database\Reader;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class GeoService
 * @package App\Service
 */
class GeoService
{
    /**
     * @var Visitor
     */
    private $visitor;

    private $dbPath = '/usr/local/share/GeoIP/GeoIP2-City.mmdb';

    /**
     * GeoService constructor.
     * @param \App\Service\Visitor $visitor
     */
    public function __construct(Visitor $visitor)
    {
        $this->visitor = $visitor;
    }

    public function getContinent()
    {
        $ip = $this->visitor->getIpAddress();
        if (!$ip) {
            return 'NA';
        }
        try {
            $reader = new Reader($this->dbPath);
        } catch (\Exception $e) {
            $user =     posix_getpwuid(posix_geteuid());
            $uName =    $user['name'];
            $group =    posix_getgrgid($user['gid']);
            $gName =    $group['name'];
            $binPath = substr(dirname(__DIR__), 0, -4)."/bin/";
            die(
                "<h1>GeoIP Error</h1>\n"
                ."<p>{$this->dbPath} is missing.<br />\n"
                ."Please run these commands:</p>"
                ."<pre>sudo mkdir -p ".dirname($this->dbPath).";\n"
                ."sudo chown $uName:$gName ".dirname($this->dbPath).";\n"
                ."{$binPath}console geoip2:update</pre>"
            );
        }
        try {
            $record = $reader->city($ip);
            return $record->continent->code;
        } catch (AddressNotFoundException $e) {
            return 'NA';
        }
    }

    /**
     * @return string - reu|rna|rww - depending on where visitor's IP address originates
     */
    public function getDefaultSystem()
    {
        $continent = $this->getContinent();
        switch ($continent) {
            case 'NA':
                return 'rna';
            case 'EU':
                return 'reu';
            default:
                return 'rww';
        }
    }
}
