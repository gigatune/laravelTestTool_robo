<?php

class RoboFile extends \Robo\Tasks
{
    public function watch(){
        $this->taskWatch()
            ->monitor(
                '../codeception/tests/acceptance',
                function( $event ) {
                    $resource = $event->getResource();
                    $this->acceptance_single( $resource );
                }
            )->run();
    }

    public function acceptance_single( $file = null ){
        $this->_exec( '../vendor/bin/codecept --config=../codeception/codeception.yml run acceptance ' . $file );
    }
}
?>
