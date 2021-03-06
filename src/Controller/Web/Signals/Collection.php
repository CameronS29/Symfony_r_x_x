<?php
namespace App\Controller\Web\Signals;

use App\Entity\Signal as SignalEntity;
use App\Form\Signals\Collection as Form;
use App\Repository\ListenerRepository;
use App\Repository\PaperRepository;
use App\Repository\SignalRepository;
use App\Repository\TypeRepository;
use DateTime;
use Symfony\Component\Routing\Annotation\Route;  // Required for annotations
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Collection
 * @package App\Controller\Web
 */
class Collection extends Base
{
    const defaultlimit =     50;
    const defaultSorting =  'khz';
    const defaultOrder =    'a';

    /**
     * @Route(
     *     "/{_locale}/{system}/signals",
     *     requirements={
     *        "_locale": "de|en|es|fr",
     *        "system": "reu|rna|rww"
     *     },
     *     name="signals"
     * )
     * @param $_locale
     * @param $system
     * @param Request $request
     * @param Form $form
     * @param ListenerRepository $listenerRepository
     * @param SignalRepository $signalRepository
     * @param TypeRepository $typeRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function controller(
        $_locale,
        $system,
        Request $request,
        Form $form,
        PaperRepository $paperRepository,
        ListenerRepository $listenerRepository,
        SignalRepository $signalRepository,
        TypeRepository $typeRepository
    ) {
        $isAdmin = $this->parameters['isAdmin'];
        $args = [
            'active' =>         0,
            'admin_mode' =>     $_REQUEST['form']['admin_mode'] ?? 0,
            'call' =>           '',
            'channels' =>       '',
            'countries' =>      '',
            'gsq' =>            '',
            'heard_in' =>       '',
            'heard_in_mod' =>   '',
            'isAdmin' =>        $isAdmin,
            'khz_1' =>          '',
            'khz_2' =>          '',
            'limit' =>          static::defaultlimit,
            'listener' =>       [],
            'listener_invert' => '',
            'logged_date_1' =>  '',
            'logged_date_2' =>  '',
            'logged_first_1' => '',
            'logged_first_2' => '',
            'logged_last_1' =>  '',
            'logged_last_2' =>  '',
            'offsets' =>        '',
            'order' =>          static::defaultOrder,
            'page' =>           0,
            'paper' =>          $paperRepository::getDefaultForSystem($system),
            'personalise' =>    '',
            'range_gsq' =>      '',
            'range_min' =>      '',
            'range_max' =>      '',
            'range_units' =>    '',
            'region' =>         $_REQUEST['form']['region'] ?? '',
            'show' =>           '',
            'sort' =>           static::defaultSorting,
            'sp_itu_clause' =>  '',
            'states' =>         '',
            'system' =>         $system,
            'types' =>          ['type_NDB'],
            'signalTypes' =>    [0],
            'url' =>            $request->attributes->get('_route')
        ];

        $args['total'] =        $signalRepository->getFilteredSignalsCount($system, $args); // forces paging - will be made accurate later on

        foreach (array_keys($args) as $key) {
            if ($request->query->get($key)) {
                $args[$key] = $request->query->get($key);
            }
        }
        foreach (['logged_date_1', 'logged_date_2', 'logged_first_1', 'logged_first_2', 'logged_last_1', 'logged_last_2'] as $arg) {
            $args[$arg] = $args[$arg] ? new DateTime($args[$arg]) : null;
        }

        $form = $form->buildForm($this->createFormBuilder(), $args);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $args = $form->getData();
        }
        if (empty($args['types'])) {
            $args['types'][] = 'type_NDB';
        }
        $args['isAdmin'] =      $isAdmin;
        $args['signalTypes'] =  $typeRepository->getSignalTypesSearched($args['types']);
        if ($isAdmin && $args['admin_mode'] !== '') {
            $args['show'] = 'list';
        }
        $paper =                isset($args['paper']) ? $paperRepository->getSpecifications($args['paper']) : false;
        $signals =              $signalRepository->getFilteredSignals($system, $args);
        $total =                $signalRepository->getFilteredSignalsCount($system, $args);
        $seeklistStats =        [];
        $seeklistColumns =      [];
        if ('seeklist' === $args['show']) {
            $seeklistStats =    SignalRepository::getSeeklistStats($signals);
            $seeklistColumns =  SignalRepository::getSeeklistColumns($signals, $paper);
        }
        $signalEntities = [];
        foreach ($signals as $signal) {
            if ('seeklist' !== $args['show']) {
                $signal['first_heard'] =    $signal['first_heard'] ? new DateTime($signal['first_heard']) : null;
                $signal['last_heard'] =     $signal['last_heard'] ? new DateTime($signal['last_heard']) : null;
            }
            $s = new SignalEntity;
            $s->loadFromArray($signal);
            $signalEntities[] = $s;
        }
        $parameters = [
            '_locale' =>            $_locale,
            'args' =>               $args,
            'columns' =>            $signalRepository->getColumns(),
            'form' =>               $form->createView(),
            'isAdmin' =>            $isAdmin,
            'mode' =>               $this->translator->trans('Signals'),
            'paper' =>              $paper,
            'paperChoices' =>       $paperRepository->getAllChoices(),
            'personalised' =>       isset($args['personalise']) ? $listenerRepository->getDescription($args['personalise']) : false,
            'results' => [
                'limit' =>              isset($args['limit']) ? $args['limit'] : static::defaultlimit,
                'page' =>               isset($args['page']) ? $args['page'] : 0,
                'total' =>              $total
            ],
            'seeklistColumns' =>    $seeklistColumns,
            'seeklistStats' =>      $seeklistStats,
            'signals' =>            $signalEntities,
            'statsBlocks' =>
                $signalRepository->getStats($this->isAdmin()) +
                $listenerRepository->getStats($system, $args['region']),
            'system' =>             $system,
            'sortbyOptions' =>      $signalRepository->getColumns(),
            'tabs' => [
                [ 'list', 'Listing' ],
                [ 'map', 'Map' ],
                [ 'seeklist', 'Seeklist']
            ],
            'typeRepository' =>     $typeRepository
        ];
        return $this->render('signals/index.html.twig', $this->getMergedParameters($parameters));
    }
}
