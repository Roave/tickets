<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

use Application\Command\Ticket\TicketCommandHandler;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Router\Http\Literal;
use Application\Controller\IndexController;
use Application\Controller\TicketController;
use Zend\Mvc\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            // not needed:
//            'application' => [
//                'type'    => Literal::class,
//                'options' => [
//                    'route'    => '/application',
//                    'defaults' => [
//                        'controller' => IndexController::class,
//                        'action'     => 'index',
//                    ],
//                ],
//            ],

            'ticket' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/ticket',
                    'defaults' => [
                        'controller' => TicketController::class,
                        'action'     => 'index',
                    ],
                ],
            ],

            // move to child route
            // if too complex, move to separate route config file
            'open-ticket' => [
                'type'    => Literal::class,
                'options' => [
                    // make this explicit (ticket open form page)
                    'route'    => '/ticket/open-ticket-form',
                    'defaults' => [
                        'controller' => TicketController::class,
                        'action'     => 'open',
                    ],
                ],
            ],

            'remove-ticket' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/ticket/remove/:id',
                    'constraints' => [
                        // won't work for UUIDs (for now)
                        'action'     => '[0-9]{16}',
                    ],
                    'defaults' => [
                        'controller' => TicketController::class,
                        'action'     => 'removeTicket',
                    ],
                ],
            ],

            'register-ticket' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/ticket/register',
                    'defaults' => [
                        'controller' => TicketController::class,
                        'action'     => 'register',
                    ],
                ],
            ],
        ],
    ],

    // delete
    'service_manager' => [
        'factories' => [
            // @todo to be defined:
            'MyCommandBus' => 'CommandBusFactory',
        ],
        'abstract_factories' => [
        ],
    ],

    'controllers' => [
        'invokables' => [
            IndexController::class => IndexController::class,
        ],

        'factories' => [
            // move this to a factory class
            TicketController::class => function ($em) {
                $formManager   = $em->getServiceLocator()->get('FormElementManager');
                $entityManager = $em->getServiceLocator()->get(EntityManager::class);

                return new TicketController(new TicketCommandHandler($entityManager), $formManager);
            },
        ],
    ],

    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'doctrine' => [
        'driver' => [
            'application_entity' => [
                'class' => AnnotationDriver::class,
                'paths' => realpath(__DIR__ . '/../src/Application/Entity'),
            ],

            'orm_default' => [
                'drivers' => [
                    'Application\Entity' => 'application_entity',
                ],
            ],
        ],
    ],
];
