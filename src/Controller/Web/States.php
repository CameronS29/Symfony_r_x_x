<?php
namespace App\Controller\Web;

use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;  // Required for annotations

/**
 * Class States
 * @package App\Controller\Web
 */
class States extends AbstractController
{
    /**
     * @var CountryRepository
     */
    private $country;

    /**
     * States constructor.
     * @param CountryRepository $countryService
     */
    public function __construct(CountryRepository $country)
    {
        $this->country = $country;
    }

    /**
     * @Route(
     *     "/{_locale}/{system}/states/{filter}",
     *     requirements={
     *        "_locale": "de|en|es|fr",
     *        "system": "reu|rna|rww"
     *     },
     *     defaults={"filter"="*"},
     *     name="states"
     * )
     */
    public function stateLocatorController($_locale, $system, $filter)
    {
        $parameters = [
            '_locale' =>    $_locale,
            'countries' =>  $this->country->getCountriesAndStates($filter),
            'filter' =>     $filter,
            'mode' =>       'State and Province Locator',
            'system' =>     $system,
        ];

        return $this->render('states/index.html.twig', $parameters);
    }
}
