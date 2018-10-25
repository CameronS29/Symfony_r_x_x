<?php
namespace App\Controller\Web\Listener\Export;

use App\Controller\Web\Listener\Base;
use App\Repository\ListenerRepository;
use App\Repository\TypeRepository;
use Symfony\Component\Routing\Annotation\Route;  // Required for annotations

/**
 * Class Listeners
 * @package App\Controller\Web\Listener\Export
 */
class SignalsKml extends Base
{
    /**
     * @Route(
     *     "/{system}/listeners/{id}/export/signals.kml/{type}",
     *     requirements={
     *        "system": "reu|rna|rww"
     *     },
     *     defaults={"id"="", "type"=""},
     *     name="listener_export_signals_kml"
     * )
     */
    public function signalsKmlController(
        $system,
        $id,
        $type,
        ListenerRepository $listenerRepository,
        TypeRepository $typeRepository
    ) {
        if (!$listener = $this->getValidListener($id, $listenerRepository)) {
            return $this->redirectToRoute('listeners', ['system' => $system]);
        }
        $filter =                   ($type!=='' ? [ 'type' => explode(',', $type) ] : []);
        $parameters = [
            'colors' =>             $typeRepository->getMapIconColorForCodes(),
            'description' =>        "Generated by ".strToUpper($system)." on ".date('Y-m-d'),
            'filter' =>             $filter,
            'signals' =>            $listenerRepository->getSignalsForListener($id, $filter),
            'title' =>              strToUpper($system).' stations received by '.$listener->getName(),
            'types' =>              $typeRepository->getAll()
        ];
        $parameters =   array_merge($parameters, $this->parameters);
        $response =     $this->render('listener/export/signals.kml.twig', $parameters);
//        $response->headers->set('Content-Type', 'text/plain');
        $response->headers->set('Content-Type', 'application/vnd.google-earth.kml+xml');
        return $response;
    }
}
