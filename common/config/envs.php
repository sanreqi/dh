<?php
/**
  配置域名和配置文件的映射关系
 *  http_host => config file name
 */
return [
    '127.0.0.1:8090' => 'dev',
    'localhost:8090' => 'dev',
    'paidan.api.local:8090' => 'qa',
    'paidan.api.local:8083' => 'qa',
    'localhost:8080' => 'dev',
    'paidan.api.test:8888' => 'qa',
    'paidan.api.test' => 'qa',
    '192.168.0.24:8888' => 'qa',
    '10.8.8.233:19994' => 'qa',
    'paidan.knwoledge.api:19994' => 'qa',
    '192.168.3.4:19994' => 'qa',
    'm.cytsh.cn' => 'prod',
    't.cytsh.cn' => 'prod',
    '10.81.71.47' => 'prod',
    '172.36.12.45' => 'prod',
    '10.89.1.161' => 'prod',
    '172.16.25.57' => 'uat',
    '172.16.25.57:8082' => 'uat',
    'docker.paidanapi20.com' => 'self',
    'docker.paidanapi20.com:8080' => 'self',
    'paidan-knowledge.test' => 'dev',
    'paidan-knowledge.test:8888' => 'dev',
    'cy.zamplus.com' => 'uat',
    'cy.zamplus.com:1443' => 'uat',
    'p2.local' => 'dev'
];
