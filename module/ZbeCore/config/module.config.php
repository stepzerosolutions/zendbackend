<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'ZbeCore\Controller\Index' => 'ZbeCore\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'zbe-core' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/cabcore',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'ZbeCore\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'cache' => function($sm){
                $cache = Zend\Cache\StorageFactory::factory(array(
                    'adapter' => 'filesystem',
                    'plugins' => array(
                        'exception_handler' => array('throw_exceptions' => false),
                        'serializer'
                    )
                ));
    
                $cache->setOptions(array(
                    'cache_dir' => './data/cache'
                ));
    
                return $cache;
            },
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'ZbeCore' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'SecureKey' => 'ZbeCore\Helper\SecureKey',
            'Success'   => 'ZbeCore\Helper\Success',
            'Error'   => 'ZbeCore\Helper\Error',
            )
        )
);
