<?php
namespace App\Controller\Web;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Listeners
 * @package App\Controller\Web
 */
class Help extends Base
{

    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @Route(
     *     "/{_locale}/{system}/help",
     *     requirements={
     *        "locale": "de|en|es|fr",
     *        "system": "reu|rna|rww"
     *     },
     *     name="help"
     * )
     */
    public function helpController(
        $_locale,
        $system
    ) {
        $parameters = [
            '_locale' =>    $_locale,
            'mode' =>       'Help',
            'system' =>     $system,
        ];

        $parameters = array_merge($parameters, $this->parameters);
        return $this->render('help/index.html.twig', $parameters);
    }
}
