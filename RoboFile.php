<?php

class RoboFile extends \Robo\Tasks
{
    var $single_acceptancefile = null;

    public function watch(){
        $this->taskWatch()
            ->monitor(
                [ '../codeception/tests/acceptance',
                  '../resources/views',
                  '../app/',
                  '../app/Http/Controllers',
                ],
                function( $event ) {
                    $resource = $event->getResource();
                    if( preg_match('~acceptance~', $resource ) ){
                        $this->change_acceptancefile($resource);
                    }
                    $this->acceptance_single();
                }
            )->run();
    }
    public function change_acceptancefile( $file = null ){
        $this->single_acceptancefile = $file;
    }

    public function acceptance_single( ){
        if( $this->single_acceptancefile == null ){
            $this->say('受け入れテストが指定されていません');
            return;
        }
        $this->_exec( '../vendor/bin/codecept --config=../codeception/codeception.yml run acceptance ' . $this->single_acceptancefile );
    }
}
?>
