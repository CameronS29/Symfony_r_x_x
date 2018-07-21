<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class Base extends WebTestCase
{
    protected $client;

    protected $currentUserType = 'public';

    protected $currentRedirectStatus;

    protected function setUp()
    {
        $client = static::createClient();
        $this->client = $client;
    }

    /**
     * @return array
     */
    protected function getSystems()
    {
        return ['reu', 'rna', 'rww'];
    }

    /**
     * @return array
     */
    protected function getVisitors()
    {
        return [
            'CAN'   =>  ['IP' => '206.248.171.206', 'system' => 'rna'],     // Canada, Ontario
            'USA'   =>  ['IP' => '72.130.194.78',   'system' => 'rna'],     // USA, Minnesota
            'ENG'   =>  ['IP' => '213.219.36.56',   'system' => 'reu'],     // England, London
            'RUS'   =>  ['IP' => '95.31.18.119',    'system' => 'reu'],     // Russia, Moscow
            'AUS'   =>  ['IP' => '202.86.32.122',   'system' => 'rww'],     // Brisbane, Australia
        ];
    }

    /**
     * @return array
     */
    protected function getAdminUsers()
    {
        return [
            'bogus1' => [
                'password' =>   'password1',
                'valid' =>      false
            ],
            getenv('ADMIN_USER') => [
                'password' =>   getenv('ADMIN_PASS'),
                'valid' =>      true,
            ],
            'bogus2' => [
                'password' =>   'password2',
                'valid' =>      false
            ],
        ];
    }

    protected function getAdminUser()
    {
        return [
            'user' =>       getenv('ADMIN_USER'),
            'password' =>   getenv('ADMIN_PASS')
        ];
    }

    /**
     * @return mixed
     */
    protected function getCrawler()
    {
        return $this->client->getCrawler();
    }

    /**
     * @param $match
     * @return mixed
     */
    protected function filter($match)
    {
        return $this->getCrawler()->filter($match);
    }

    /**
     * @param null $id
     * @param array $args
     * @return string
     */
    protected function getError($id = null, $args = [])
    {
        return sprintf('ERROR '.static::MESSAGES[$id], ...$args);
    }

    /**
     * @return mixed
     */
    protected function getResponse()
    {
        return $this->client->getResponse();
    }

    /**
     * @return mixed
     */
    protected function getResponseContent()
    {
        return $this->getResponse()->getContent();
    }

    /**
     * @return mixed
     */
    protected function getResponseRedirectLocation()
    {
        return $this->getResponse()->headers->get('location');
    }

    /**
     * @return mixed
     */
    protected function getResponsePageTitle()
    {
        return $this->getCrawler()->filter('title')->eq(0)->text();
    }

    /**
     * @return mixed
     */
    protected function getResponseStatusCode()
    {
        return $this->getResponse()->getStatusCode();
    }

    /**
     * @return $this
     */
    protected function setNoRedirect()
    {
        $this->currentRedirectStatus = false;
        $this->client->setMaxRedirects(1);
        $this->client->followRedirects(false);
        return $this;
    }

    /**
     * @return $this
     */
    protected function setYesRedirect()
    {
        $this->currentRedirectStatus = true;
        $this->client->setMaxRedirects(10);
        $this->client->followRedirects(true);
        return $this;
    }

    protected function setUserAdmin()
    {
        $initialRedirectStatus = $this->currentRedirectStatus;
        $this->setYesRedirect();
        $admin = $this->getAdminUser();
        $this->client->request('GET', '/rww/logon');
        $form = $this
            ->getCrawler()
            ->filter('button#form_submit')
            ->form(
                [
                    'form[user]' => $admin['user'],
                    'form[password]' => $admin['password']
                ],
                'POST'
            );
        $this->client->submit($form);
        if (!$initialRedirectStatus) {
            $this->setNoRedirect();
        }
        $this->currentUserType = 'admin';

    }

    protected function setUserPublic()
    {
        $this->client->request('GET', '/rww/logoff');
        $this->currentUserType = 'public';
    }

    /**
     * @param $IP
     * @return $this
     */
    protected function setVisitorIP($IP)
    {
        putenv('PHPUNIT_CLIENT_IP='.$IP);
        return $this;
    }
}
