<?php

$apiVersion = env('HRWORKS_API_VERSION', 'v2');
$baseUrl = env('HRWORKS_BASE_URL', 'https://api.hrworks.de').'/'.$apiVersion;

return [

    /*
    |--------------------------------------------------------------------------
    | HrWorks API Credentials
    |--------------------------------------------------------------------------
    |
    | Defines the HrWorks public access key id and the private secret access key.
    |
    */

    'auth' => [
        'accessKey' => env('HRWORKS_ACCESS_KEY'),
        'secretAccessKey' => env('HRWORKS_SECRET_ACCESS_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | API definitions
    |--------------------------------------------------------------------------
    |
    | Defines the a JSON representation of the SX API. See
    | https://developers.hrworks.de/2.0/endpoints
    |
    */
    
    'api' => [
        'utility' => [
            // https://developers.hrworks.de/2.0/endpoints/utility/authentication
            'authenticate' => [
                'api' => "{$baseUrl}/authentication",
                'method' => 'post',
            ],
            // https://developers.hrworks.de/2.0/endpoints/utility/health-check
            'checkHealth' => [
                'api' => "{$baseUrl}/health-check",
                'method' => 'get',
            ],
        ],
        'organizationUnit' => [
            // https://developers.hrworks.de/2.0/endpoints/general/organization-units#get-v2-organization-units-jobs-{jobid}
            'getJob' => [
                'api' => "{$baseUrl}/organization-units/jobs/{job}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/organization-units#get-v2-organization-units
            'index' => [
                'api' => "{$baseUrl}/organization-units",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/organization-units-number#get-v2-organization-units-{number}
            'show' => [
                'api' => "{$baseUrl}/organization-units/{organizationUnit}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/organization-units#post-v2-organization-units
            'create' => [
                'api' => "{$baseUrl}/organization-units",
                'method' => 'post',
                'job' => "{$baseUrl}/organization-units/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/organization-units-number-present-persons#get-v2-organization-units-{number}-present-persons
            'getPresentPersons' => [
                'api' => "{$baseUrl}/organization-units/{organizationUnit}/present-persons",
                'method' => 'get',
            ],
        ],
        'permanentEstablishment' => [
            // https://developers.hrworks.de/2.0/endpoints/general/permanent-establishments#get-v2-permanent-establishments-jobs-{jobid}
            'getJob' => [
                'api' => "{$baseUrl}/permanent-establishments/jobs/{job}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/permanent-establishments#get-v2-permanent-establishments
            'index' => [
                'api' => "{$baseUrl}/permanent-establishments",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/permanent-establishments-id#get-v2-permanent-establishments-{id}
            'show' => [
                'api' => "{$baseUrl}/permanent-establishments/{permanentEstablishment}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/permanent-establishments#post-v2-permanent-establishments
            'create' => [
                'api' => "{$baseUrl}/permanent-establishments",
                'method' => 'post',
                'job' => "{$baseUrl}/permanent-establishments/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/permanent-establishments#put-v2-permanent-establishments
            'update' => [
                'api' => "{$baseUrl}/permanent-establishments",
                'method' => 'put',
                'job' => "{$baseUrl}/permanent-establishments/jobs/{job}",
            ],
        ],
        'holiday' => [
            // https://developers.hrworks.de/2.0/endpoints/general/holidays#get-v2-holidays-jobs-{jobid}
            'getJob' => [
                'api' => "{$baseUrl}/holidays/jobs/{job}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/holidays#get-v2-holidays
            'index' => [
                'api' => "{$baseUrl}/holidays",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/general/holidays#post-v2-holidays
            'create' => [
                'api' => "{$baseUrl}/holidays",
                'method' => 'post',
                'job' => "{$baseUrl}/holidays/jobs/{job}",
            ],
        ],
        'person' => [
            // https://developers.hrworks.de/2.0/endpoints/persons/persons#get-v2-persons-jobs-{jobid}
            'getJob' => [
                'api' => "{$baseUrl}/persons/jobs/{job}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/persons#get-v2-persons
            'index' => [
                'api' => "{$baseUrl}/persons",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/persons-master-data#get-v2-persons-master-data
            'indexComplete' => [
                'api' => "{$baseUrl}/persons/master-data",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/personspersonidentifier#get-v2-persons-{personnelnumber}
            'show' => [
                'api' => "{$baseUrl}/persons/{person}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/personspersonidentifier#get-v2-persons-{personnelnumber}-master-data
            'showComplete' => [
                'api' => "{$baseUrl}/persons/{person}/master-data",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/persons#post-v2-persons
            'create' => [
                'api' => "{$baseUrl}/persons",
                'method' => 'post',
                'job' => "{$baseUrl}/persons/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/persons#put-v2-persons
            'update' => [
                'api' => "{$baseUrl}/persons",
                'method' => 'put',
                'job' => "{$baseUrl}/persons/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/personspersonidentifier#post-v2-persons-{personidentifier}-working-times
            'setWorkTime' => [
                'api' => "{$baseUrl}persons/{person}/working-times",
                'method' => 'post',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/personspersonidentifier#get-v2-persons-{personidentifier}-working-times-status
            'getWorkTimeStatus' => [
                'api' => "{$baseUrl}persons/{person}/working-times/status",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/personspersonidentifier#get-v2-persons-{personnelnumber}-leave-account
            'getLeaveAccount' => [
                'api' => "{$baseUrl}/persons/{person}/leave-account",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/persons-available-working-hours#get-v2-persons-available-working-hours
            'getAvailableWorkingHours' => [
                'api' => "{$baseUrl}/persons/available-working-hours",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/persons-onboarding#get-v2-persons-onboarding-jobs-{jobid}
            'getOnboardingJob' => [
                'api' => "{$baseUrl}/persons/onboarding/jobs/{job}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/persons-onboarding#post-v2-persons-onboarding
            'createOnboarding' => [
                'api' => "{$baseUrl}/persons/onboarding",
                'method' => 'post',
                'job' => "{$baseUrl}/persons/onboarding/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/persons/personstoday#get-v2-persons-today
            'today' => [
                'api' => "{$baseUrl}/persons/today",
                'method' => 'get',
            ],
        ],
        'absence' => [
            // https://developers.hrworks.de/2.0/endpoints/absences#get-v2-absences-jobs-{jobid}
            'getJob' => [
                'api' => "{$baseUrl}/absences/jobs/{job}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences#get-v2-absences
            'index' => [
                'api' => "{$baseUrl}/absences",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/absences-number#get-v2-absences-{number}
            'show' => [
                'api' => "{$baseUrl}/absences/{absence}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences#post-v2-absences
            'create' => [
                'api' => "{$baseUrl}/absences",
                'method' => 'post',
                'job' => "{$baseUrl}/absences/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/absences-number#delete-v2-absences-{number}
            'delete' => [
                'api' => "{$baseUrl}/absences/{absence}",
                'method' => 'delete',
                'job' => "{$baseUrl}/absences/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences#delete-v2-absences
            'deleteMany' => [
                'api' => "{$baseUrl}/absences",
                'method' => 'delete',
                'job' => "{$baseUrl}/absences/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/absences-accumulated-values#get-v2-absences-accumulated-values
            'accumulatedValues' => [
                'api' => "{$baseUrl}/absences/accumulated-values",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/absences-leave-accounts#get-v2-absences-leave-accounts
            'leaveAccounts' => [
                'api' => "{$baseUrl}/absences/leave-accounts",
                'method' => 'get',
            ],
        ],
        'absence-types' => [
            // https://developers.hrworks.de/2.0/endpoints/absences/absences-absence-types#get-v2-absences-absence-types-jobs-{jobid}
            'getJob' => [
                'api' => "{$baseUrl}/absences/absence-types/jobs/{job}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/absences-absence-types#get-v2-absences-absence-types
            'index' => [
                'api' => "{$baseUrl}/absences/absence-types",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/absences-absence-types#post-v2-absences-absence-types
            'create' => [
                'api' => "{$baseUrl}/absences/absence-types",
                'method' => 'post',
                'job' => "{$baseUrl}/absences/absence-types/jobs/{job}",
            ],
        ],
        'remote-work' => [
            // https://developers.hrworks.de/2.0/endpoints/absences/remote-work#get-v2-remote-work-jobs-{jobid}
            'getJob' => [
                'api' => "{$baseUrl}/remote-work/jobs/{job}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/remote-work#get-v2-remote-work
            'index' => [
                'api' => "{$baseUrl}/remote-work",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/remote-work-number#get-v2-remote-work-{number}
            'show' => [
                'api' => "{$baseUrl}/remote-work/{remote-work}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/remote-work#post-v2-remote-work
            'create' => [
                'api' => "{$baseUrl}/remote-work",
                'method' => 'post',
                'job' => "{$baseUrl}/remote-work/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/remote-work-number#put-v2-remote-work-{number}
            'update' => [
                'api' => "{$baseUrl}/remote-work/{remote-work}",
                'method' => 'put',
                'job' => "{$baseUrl}/remote-work/jobs/{job}}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/remote-work-number#delete-v2-remote-work-{number}
            'delete' => [
                'api' => "{$baseUrl}/remote-work/{remote-work}",
                'method' => 'delete',
                'job' => "{$baseUrl}/remote-work/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/remote-workaccumulated-values#get-v2-remote-work-accumulated-values
            'accumulatedValues' => [
                'api' => "{$baseUrl}/remote-work/accumulated-values",
                'method' => 'get',
            ],
        ],
        'sick-leaves' => [
            // https://developers.hrworks.de/2.0/endpoints/absences/sick-leaves#get-v2-sick-leaves-jobs-{jobid}
            'getJob' => [
                'api' => "{$baseUrl}/sick-leaves/jobs/{job}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/sick-leaves#get-v2-sick-leaves
            'index' => [
                'api' => "{$baseUrl}/sick-leaves",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/sick-leaves-number#get-v2-sick-leaves-{number}
            'show' => [
                'api' => "{$baseUrl}/sick-leaves/{sick-leave}",
                'method' => 'get',
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/sick-leaves#post-v2-sick-leaves
            'create' => [
                'api' => "{$baseUrl}/sick-leaves",
                'method' => 'post',
                'job' => "{$baseUrl}/sick-leaves/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/sick-leaves-number#delete-v2-sick-leave-{number}
            'delete' => [
                'api' => "{$baseUrl}/sick-leaves/{sick-leaves}",
                'method' => 'delete',
                'job' => "{$baseUrl}/sick-leaves/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/sick-leaves#delete-v2-sick-leaves
            'deleteMany' => [
                'api' => "{$baseUrl}/sick-leaves",
                'method' => 'delete',
                'job' => "{$baseUrl}/sick-leaves/jobs/{job}",
            ],
            // https://developers.hrworks.de/2.0/endpoints/absences/sick-leaves-accumulated-values#get-v2-sick-leaves-accumulated-values
            'accumulatedValues' => [
                'api' => "{$baseUrl}/sick-leaves/accumulated-values",
                'method' => 'get',
            ],
        ],
        /* 
        // https://developers.hrworks.de/2.0/endpoints/cost-accounting
        'cost-objects' => [
        ],
        // https://developers.hrworks.de/2.0/endpoints/travel-expenses
        'travel-expenses' => [
        ],
        // https://developers.hrworks.de/2.0/endpoints/workingtimes
        'working-times' => [
        ],
        // https://developers.hrworks.de/2.0/endpoints/wage-and-salary
        'payroll' => [
        ], 
        */
    ],
];
