<?php

return [
    'services' => [
        [
            'key'   => 'assurances',
            'label' => 'menu.insurance',
            'path'  => '/assurance',
            'items' => [
                ['label' => 'menu.life_insurance',           'path' => '/assurance-vie'],
                ['label' => 'menu.critical_illness',         'path' => '/assurance-maladie-grave'],

                ['type' => 'header', 'label' => 'menu.disability_insurance'],
                ['label' => 'menu.disability_individual',    'path' => '/assurance-invalidite-individuelle'],
                ['label' => 'menu.disability_group',         'path' => '/assurance-invalidite-de-groupe'],

                ['type' => 'divider'],

                ['label' => 'menu.supplementary_insurance',  'path' => '/assurance-complementaire-dentaire'],

                ['type' => 'header', 'label' => 'menu.general_insurance'],
                ['label' => 'menu.auto',                     'path' => '/assurance-auto'],
                ['label' => 'menu.home_insurance',           'path' => '/assurance-habitation'],
                ['label' => 'menu.liability',                'path' => '/assurance-responsabilite-professionnelle'],
                ['label' => 'menu.commercial',               'path' => '/assurance-commerciale'],

                ['type' => 'divider'],

                ['label' => 'menu.travel_insurance',         'path' => '/assurance-voyage'],
                ['label' => 'menu.mortgage_insurance',       'path' => '/assurance-vie-hypothecaire'],
            ],
        ],

        [
            'key'   => 'epargne',
            'label' => 'menu.savings',
            'path'  => '/epargne',
            'items' => [
                ['type' => 'header', 'label' => 'menu.savings_retirement'],
                ['label' => 'menu.rrsp',    'path' => '/reer'],
                ['label' => 'menu.tfsa',    'path' => '/celi'],
                ['label' => 'menu.fhsa',    'path' => '/celiapp'],
                ['label' => 'menu.rdsp',    'path' => '/reei'],
                ['label' => 'menu.non_reg', 'path' => '/rene'],

                ['type' => 'divider'],

                ['type' => 'header', 'label' => 'menu.retirement_income'],
                ['label' => 'menu.lira',    'path' => '/cri'],
                ['label' => 'menu.lif',     'path' => '/frv'],
                ['label' => 'menu.rrif',    'path' => '/ferr'],

                ['type' => 'divider'],

                ['type' => 'header', 'label' => 'menu.education'],
                ['label' => 'menu.resp',    'path' => '/reee'],
            ],
        ],

        [
            'key'   => 'prets',
            'label' => 'menu.loans',
            'path'  => '/pret',
            'items' => [
                ['label' => 'menu.rrsp_loan',       'path' => '/pret-reer'],
                ['label' => 'menu.resp_loan',       'path' => '/pret-reee'],
                ['label' => 'menu.investment_loan', 'path' => '/pret-investissement'],
                ['label' => 'menu.credit_card',     'path' => '/carte-de-credit'],
            ],
        ],

        [
            'key'   => 'hypotheque',
            'label' => 'menu.mortgage',
            'path'  => '/hypotheque',
            'items' => [
                ['label' => 'menu.turnkey',      'path' => '/programme-dachat-clef-en-main'],
                ['label' => 'menu.mortgage_loan', 'path' => '/pret-hypothecaire'],
            ],
        ],
    ],
];
