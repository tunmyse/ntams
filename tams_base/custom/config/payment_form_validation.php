<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$config = array(
             "create_payschedule" => array(
                        array(
                              'field'   => 'session',
                              'label'   => 'Session',
                              'rules'   => 'required'
                           ),
                        array(
                              'field'   => 'payhead',
                              'label'   => 'Pay Head',
                              'rules'   => 'required'
                           ),
                        array(
                              'field'   => 'instalment',
                              'label'   => 'Instalment',
                              'rules'   => 'required'
                           ),   
                        array(
                              'field'   => 'amount',
                              'label'   => 'Amount',
                              'rules'   => 'required |numeric'
                           ),
                        array(
                              'field'   => 'pamount',
                              'label'   => 'Penalty',
                              'rules'   => 'required |numeric'
                           ),
                        array(
                              'field'   => 'unittype[]',
                              'label'   => 'Pay. Specification',
                              'rules'   => 'required'
                           ),
                        array(
                              'field'   => 'level[]',
                              'label'   => 'Level',
                              'rules'   => 'required'
                           ),
                         array(
                              'field'   => 'type',
                              'label'   => 'Schedule Type',
                              'rules'   => 'required'
                           )
                      )               
                            
        );
